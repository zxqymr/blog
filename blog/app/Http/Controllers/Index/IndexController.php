<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    public function index(){
        $imgs = DB::table('goods')->where('is_new',1)->limit(4)->orderby('goods_id','desc')->select('goods_img')->get();
        $where = [
            ['parent_id','=',0],
            ['is_show','=',1]
        ];
        $topInfo = DB::table('category')->where($where)->select('cate_id','cate_name')->get();
        $goods = DB::table('goods')->where('is_hot',1)->limit(8)->orderby('goods_id','desc')->get();
        $newgoods =  DB::table('goods')->where('is_on_sale',1)->limit(4)->orderby('shop_price')->get();
        return view('index.index',compact('imgs','topInfo','goods','newgoods'));
    }

    // pcpay
    public function pcpay(){

        $config = config('pay');
        // dd(app_path('libs\alipay\pagepay\service\AlipayTradeService.php'));

        require_once app_path('libs\alipay\pagepay\service\AlipayTradeService.php');
        require_once app_path('libs\alipay\pagepay\buildermodel\AlipayTradePagePayContentBuilder.php');

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = date('YmdHis').rand(1000,9999);

        //订单名称，必填
        $subject = '测试';

        // 通过订单号查询订单金额
        //付款金额，必填
        $total_amount = 1000;

        //商品描述，可空
        $body = '';

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
        */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        //输出表单
        var_dump($response);
    }

    public function returnpay(){
        $config = config('pay');
        require_once app_path('libs\alipay\pagepay\service\AlipayTradeService.php');


        $arr=$_GET;
        $alipaySevice = new \AlipayTradeService($config); 
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码
            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号
            $where['order_no'] = htmlspecialchars($_GET['out_trade_no']);
            $where['order_acount'] = htmlspecialchars($_GET['total_amount']);

            //支付宝交易号
            $trade_no = htmlspecialchars($_GET['trade_no']);
                
            $count = DB::table('order')->where($where)->count();

            if($count){
                echo "验证成功<br />支付宝交易号：".$trade_no."订单号：".$where['order_no']."支付金额：".$where['order_acount']."此订单有问题";exit;
            }

            if(config('pay.seller_id') != htmlspecialchars($_GET['seller_id'])){
                echo "验证成功<br />支付宝交易号：".$trade_no."订单号：".$where['order_no']."支付金额：".$where['order_acount']."此订单有问题";exit;
            }

            if(config('pay.app_id') != htmlspecialchars($_GET['app_id'])){
                echo "验证成功<br />支付宝交易号：".$trade_no."订单号：".$where['order_no']."支付金额：".$where['order_acount']."此订单有问题";exit;
            }


            echo "验证成功<br />支付宝交易号：".$trade_no;

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            echo "验证失败";
        }
    }

    // mobilepay
    public function mobilepay(){
        $config = config('pay');

        require_once app_path('libs/malipay/wappay/service/AlipayTradeService.php');
        require_once app_path('libs/malipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php');
        
        // if (!empty($_POST['WIDout_trade_no'])&& trim($_POST['WIDout_trade_no'])!=""){
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = date('YmdHis').rand(1000,9999);

            //订单名称，必填
            $subject = '测试';

            //付款金额，必填
            $total_amount = 1000;

            //商品描述，可空
            $body = '';

            //超时时间
            $timeout_express="1m";

            $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new \AlipayTradeService($config);
            $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

            return ;
        // }
    }

    // notifypay 异步通知
    public function notifypay(){
        $config = config('pay');

        require_once app_path('libs/malipay/wappay/service/AlipayTradeService.php');


        $arr=$_POST;
        $alipaySevice = new AlipayTradeService($config); 
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代

            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            
            
            //支付宝交易号

            $where['order_no'] = htmlspecialchars($_POST['trade_no']);

            //交易状态
            $where['order_status'] = htmlspecialchars($_POST['trade_status']);

            //商户订单号
            $where['order_no'] = htmlspecialchars($_POST['out_trade_no']);
            $where['order_acount'] = htmlspecialchars($_POST['total_amount']);

            //支付宝交易号
            $trade_no = htmlspecialchars($_POST['trade_no']);
                
            $count = DB::table('order')->where($where)->count();

            if($count){
                echo "验证成功<br />支付宝交易号：".$trade_no."订单号：".$where['order_no']."支付金额：".$where['order_acount']."此订单有问题";exit;
            }

            if(config('pay.seller_id') != htmlspecialchars($_POST['seller_id'])){
                echo "验证成功<br />支付宝交易号：".$trade_no."订单号：".$where['order_no']."支付金额：".$where['order_acount']."此订单有问题";exit;
            }

            if(config('pay.app_id') != htmlspecialchars($_POST['app_id'])){
                echo "验证成功<br />支付宝交易号：".$trade_no."订单号：".$where['order_no']."支付金额：".$where['order_acount']."此订单有问题";exit;
            }


            echo "验证成功<br />支付宝交易号：".$trade_no;


            if($_POST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
            }
            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                    //如果有做过处理，不执行商户的业务程序            
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                
            echo "success";     //请不要修改或删除
                
        }else {
            //验证失败
            echo "fail";    //请不要修改或删除

        }
            }
}
