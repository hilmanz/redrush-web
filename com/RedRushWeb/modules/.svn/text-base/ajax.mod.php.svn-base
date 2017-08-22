<?php
class ajax extends App{
	
	var $Request;
	
	var $View;
	

	function __construct($req){
		$this->Request = $req;
		$this->setVar();
				
	}
	
	function tlu001(){
	
			require_once APP_PATH.APPLICATION."/helper/activityReportHelper.php";
			$log = new activityReportHelper($this->Request,$this->user->id);
			$log->activityTime();
			die();			
	}
	
	// function paut001(){
	
	// require_once APP_PATH.APPLICATION."/helper/apiHelper.php";
	// $API = new apiHelper();
	// $data = json_decode($API->add_title_to_all_user(true));
	// die();	
	// }
	
	function qr001(){
	//use token sha1(date(Ymd.arukaterra))
	require_once APP_PATH.APPLICATION."/helper/apiHelper.php";
	$API = new apiHelper();
	$data = json_decode($API->add_all_qr_user(true));
	die();	
	
	}
	
	function ru001(){
	//use token sha1(date(Ymd.arukaterra))
	require_once APP_PATH.APPLICATION."/helper/apiHelper.php";
	$API = new apiHelper();
	$data = json_decode($API->add_user_rank(true));
	die();	
	}
	
	
	function addProgressBar(){
	require_once APP_PATH.APPLICATION."/helper/apiHelper.php";
	$API = new apiHelper();
	// if(file_exists(APP_PATH.APPLICATION."/helper/apiHelper.php")) echo 'ada';
	$part_id = $this->Request->getPost('part_id');
	 // $part_id = 7;
	$data = $API->add_progress_bar($part_id);
	header('Content-type: application/json');
	echo $data;
	die();	
	
	}
	
}

?>