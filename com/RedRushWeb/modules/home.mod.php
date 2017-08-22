<?php
class home extends App{
	
	var $Request;
	
	var $View;
	
	var $newsModel;
	var $model;
	var $API;
	
	function __construct($req){
		$this->Request = $req;
		$this->View = new BasicView();
		// print_r($this->loginHelper->checkLogin());
		$this->setVar();
		require_once APP_PATH.APPLICATION."/models/newsModel.php";
		$this->newsModel = new newsModel();
		require_once APP_PATH.APPLICATION."/helper/apiHelper.php";
		$this->API = new apiHelper();
		include_once APP_PATH.APPLICATION.'/models/raceModel.php';
		$this->model = new raceModel();
	}
	
	function paralax(){
	
		
		if( ! $this->loginHelper->checkLogin() ){
				
						sendRedirect('logout.php');
					
					exit;
				
			}
		return $this->contentString("/landing.html",true);
	
	}
	
	function loading(){
		if( ! $this->loginHelper->checkLogin() ){
				
					sendRedirect('logout.php');
					
					exit;
				
			}
		ob_start();
		$this->assign('loadIt','home');
		$this->assign('targetIt','index.php?page=home&act=main');
		//img
		// $imagesDir = 'img/';
		// $img = glob($imagesDir . '*.{png}', GLOB_BRACE);
		$img[0] = 'img/coundown_panel.png';
		$img[1] = 'img/lampu_merah.png';
		$img[2] = 'img/lampu_hijau.png';
		$img[3] = 'img/bg_profile2.png';
		$img[4] = 'img/bg_profile.png';
		$img[5] = 'img/box_reds.png';
		$img[6] = 'img/frame.png';
		$img[7] = 'img/progress-bar.png';
		$img[8] = 'img/bg_panel_small.png';
		$img[9] = 'img/bg_panel.png';
		$img[10] = 'img/bg_panel2.png';
		$img[11] = 'img/bg_newsfeed.png';
		$this->assign('img', $img);
		
		//img topview
		$imagesDir = 'img/topview/';
		$topview = glob($imagesDir . '*.{png}', GLOB_BRACE);
		$this->assign('topview', $topview);
			
		return $this->contentString("/loading.html",true);
	
	}
	
	
	function main(){
			if( ! $this->loginHelper->checkLogin() ){
				
					sendRedirect('logout.php');
					
					exit;
				
			}
			
			$racer = $this->model->getOpponent($this->user->id,0,2);
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
				//pastiin untuk mengosongkan array lagi.. hemat memory.
				$players = null;
				$topUser[$n]->racing_token = NULL;
				if($v->id!=$this->user->id) $topUser[$n]->racing_token = $racing_token;
				
			}
			
			$this->assign('top_user',$topUser);
			$topUser=NULL;
		
			$news = $this->newsModel->getLatest(4);
			$this->assign('news',$news);
			$news=NULL;
			
			//notification			
			$notification = json_decode($this->API->get_user_notification($this->user->id,10));
			$this->assign('notification',$notification);
			
			
			//player
			// print_r('<pre>');print_r($this->user);exit;
			$this->assign('user_name',$this->user->name);
			
			$this->log('page','home');
			return $this->contentString("/home.html",true);
		
	}

}