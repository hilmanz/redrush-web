<?php

class race extends App{
	var $Request;
	var $View;
	var $API;
	var $model;
	
	
	function __construct($req){
		$this->Request = $req;
		$this->View = new BasicView();
		$this->setVar();
		require_once APP_PATH.APPLICATION."/helper/apiHelper.php";
		$this->API = new apiHelper();
		include_once APP_PATH.APPLICATION.'/models/raceModel.php';
		$this->model = new raceModel();	
		
	}
	
	function home(){
		
		$userData = json_decode($this->API->getPlayerData($this->user->id));
		foreach($userData as $key => $value){
		$this->assign($key,$value);
		}
	
		$ultimateCar = json_decode($this->API->get_ultimate_car($this->user->id,$userData->level));
			
		if($ultimateCar){
			$csrf_token = sha1(date("YmdHis").rand(0,999));
			$csrf_token_sessid = sha1($csrf_token.$this->user->id);
			$_SESSION[$csrf_token_sessid] = 1;
			$players = array("player1"=>$this->user->id,"player2"=>$ultimateCar->id,'ctoken'=>$csrf_token);
			$racing_token = urlencode64(serialize($players));
			$players = null;
			$ultimateCar->racing_token = NULL;
			if($v->id!=$this->user->id) $ultimateCar->racing_token = $racing_token;
		
		}
// print_r('<pre>');print_r($ultimateCar);exit;
		$this->assign('ultimateCar',$ultimateCar);
		
		$ultimateCar=NULL;
		
		// print_r($userData->level);exit;
		$racer = $this->model->getOpponent($this->user->id);
		//generat racing token for each opponent
		foreach($racer as $n=>$v){
			$csrf_token = sha1(date("YmdHis").rand(0,999));
			$csrf_token_sessid = sha1($csrf_token.$this->user->id);
			$_SESSION[$csrf_token_sessid] = 1;
			$players = array("player1"=>$this->user->id,"player2"=>$v['id'],'ctoken'=>$csrf_token);
			$racing_token = urlencode64(serialize($players));
			//pastiin untuk mengosongkan array lagi.. hemat memory.
			$players = null;
			$racer[$n]['racing_token'] = $racing_token;
		}
		$this->assign('racer',$racer);

		$racer=NULL;
		
		$topUser = json_decode($this->API->getTopUser(2));
		foreach($topUser as $n=>$v){
			$csrf_token = sha1(date("YmdHis").rand(0,999));
			$csrf_token_sessid = sha1($csrf_token.$this->user->id);
			$_SESSION[$csrf_token_sessid] = 1;
			$players = array("player1"=>$this->user->id,"player2"=>$v->id,'ctoken'=>$csrf_token);
			$racing_token = urlencode64(serialize($players));
			$players = null;
			$topUser[$n]->racing_token = NULL;
			if($v->id!=$this->user->id) $topUser[$n]->racing_token = $racing_token;
		}
	
		$this->assign('top_user',$topUser);

		$topUser=NULL;
		
		$userData=NULL;
		$this->log('page','race');
		if($this->user->verified!='1') return $this->contentString("/not_verified_race.html",true);
		return $this->contentString("/race.html",true);
	}
	
	function challenge(){
	
		if($this->user->verified!='1') return $this->contentString("/not_verified_race.html",true);
		
		$sessionTokenRace = json_decode($this->API->addSessionRaceToken($this->user->id));
		// print_r($sessionTokenRace);exit;
		$rtoken = $this->Request->getParam('rtoken');
		$req_info = unserialize(urldecode64($rtoken));
		
		$player1Level = json_decode($this->API->getPlayerData($req_info['player1']));
		$player2Level = json_decode($this->API->getPlayerData($req_info['player2']));
		// print_r($player1Level->level-1);exit;
		if(! (($player2Level->level >= ($player1Level->level-1)) && ($player2Level->level <= ($player1Level->level+1)))) {
		$this->assign('message','Sorry you can only challenge users the same level as you or above');
		$this->assign('go_url','race');
		sendRedirect("?page=race");
		return $this->contentString("/message_redrush.html",true);
		}	
		
		$csrf_token = $req_info['ctoken'];
		$csrf_token_sessid = sha1($csrf_token.$this->user->id);
		//make sure that the csrftoken exist in session
		if($_SESSION[$csrf_token_sessid]!=null){
			$racereport = $this->API->getRaceReport($rtoken);
			$report = json_decode($racereport);
			if(($caps50 = $report->caps50)==1) $this->assign('caps50',1);
			if(($caps10 = $report->caps10)==1) $this->assign('caps10',1);
			if(($caps50 = $report->caps50)==1) {
			$this->assign('message','Sorry you have reached your race limit, come again tomorrow to race');
			$this->assign('go_url','race');
			sendRedirect("?page=race");
			return $this->contentString("/message_redrush.html",true);
			}
			if(($caps10 = $report->caps10)==1) {
			// print_r($report->player2->name);exit;
			$this->assign('message',"You've already challenge ".$report->player2->name." 10 times, Try Again tomorrow !");
			$this->assign('go_url','race');
			sendRedirect("?page=race");
			return $this->contentString("/message_redrush.html",true);
			}
			
			
			// print_r('<pre>');print_r($caps50);exit;
			$rpt['circuit_name'] = $report->circuit_name;
			$rpt['circuit_distance'] = $report->circuit_distance;
			$rpt['circuit_desc'] = $report->circuit_desc;
			$rpt['race_sessid'] = $report->race_session_id;
			$rpt['txt'] = $report->txt;
		
			
			
			foreach($report->results as $key => $value){
			$user1 = 1; $user2 = 1; 
			$user1progValue = $value->user1_prog;
			$user2progValue = $value->user2_prog;
			if($user1progValue>$user2progValue)$user1 = 2;
			if($user1progValue<$user2progValue) $user2 = 2;
								
			$rpt['user1_prog'][] = $user1;
			$rpt['user2_prog'][] = $user2;

			$user1prog+=$user1progValue+1;
			$user2prog+=$user2progValue+1;
			
			$user1progTotal+=($user1)*4.5;
			$user2progTotal+=($user2)*4.5;

			}
			
			$this->assign('user1prog',$user1prog);
			$this->assign('user2prog',$user2prog);
			global $WIN_PENALTY;
			// Print_r('<pre>');print_r($user1prog);print_r($user2prog);print_r($report->results);exit;
			// $rpt['user1_prog'][] = (($value->user1_prog)+2)*4.5;
			// $rpt['user2_prog'][] = (($value->user2_prog)+2)*4.5;
			// $user1prog+=(($value->user1_prog)+2);
			// $user2prog+=(($value->user2_prog)+2);
			
			foreach($report->player1 as $key => $value){
			$rpt['player1'][$key] = $value;
			}
			foreach($report->player2 as $key => $value){
			$rpt['player2'][$key] = $value;
			}
			$this->assign('player1',$rpt['player1']);
			$this->assign('player2',$rpt['player2']);
				
			$total = count($rpt['txt']);
			$this->assign('total',$total);
			$this->assign('user1progTotal',$user1progTotal);
			$this->assign('user2progTotal',$user2progTotal);
			
			$this->assign('report',$rpt);
			
			//reset csrf token
			$_SESSION[$csrf_token_sessid]=null;
			
			//getAvatarCar
			$this->getAvatarCar($report->player1->id,$report->player2->id);
			
			$is_winner = 0;
			if($user1prog>$user2prog) $is_winner = 1;
			if($user1prog==$user2prog) $is_winner = 2;
			
			$this->assign('is_winner',$is_winner);
			$this->assign('points',5);
			
			$this->log('race',$report->player2->id);
			$email_notification_report = array('report'=>$report->txt,'circuit'=>$report->circuit_name);
			$this->finish($is_winner,$report->player2->id,$sessionTokenRace,$caps50,$caps10,$email_notification_report);
			$email_notification_report = null;
			$report = null;
			if($this->user->verified!='1') return $this->contentString("/not_verified_race.html",true);
			return $this->contentString("/challenge.html",true);
		}else{
			sendRedirect("?page=race");
			exit();
		}
	}
	
	function getAvatarCar($player1_id,$player2_id){
			require_once APP_PATH.APPLICATION."/helper/carHelper.php";
			$this->CAR = new carHelper($req);
			$carDataPlayer1 = json_decode($this->CAR->getCarData($player1_id));
			$carDataPlayer2 = json_decode($this->CAR->getCarData($player2_id));
			// print_r($carDataPlayer1->data->body->color);exit;
			if($carDataPlayer1->data->body->color=='default') $carDataPlayer1->data->body->color = 'red';
			if($carDataPlayer2->data->body->color=='default') $carDataPlayer2->data->body->color = 'red';
			$this->assign('bodyCarColorPlayer1',$carDataPlayer1->data->body->color);
			$this->assign('bodyCarColorPlayer2',$carDataPlayer2->data->body->color);
			$carDataPlayer1 =null;$carDataPlayer2=null;
	}
	
	function finish($is_winner=0,$opponent_id=null,$sessionTokenRace,$caps50,$caps10,$email_notification_report){
		
		if($opponent_id==null) return false;
		$data=0;
		$winner = $opponent_id;
		if($is_winner==1) {
		$winner = $this->user->id;
			if($caps50==0) {
				if($caps10==0){
		
				$this->API->addGameRacePoint($this->user->id,$sessionTokenRace);
				$data = json_decode($this->API->add_user_title($this->user->id));
				}
			}
		}
	
		$this->assign('getTitle',$data);
		$data=null;
		
		$csrf_token = sha1(date("YmdHis").rand(0,999));
		$csrf_token_sessid = sha1($csrf_token.$this->user->id);
		$_SESSION[$csrf_token_sessid] = 1;
		$players = array("player1"=>$this->user->id,"player2"=>$opponent_id,'ctoken'=>$csrf_token);
		$racing_token = urlencode64(serialize($players));
		//pastiin untuk mengosongkan array lagi.. hemat memory.
		$players = null;
		$this->assign('race_again_token',$racing_token);
		
		//send mail
			// Print_r('<pre>');print_r($email_notification_report);exit;
			$this->API->send_user_notification_email($this->user->id,$opponent_id,$winner,$email_notification_report);
		
		
	}
	
	//ultimate challenge
	function challenge_ultimate(){
		if($this->user->verified!='1') return $this->contentString("/not_verified_race.html",true);			
		$sessionTokenRace = json_decode($this->API->addSessionRaceToken($this->user->id));
		// print_r($sessionTokenRace);exit;
		$rtoken = $this->Request->getParam('rtoken');
		$req_info = unserialize(urldecode64($rtoken));
		
		$csrf_token = $req_info['ctoken'];
		$csrf_token_sessid = sha1($csrf_token.$this->user->id);
		//make sure that the csrftoken exist in session
		if($_SESSION[$csrf_token_sessid]!=null){
			$racereport = $this->API->getRaceReport_ultimate($rtoken);
			$report = json_decode($racereport);
			// print_r('<pre>');print_r($report);exit;
			$rpt['circuit_name'] = $report->circuit_name;
			$rpt['circuit_distance'] = $report->circuit_distance;
			$rpt['circuit_desc'] = $report->circuit_desc;
			$rpt['race_sessid'] = $report->race_session_id;
			$rpt['txt'] = $report->txt;
			
			foreach($report->results as $key => $value){
			$user1 = 1; $user2 = 1; 
			$user1progValue = $value->user1_prog;
			$user2progValue = $value->user2_prog;
			if($user1progValue>$user2progValue) $user1 = 2;
			if($user1progValue<$user2progValue) $user2 = 2;
								
			$rpt['user1_prog'][] = $user1;
			$rpt['user2_prog'][] = $user2;

			$user1prog+=$user1progValue+1;
			$user2prog+=$user2progValue+1;
			
			$user1progTotal+=($user1)*4.5;
			$user2progTotal+=($user2)*4.5;

			}
			
			$this->assign('user1prog',$user1prog);
			$this->assign('user2prog',$user2prog);
			
			// Print_r('<pre>');print_r($report);print_r($user1prog.'-');print_r($user2prog);exit;

			foreach($report->player1 as $key => $value){
			$rpt['player1'][$key] = $value;
			}
			
			$ultimate_data = json_decode($this->API->get_ultimate_car_by_id($req_info['player2']));
			// Print_r('<pre>');print_r($ultimate_data);exit;
			foreach($ultimate_data as $key => $value){
			$rpt['player2'][$key] = $value;
			}
			$this->assign('player1',$rpt['player1']);
			$this->assign('player2',$rpt['player2']);
				
			$total = count($rpt['txt']);
			$this->assign('total',$total);
			$this->assign('user1progTotal',$user1progTotal);
			$this->assign('user2progTotal',$user2progTotal);
			
			$this->assign('report',$rpt);
			
			//reset csrf token
			$_SESSION[$csrf_token_sessid]=null;
			
			//getAvatarCar_ultimate
			$this->getAvatarCar_ultimate($report->player1->id,$req_info['player2']);
			
			$is_winner = 0;
			if($user1prog>$user2prog) $is_winner = 1;
			if($user1prog==$user2prog) $is_winner = 2;
			
			$this->assign('is_winner',$is_winner);
			$this->assign('points',5);
			
			$this->log('race',$req_info['player2']);
			
			$this->finish_ultimate($is_winner,$req_info['player2'],$sessionTokenRace);
			$report = null;
			if($this->user->verified!='1') return $this->contentString("/not_verified_race.html",true);
			return $this->contentString("/challenge_ultimate.html",true);
		}else{
			sendRedirect("?page=race");
			exit();
		}
	}
	
	function getAvatarCar_ultimate($player1_id,$player2_id){
			require_once APP_PATH.APPLICATION."/helper/carHelper.php";
			$this->CAR = new carHelper($req);
			$carDataPlayer1 = json_decode($this->CAR->getCarData($player1_id));
			if($carDataPlayer1->data->body->color=='default') $carDataPlayer1->data->body->color = 'red';
			$this->assign('bodyCarColorPlayer1',$carDataPlayer1->data->body->color);
			$this->assign('bodyCarColorPlayer2','yellow');
			$carDataPlayer1 =null;$carDataPlayer2=null;
	}
	
	function finish_ultimate($is_winner=0,$opponent_id=null,$sessionTokenRace){
		if($opponent_id==null) return false;
		$data=0;
		if($is_winner==1) {
		$userData = json_decode($this->API->getPlayerData($this->user->id));
		// add flag winner ultimate
		$win_ultimate = json_decode($this->API->win_ultimate_car($this->user->id,$opponent_id,$userData->level));
		$this->API->addGameRacePoint($this->user->id,$sessionTokenRace,2000);
		}
		$this->assign('getTitle',$data);
		$data=null;
		
	}

}
?>