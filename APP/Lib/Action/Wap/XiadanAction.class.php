<?php
/**
 * 
 * XiadanAction.class.php (下单模块)
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class XiadanAction extends BaseAction{

	public function index(){ 

		if(!$this->_userid) $this->error(L('nologin'),U('User/Login/index'));
		
		$this->display();
	}


	public function done(){ 
		$list = $_POST['list'];
		unset($_POST['list']);
		$row = $data = $cart =  array();
		foreach($list as $k => $v){ 
			$row = array_merge($row,$v);
			if(($k+1)%6 == 0){ 
				$data[] = $row;
				$row = array();
			}
			
		}

		$userid = intval($this->_userid);

		//价格统计 
		$amount=0;
		foreach($data as $k=>$v){
			//如果没有 型号 或者 名称 删除此行
			if($v['xinghao'] || $v['name']){ 
				$price = intval($v['number']) * floatval($v['price']);
				$row = array();
				$row['userid'] = $userid;
				$row['moduleid'] = 3;
				$row['product_id'] = 0;
				$row['product_thumb'] = '/style/images/order.jpg';
				$row['product_name'] = $v['name'];
				if($v['xinghao']){ 
					$row['product_name'] .= ' ( 编号： '.$v['xinghao'].' )';
				}
				
				$row['product_url'] = 'javascript:void(0);';
				$row['product_price'] = floatval($v['price']);
				$row['price'] = $price;
				$row['number'] = intval($v['number']);
				$row['note'] = $v['note'];
				$cart[] = $row;

				$amount = $amount+$price;
			}else{ 
				unset($data[$k]);
			}
			
		}

		//自定义价格
		if($_POST['isamount'] == 1){ 
			$amount = floatval($_POST['amount']);
		}

		//address
		$address = $_POST;

		$order=array();

		/*支付方式*/
		$paymentid= 1;//intval($_POST['payment']);
		$Payment = M('Payment')->find($paymentid);

		/*发票*/
		$order['invoice'] = intval($_POST['invoice']);
		if($order['invoice']){			
			$order['invoice_title']= htmlspecialchars($_POST['invoice_title']);
			$order['invoice_fee'] = $amount*$_POST['invoice_fee']/100;
			$order['invoice_fee'] =  number_format($order['invoice_fee'],2);
		}
		
		$order['amount'] = $amount;
	
		$order['shipping_fee'] = number_format($Shipping['first_price'],2);	
		$order['order_amount'] = $order['amount']+$order['invoice_fee']+$order['insure_fee']+$order['shipping_fee'];
		
		/*发票*/
		if($Payment['pay_fee']){
			$order['pay_fee'] = $Payment['pay_fee_type'] ?  $Payment['pay_fee'] : $order['order_amount']*$Payment['pay_fee']/100;
			$order['pay_fee'] = number_format($order['pay_fee'],2);
		}
		$order['order_amount'] = $order['order_amount']+$order['pay_fee'];
	
		$order['userid'] = intval($userid);
		$order['status'] = 0;
		$order['pay_status']= 0;
		$order['shipping_status']= 0;

		$order['consignee'] = $address['consignee'];
		$order['country'] =  intval($address['country']);
		$order['province']  =  intval($address['province']);
		$order['city'] =  intval($address['city']);
		$order['area'] =  intval($address['area']);
		$order['address'] =  $address['address'];
		$order['zipcode'] =  $address['zipcode'];
		$order['tel'] =  $address['tel'];
		$order['mobile'] =  $address['mobile'];
		$order['email'] =  $address['email'];

		$order['shipping_id'] =  intval($Shipping['id']);
		$order['shipping_name'] =  $Shipping['name'] ?  $Shipping['name'] : '';
 
		$order['pay_id'] =  intval($Payment['id']);
		$order['pay_name'] =  $Payment['pay_name'] ? $Payment['pay_name'] : '';
		$order['pay_code'] =  $Payment['pay_code'] ? $Payment['pay_code'] : '';
		$order['postmessage'] =  htmlspecialchars($_POST['postmessage']);
		

		$order['add_time'] =  time();
		foreach($order as $key=>$r){ if($r==null)$order[$key]=''; }

		$model = M('Order');

		$orderid= $model->add($order);
		if($orderid){
			$order['sn'] = date("Ymd"). sprintf('%06d',$orderid); 
			$model->save(array('id'=>$orderid,'sn'=>$order['sn']));
			foreach($cart as $key=>$r){
				unset($cart[$key]['id']);
				$cart[$key]['order_id']=$orderid;
				$cart[$key]['userid']=$userid;
				M('Order_data')->add($cart[$key]);
			}

		}

		$this->assign('order',$order);
		$this->assign('cart',$cart);
		$this->display('Cart:done');


	}

 
}
?>