<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016100100636207",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpAIBAAKCAQEAlzy+Gv6YSz/K8CrsAM4kED8+XnIh6KHShZNTE0Xt48YtLjoBYt7jyLbRlXCS+xn2lFkQ7phI5E7KaSWdX3XwOMEU5+BJEc18py+m5Cr/8nYFrj+1qvk0dndsiFwZRbnzg6Jphgy1C3VtxN3MwoUG9ND4eMZEuM/oO5qJJ0oDBTib7Cz/uffjWyBtfLaLzGDzUWi4/LxsdRwCN7thxOUATBIo7y/AIOvfYz/aar59YyuIU6YeGoyfgmah6v0ZDewF+OZHdEgwEDzjUaTG0Fr0Tnk6moaTxWhpnJt1Vlyv0nGqz/3mKLNBSBC/h+xcAimAfNQnq4m5GR9QmReM/IIvgQIDAQABAoIBABRyvQ1vUO4TsP+p/gDZ3lxoAKnKarVGc+1ljvzzHogGeoNeimNw2YGA3nODJgxXZVSHeleYNXrRAGMZF98ZViKGUKpNU/PZQbplIf6FpdeFh50Ythpo2WQPH5iMQ0p/KuKoafYa77ud4/qTNqUyUU92lbHWtOH8El1EtrieNCxXVt0htDZYj3h0UZ4sp2PjuYnfdJlOTJHrPUYQ55gfsIAQn23d7erwp0USaazMhrvVkGTh5D8JqemmyLLIC3owZH09VcbeQ7su7thDIODHe+QWoMPKN3RcVCvj+zQMYTNQcN3D5yICXEo+cPZYqF2J2KvfsB1FbTLmX7YBSVLCfYUCgYEAyQN6TbdjR0R7iVR4YC+vT93eaA7H/l6Jj+oWHq6d8uJkzSgEiX/CRaqU6SrAxiO3jnivKjXiaGpx+3CsFk5lZD7kxAIhNtf56VK4E4qBdyM9C2si7W+dtyXkkuaSmpNoGEu/YyqLgS38y3BN0BeVdszdy2ay5PwbF+ndCQcI2AMCgYEAwJuLKbtBje5+AJmo4EdKMpZTJneXwJ9Yi0juZONklukU1J0JL7p7rDgkdrf31etYANV+/rqwfGSj5A5q1NzwujyJ9qfqoe2eLvnBA3nXnt4jzgruB2QZUnQq6Bkv8bg3EeO0np1i4YLJEB9QsdCvprdRryDiMqm57QmvbSmvTSsCgYEAn4L4/M74I0e+2H2FgJ6WecRQhzajkcEnXGKf5v0eLe1lnD+TSiFt4qa4wEbC7vjM4mv2ZIKaBc3iYWtJw/G2F9So6Lnf7Yt5r6OKm0cf8ZCvEm6UKuKVvw580e3SjINI6W7Ck0jhp0L9Bds6hFUSsFFl99CpSXidb16PnmhMpk0CgYEApXp9m8MIVVrb4sQh9V8Kfl/s3JXPSW0d870bJI7Bc26ZuPmaVOlRK+uoWF9CjQX/u+exjkTzMEx/CobgfjW8lSVCGyq1SZ4PU6i8jbH28MVF2dZGHw9/OfoYiwRozrJIjhQmsEfkFn/5IuLkv4DeCMxjX6VO8dwko2S41X8E37UCgYBU43XRGxUiXdGzlEDMLrqKnCU/5BL59vwHSuSyVbPPV+ei3SYYHSJDgKHh9Ys5BZKu9eVQ7MJ4H+OTxFNmuHgmpNW/6goyMe+ZT3GJdbWCGeEMxRx7q9S5FwA69iMt24A96IxPRGiKwOq6Yxj1kMg4LtuGHD6Zvt3Aa8oy/S8ljQ==",
		
		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://localhost/alipay/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAl7jTJYDnmXvPuQSeLnAmSwrb5wp+0h1asw/wEUPwJFxM9s8Ni6a0sF20wjqhAIHPpK89fPBMd3HP8+CoO32OKuKY6rghlb2lDNsXfIf1mggAMJl3NydtX/6BBUNy9Elg68VQddIslGlK9aoRKHNNIo03a3onEUkhxTPYixLXnP+Y3NVvJITk1PkxWqyCIJq3XRXDLn+putm+GKLy7TVbFbIt5BK8WIxCPeljfJaIWWQqO3+nqoQrHwBNyrhmt3n0asEiXU7VnPaBQGTvqot8w/qssX345VkTcOp4BJrx3BMUCexSl6n549YmDhPthsUntyCoEsWN+5RaRCd+X86ShwIDAQAB",
		
	
);