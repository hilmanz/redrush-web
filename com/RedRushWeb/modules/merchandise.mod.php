<?php
class merchandise extends App{
	
	var $Request;
	
	var $View;
			
	var $API;
	
	function __construct($req){
		$this->Request = $req;
		$this->View = new BasicView();
		$this->setVar();
		require_once APP_PATH.APPLICATION."/helper/apiHelper.php";
		$this->API = new apiHelper();
		
	}
	
	function home(){

			$act = $this->Request->getParam('act');
			if($act) return $this->$act;
			else return $this->merchandiseList();
		
	}
	
	function merchandiseList(){
	
	$player = $this->user;
	$playerdata = json_decode($this->API->getPlayerData($player->id));
	$getMerchandise = json_decode($this->API->getMerchandise($player->id));
	
	foreach($getMerchandise as $n=>$v){
			$getMerchandise[$n]->ownMerchandise = json_decode($this->API->getOwnMerchandise($player->id,$getMerchandise[$n]->id));
		}
	
	foreach($playerdata as $key => $value){
		$this->assign($key,$value);		
		}
		
	$this->assign('merchandise',$getMerchandise);
	$this->log('page','merchandiseList');
	// print_r('<pre>'); print_r($getMerchandise);exit;
				if($this->user->verified!='1') return $this->contentString("/not_verified_merchandise.html",true);
	return $this->contentString("/merchandise.html",true);
	
	}
	
	function merchandiseDetail(){
		$player = $this->user;
		$merchandiseID = $this->Request->getParam('merchandiseID');
		$playerdata = json_decode($this->API->getPlayerData($player->id));
		$getMerchandise = json_decode($this->API->getMerchandiseByID($merchandiseID));
		$ownMerchandise = json_decode($this->API->getOwnMerchandise($player->id,$merchandiseID));
	
	
		foreach($playerdata as $key => $value){
		$this->assign($key,$value);		
		}
		$this->assign('ownPart',$ownMerchandise);
		
		$this->assign('merchandise',$getMerchandise);	
		$this->log('page','merchandiseDetail');
		return $this->contentString("/merchandiseDetail.html",true);
		
	}
	function redeem_form(){
	
	if($this->Request->getParam('merchandise_id')){
		$player = $this->user;
		$merchandise_id = $this->Request->getParam('merchandise_id');
		$playerdata = json_decode($this->API->getPlayerData($player->id));
		$getMerchandise = json_decode($this->API->getMerchandiseByID($merchandise_id));
		$ownMerchandise = json_decode($this->API->getOwnMerchandise($player->id,$merchandise_id));
		foreach($playerdata as $key => $value){
		$this->assign($key,$value);		
		}
		$this->assign('ownPart',$ownMerchandise);
		$this->assign('merchandise',$getMerchandise);	
		$this->log('page','redeem');
				
		$this->log('redeem_merchandise',$merchandise_id);
		
		}		
		// echo $purchaseMerchandise->message ;exit();
		return $this->contentString("/redeem.html",true);
	}
	
	function purchaseMerchandise(){
		
	
		if($this->Request->getPost('checkTOS')=='on'){
		
		$player = $this->user;
		$playerdata = json_decode($this->API->getPlayerData($player->id));
		$merchandise_id = $this->Request->getPost('merchandise_id');
		//form merchandise
		$data_personal['address']= $this->Request->getPost('address');
		$data_personal['phone']= $this->Request->getPost('phone');
		$data_personal['mobile']= $this->Request->getPost('mobile');
		$data_personal['city_name']= $this->Request->getPost('city_name');
		$data_personal['zip_code']= $this->Request->getPost('zip_code');
		// print_r($data_personal);exit;
		$purchaseMerchandise = json_decode($this->API->purchaseMerchandise($playerdata->id,$merchandise_id,$data_personal));
		// print_r($purchaseMerchandise->result); exit;
		
		if($purchaseMerchandise->result==1) $this->log('redeem_merchandise',$merchandise_id);
		sendRedirect("index.php?page=merchandise");
		}		
		
		sendRedirect("index.php?page=merchandise");
		
		
	}
	
	
}