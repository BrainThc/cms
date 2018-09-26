<?php
/**
 * 
 * TiaoshiAction.class.php (调试模块)
 * 此模块用户调试 应用 用完 exit 结束
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class TiaoshiAction extends BaseAction{

	public function test(){ 

		$m = M('config');

		$list = $m->where('lang=1')->select();
		foreach ($list as $k => $v) {
			$v['lang'] = 2;
			//echo $m->add($v);
		}
	}

	/*百度翻译api 可以翻译大量文本*/
	public function api(){

		$text = $_REQUEST('text');
		$url = 'http://openapi.baidu.com/public/2.0/bmt/translate?client_id=znYSROPYN1nfFDk9DHZHtqsc&q='.$text.'&from=zh&to=en';
		$data = file_get_contents($url);
		$data = (array)json_decode($data);
		if($data['trans_result']){ 
			$data = (array)$data['trans_result'][0];
			$msg['data'] = $data['dst'];
			$msg['rs'] = 1;
		}

		echo json_encode($msg);
	}
	
	/*有道翻译 只能翻译词组*/
    public function fy(){
    	//每小时 最多 1000个
    	exit;
    	set_time_limit(5000);
    	import ( "@.ORG.Youdao" );
		$new = new translate();
		$m = M('Category');
		$list = $m->where('lang = 2')->select();
		foreach($list as $k => $v){
			$string = $v['catname'];
			$string = $new->init($string);
			$data = json_decode($string,TRUE);
			$v['catname'] = $data['translation'][0];
			//echo $m->save($v);
		}

		//例子

		$string = '天津';

		$string = $new->init($string);
		$data = json_decode($string,TRUE);
		dump($data['translation'][0]);

	    if( $new->err_code!=0 ){
	        dump($new->err_message);
	    }
    }


    function cn_for_en(){
    	exit;
    	$ids = array(11,12,13,14,15,16,20);
    	// 将中文栏目复制到英文栏目
    	$m = M('Category');
    	$list = $m ->where('parentid = 0 and lang = 1 and id!=6')->order('listorder asc,id asc')->select();
    	foreach ($list as $k => $v) {
    		
    		$list2 = $m ->where('parentid = '.$v['id'].' and lang = 1')->order('listorder asc,id asc')->select();
    		
    		$pid1 = $ids[$k];
 
    		foreach ($list2 as $k2 => $v2) {
	    		$list3 = $m ->where('parentid = '.$v2['id'].' and lang = 1')->order('listorder asc,id asc')->select();
	    		
	    		unset($v2['id']);
	    		$v2['lang'] = 2;
	    		$v2['parentid'] = $pid1;
	    		$pid2 = $m->add($v2);
	    		dump('2__'.$pid2);

	    		foreach ($list3 as $k3 => $v3) {
	    			unset($v3['id']);
		    		$v3['lang'] = 2;
		    		$v3['parentid'] = $pid2;
		    		$pid3 = $m->add($v3);
		    		dump('2__3__'.$pid3);

	    		}

    		}
    	}
    }
 
}
?>