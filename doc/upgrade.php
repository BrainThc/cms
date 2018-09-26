<?php
1. define('RUNTIME_PATH','./Cache/');  //缓存目录配置
{
	//index.php增加
}
2. \Extend\Driver\TagLib\TagLibTp.class.php  //自定义模板标签文件
{
	//THINKPHP/Extend目录增加
}
3. \Lib\Behavior\CheckLangBehavior.class.php //自定义语言包管理
{
	//整个文件自定义新增的

}
4. \Lib\Behavior\ContentReplaceBehavior.class.php //自定义模板变量
{
	// 系统默认的特殊变量替换
	'__STYLE__'    =>  __ROOT__.'/style',// 前台样式目录
}
5. \Lib\Core\App.class.php //自定义模板主题更改
{
	/* 模板相关目录常量 */
	 //define('THEME_NAME',   $templateSet);                  // 当前模板主题名称 liuxun delete
        $group   =  defined('GROUP_NAME')?GROUP_NAME.'/':'';

		if($_GET['iscreatehtml']){ //liuxun add
			C('LAYOUT_ON',C('LAYOUT_HOME_ON'));
			$group   ='Home/';
			define('THEME_NAME',  C('DEFAULT_HOME_THEME'));             
		}else{
			define('THEME_NAME',   $templateSet);             
		} 
		//liuxun add
        define('THEME_PATH',   TMPL_PATH.$group.(THEME_NAME?THEME_NAME.'/':''));
        define('APP_TMPL_PATH',__ROOT__.substr(APP_PATH,1).basename(TMPL_PATH).'/'.$group.(THEME_NAME?THEME_NAME.'/':''));

}
6. \Lib\Core\Action.class.php //自定义ajax跳转 
{
	// function dispatchJump(
	//原始 $data =  is_array($ajax)?$ajax:array();
	is_array($ajax)?$ajax:$this->get();
}
7. \Lib\Template\ThinkTemplate.class.php //自定义标签解析
{
	// function parseTag(

	//增加
	elseif('~' == $flag){ // 执行某个函数
            return  '<?php '.$name.';?>';

		}elseif(substr($tagStr,0,3)=='if '){  //liuxun add
			return  '<?php if('.substr($tagStr,3).') : ?>';
		}elseif(substr($tagStr,0,7)=='elseif '){
			return '<?php elseif('.substr($tagStr,7).'): ?>';
		}elseif($tagStr=='else'){
			return '<?php else :?>';
		}elseif($tagStr=='/if'){
			return '<?php endif;?>';
		}elseif(substr($tagStr,0,4)=='php '){
			return '<?php '.substr($tagStr,4).';?>';  //liuxun add end

}
<!--以下可以不改-->
1. \Common\common.php // 调试模式ERR抛出异常
{
	//取消了 print_r($value,true);
	$info   =   ($label?$label.':':'').print_r($value,true);
    if(APP_DEBUG && 'ERR' == $level) {// 调试模式ERR抛出异常
}
2. \Common\functions.php // F函数 改变了位置
3. \Common\runtime.php // 系统行为扩展文件统一编译
{
	//增加了key的认证
	if(defined('TP_KEY')){ $content = preg_replace('/defined\(\'TP_KEY\'\) or define\(\'TP_KEY\',\'(.+?)\'\)\;/','',$content);exit;}
	preg_match('/[\w][\w-]*\.(?:com\.cn|net\.cn|com|cn|co|net|org|gov|cc|biz|info)(\/|$)/isU', $_SERVER['SERVER_NAME'], $domain);
	$domain = $domain[0];
	if(is_file(__ROOT__.$domain.'.php')){	
		include __ROOT__.$domain.'.php';
		eval(authcode(base64_decode($code)));
		$content .=  sha1( $domain.$key['key'])==$key['code'] ? ' defined(\'TP_KEY\') ?  exit : define(\'TP_KEY\',true);' : 'define(\'TP_KEY\',false);';
	}else{
		$content .= 'define(\'TP_KEY\',false);';
	}
}
