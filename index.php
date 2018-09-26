<?php
/**
 * index(入口文件)
 */
if(!is_file('./Cache/config.php'))header("location: ./Install");
header("Content-type: text/html;charset=utf-8");
ini_set('memory_limit','128M');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

/**以下网站配置请勿随意更改**/
define('ThinkPHP',true);
define('UPLOAD_PATH','./Uploads/');
define('VERSION','');
define('UPDATETIME','');
define('APP_NAME','APP');
define('APP_PATH','./APP/');

/**tp升级配置**/
define('RUNTIME_PATH','./Cache/');

define('APP_LANG',true);
define('APP_DEBUG',flase);
define('APP_ONLINE',0);


// 手机实例
 $exhost = explode('.', $_SERVER['HTTP_HOST']);
 if($exhost[0] == 'm' || isMobile()){
 	if($_GET['l'] && $_GET['l']!='cn') unset($_GET);
 	$_GET['g'] = 'Wap';
 }


define('THINK_PATH','./ThinkPHP/');
require(THINK_PATH.'ThinkPHP.php');


/*手机访问判断函数*/
function isMobile() {
	// 如果有HTTP_X_WAP_PROFILE则一定是移动设备
	if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])){
		return true;
	}
	//如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
	if (isset ($_SERVER['HTTP_VIA'])) {
	//找不到为flase,否则为true
		return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	}
	//判断手机发送的客户端标志,兼容性有待提高
	if (isset ($_SERVER['HTTP_USER_AGENT'])) {
			$clientkeywords = array ('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile');
		// 从HTTP_USER_AGENT中查找手机浏览器的关键字
		if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
			return true;
		}
	}
	//协议法，因为有可能不准确，放到最后判断
	if (isset ($_SERVER['HTTP_ACCEPT'])) {
		// 如果只支持wml并且不支持html那一定是移动设备
		// 如果支持wml和html但是wml在html之前则是移动设备
		if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
			return true;
		}
	}
	return false;
}




?>
