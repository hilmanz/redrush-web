<?php
class recentactivity extends App{
	
	var $Request;
	
	var $View;
	
	function __construct($req){
		$this->Request = $req;
		$this->View = new BasicView();
		$this->setVar();
	}
	function home(){
		return $this->contentString("/recentactivity.html",true);
	}

}
?>