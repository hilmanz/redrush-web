<?php
class news extends App{
	
	var $Request;
	
	var $View;
	
	var $newsModel;
	
	function __construct($req){
		$this->Request = $req;
		$this->View = new BasicView();
		$this->setVar();
		require_once APP_PATH.APPLICATION."/models/newsModel.php";
		$this->newsModel = new newsModel();
	}
	
	function home(){
		if( ! $this->loginHelper->checkLogin() ){
			sendRedirect('login.php');
			exit;
		}
		else{
			$news = $this->newsModel->getLatest(4); // get latest news
			$featured = $this->newsModel->getFeatured(3); // get latest featured news
			//print_r($featured);exit;
			$this->assign('news',$news);
			$this->assign('featured',$featured);
			$this->assign('home',true);
			$this->log('page','news');
			return $this->contentString("/news.html",true);
		}
	}
	
	// View News Function
	function view(){
		$id = strip_tags($this->Request->getParam('nid'));
		if($id!=null){
			$featured = $this->newsModel->getFeatured(3); // get latest featured news
			$view = $this->newsModel->getNews($id);
			//print_r($view);exit;
			$this->log('article',$id); // Log article
			$this->assign('view',$view);
			$this->assign('featured',$featured);
			$this->assign('home',true);
			return $this->contentString("/news_view.html",true);
		}
		else{
			sendRedirect('index.php?page=news');
			exit;
		}
	}
	
	function recent(){
		if( ! $this->loginHelper->checkLogin() ){
			sendRedirect('login.php');
			exit;
		}
		else{
		require_once APP_PATH.APPLICATION."/helper/apiHelper.php";
		$this->API = new apiHelper();
		//notification			
			$notification = json_decode($this->API->get_all_user_notification(10));
			$this->assign('notification',$notification);
			$featured = $this->newsModel->getFeatured(3); // get latest featured news
			// print_r($notification);exit;
			$this->assign('featured',$featured);
			$this->assign('recent_activity',true);
			$this->log('page','recent');
			return $this->contentString("/recentactivity.html",true);
		}
	}

}