<?php
/**
 * 
 * Paypal.class.php (Paypal支付插件)
 *
 */
class Paypal extends Think {
	public $config = array()  ;

    public function __construct($config=array()) {

        $this->config = $config;
        //调试网关地址 https://www.sandbox.paypal.com/cgi-bin/webscr 
		$this->config['gateway_url'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		$this->config['gateway_method'] = 'POST';
		$this->config['notify_url'] = return_url('paypal',1);
		$this->config['return_url'] = return_url('paypal');

    }
	public function setup(){

		$modules['pay_name']    =  L('Paypal_pay_name');   
		$modules['pay_code']    =  'Paypal';
		$modules['pay_desc']    =  L('Paypal_pay_desc');   
		$modules['is_cod']  = '0';
		$modules['is_online']  = '1';
		$modules['author']  = '爱是西瓜';
		$modules['website'] = 'https://www.paypal.com';
		$modules['version'] = '1.0.0';
		$modules['config']  = array(
			array('name' => 'paypal_account', 'type' => 'text', 'value' => ''),
			array('name' => 'paypal_key', 'type' => 'text', 'value' => ''),
		);
		return $modules;
	}

	public function get_code($info,$value){
 
		$gateway_url        = $this->config['gateway_url'];
		$data_vid           = trim($this->config['paypal_account']);
        $data_orderid       = $this->config['order_sn'];
        $data_vamount       = $this->config['order_amount'];
        $data_vmoneytype    = 'USD'; //CNY 人民币

        $data_vreturnurl    = $this->config['return_url'];
		$remark1			= $this->config['body'];


        $def_url  = '<span style="clean:both;"><form id="form_starPay" name="form_starPay" action="'.$gateway_url.'" method="post" accept-charset="gb2312" target="_blank">';
		$def_url .= '<input type="hidden" name="cmd" value="_xclick">'; 
		$def_url .= '<input type="hidden" name="business" value="'.$data_vid.'">'; 
		$def_url .= '<input type="hidden" name="invoice" value="'.$data_orderid.'">'; 
		$def_url .= '<input type="hidden" name="item_name" value="'.$data_orderid.'">'; 
		$def_url .= '<input type="hidden" name="amount" value="'.$data_vamount.'">'; 
		$def_url .= '<input type="hidden" name="currency_code" value="'.$data_vmoneytype.'">';
		$def_url .= '<input type="hidden" name="return" value="'.$data_vreturnurl.'">'; 
		$def_url .= '<input type="hidden" name="notify_url" value="'.$data_vreturnurl.'">'; 
		$def_url .= '<input type="hidden" name="custom" value="">'; 
		$def_url .= '<input type="hidden" name="lc" value="US">'; 
		$def_url .= '<input type="submit" class="button" value="'.L('PAY_NOW').'" >';
		$def_url .= '</form></span>';




        return $def_url;

	}

	public function respond(){

        $key            = $this->config['paypal_key'];

        $sn = trim($_POST['invoice']); //订单编号
        $payment_status = trim($_POST['payment_status']); // 支付成功 Completed （完成）
        $receiver_id =  trim($_POST['receiver_id']); //key

		if($payment_status =='Completed' ){ 
			//支付成功操作
			if($receiver_id == $key){ 
				order_pay_status($sn,'2');
		        return true;
			}

		}else{ 
			return false;

		}
	}


}
?>