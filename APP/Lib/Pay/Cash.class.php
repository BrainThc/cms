<?php
/**
 * 
 * Cash.php (货到付款模块)
 *
 */
class Cash extends Think {
	public $config = array()  ;
    public function __construct($config=array()) {
         $this->config = $config;
    }
	public function setup(){

		$modules['pay_name']    = L('Cash_pay_name');   
		$modules['pay_code']    = 'Cash';
		$modules['pay_desc']    = L('Cash_pay_desc');
		$modules['is_cod']  = '0';
		$modules['is_online']  = '1';
		$modules['author']  = '爱是西瓜';
		$modules['website'] = '';
		$modules['version'] = '1.0.0';
		$modules['config']  = array();

		return $modules;
	}

	public function get_code(){
		return;
	}
	public function respond()
    {
		return;
	}
}
?>