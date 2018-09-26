<?php
/**
 * 
 * ZijinAction.class.php (资金管理)
 *
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class ZijinAction extends BaseAction{

	function _initialize(){	
		parent::_initialize();

		//检测是否登录
        if(!$this->_userid) $this->error('你还未登陆系统',U('Login/index'));

		$this->dao = M('Recharge');
		$this->users = M('User')->find($this->_userid);
    }

    public function index(){

    	import('@.Action.Adminbase');
		$c=new AdminbaseAction();

		if($this->_userid){ 
			$map['userid']=intval($this->_userid);
			$map['status'] = array('NEQ',0);
			$data = $c->_list('Recharge',$map,'id','',10);
		}

		$map['status'] = 0;
		$vo = $this->dao->where($map)->find();

		$this->assign ( 'vo', $vo );
		$this->assign ( 'pages', $data['page'] );
		$this->assign ( 'list', $data['list'] );

    	$payment = M('Payment')->field('id,pay_code,pay_name,pay_fee,pay_fee_type,pay_desc,is_cod,is_online')->where("status=1")->select();
    	$this->assign('payment',$payment);

    	

        $this->display();
    }

    public function status(){
    	$map = array();
    	$map['id'] = intval($_GET['id']);
    	$map['userid'] = $this->_userid;
    	$rs = $this->dao->where($map)->save(array('status'=>'1'));
    	$rs = $rs?1:0;
    	echo json_encode($rs);
    }

    public function zfbtn(){

    	$price = intval($_REQUEST['price']);
    	$id = intval($_REQUEST['id']);
    	$paymentid= intval($_REQUEST['payment']);
		$Payment = M('Payment')->find($paymentid);

		$order['pay_id'] =  intval($Payment['id']);
		$order['pay_name'] =  $Payment['pay_name'] ? $Payment['pay_name'] : '';
		$order['pay_code'] =  $Payment['pay_code'] ? $Payment['pay_code'] : '';

		if($price){
			$order['title'] = $Payment['pay_name'].'-充值-'.$price.'元';
			$order['price'] = $price;
			$order['status'] = 0;
		}

		if($this->_userid){
			$order['userid'] = $this->_userid;
			$order['username'] = $this->_username;
		}

		$order['createtime'] = $order['updatetime'] = time();

		if($id){
			$rs = $this->dao->save($order);
			$order['id'] = $id;
		}else{
			$id = $this->dao->add($order);
			$order['id'] = $id;
		}

    	$pay_code = $order['pay_code'];
		$aliapy_config = unserialize($Payment['pay_config']);
		$aliapy_config['order_sn']= 'cz'.$order['id'];
		$aliapy_config['order_amount']= $order['price'];
		$aliapy_config['body'] = '';
		import("@.Pay.".$pay_code);
		$pay=new $pay_code($aliapy_config);
		$paybutton = $pay->get_code();

		/*获取账户 开始*/
		$setup = $pay->setup();
		$account = '';
		foreach ($setup['config'] as $k => $v) {
			if($v['name'] == strtolower($setup['pay_code']).'_account'){
				$account = $aliapy_config[$v['name']];
			}
		}

		if($account){
			$data = array();
			$data['id'] = $order['id'];
			$data['account'] = $account;
			$this->dao->save($data);
		}
		/*获取账户 结束*/



		$data = array();
		$data['id'] = $order['id'];
		$data['paybutton'] = $paybutton;

		echo json_encode($data);

    }

    public function test(){
    	exit;
    	$sn = $_GET['sn'];
    	$rs = order_pay_status($sn,2);
    	$rs = $rs?1:0;
    	echo $rs;
    }




	
}
?>