<?php

class Mdpass extends Think {

    public $password;
    public $passcode;
	public $name;
    

    public function __construct($password,$passcode,$name) {
        $this->password = $password;
        $this->passcode = $passcode;
		$this->name = $name;
    }
 
	public function disshow($password,$passcode,$name){
        $password = md5($this->strmd($password,$passcode)).md5($name.base64_decode($password));
		return $password;
    }

	public function strmd($password,$passcode){
		$codestr = $password.substr($this->decbinfc($passcode),0,2);
		return $codestr;
	}
	
	public function decbinfc($passcode){
		$number = $this->md5fc(decbin($passcode));
		return $number;
	}
	
	public function md5fc($passcode){
		$number = md5($passcode);
		return $number;
	}

}
?>