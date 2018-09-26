<?php
$sdk = require ('sdk.php');
$database = require (RUNTIME_PATH.'config.php');
$sys_config =  include DATA_PATH.  'sys.config.php';
if(empty($sys_config)){$sys_config=array();$sys_config['LAYOUT_ON']=1;}
if($sys_config['URL_MODEL']) $RULES = include DATA_PATH.  'Routes.php';
$config	= array(
		'VERIFY_PASS'		=> 'yiguan',
		'DEFAULT_THEME'		=> 'Default',
		'DEFAULT_CHARSET' => 'utf-8',
		'APP_GROUP_LIST' => 'Home,Admin,User',
		'DEFAULT_GROUP' =>'Home',
		'TMPL_FILE_DEPR' => '_',
		'URL_CASE_INSENSITIVE' =>true,
		'DB_FIELDS_CACHE' => false,
		'DB_FIELDTYPE_CHECK' => true,
		'URL_ROUTER_ON' => true,
		'DEFAULT_LANG'   => 'cn',
		'LANG_SWITCH_ON'		=> true,
		'TAGLIB_LOAD' => true,
		'TAGLIB_PRE_LOAD' => 'Tp',
		'TMPL_ACTION_ERROR' => './Public/success.html',
		'TMPL_ACTION_SUCCESS' =>  './Public/success.html',
		'TMPL_ACTION_SUCCESSYULIA' =>  './Public/successyulia.html',
		'COOKIE_PREFIX'=>'TP_',
		'COOKIE_EXPIRE'=>'',
		'VAR_PAGE' => 'p',
		'LAYOUT_HOME_ON'=>$sys_config['LAYOUT_ON'],
		'URL_ROUTE_RULES' => $RULES,
		'TMPL_EXCEPTION_FILE' => './Public/exception.html',
		'OA_DONAIM'=>'http://oa.ieconn.com',
		'VERIFY_PASSI'=>'liuyueli'
);
return array_merge($database, $config ,$sys_config,$sdk);
?>
