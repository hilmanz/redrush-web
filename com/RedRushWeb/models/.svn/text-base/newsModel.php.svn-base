<?php
	class newsModel extends App{
		function __construct(){ }
		
		function getNews($id=null){
			$q = "SELECT * FROM ".DB_PREFIX."_news WHERE id='".$id."' LIMIT 1";
			$this->open(0);
			$r = $this->fetch($q);
			$this->close();
			return $r;
		}
		
		function getLatest($limit=1){
			$q = "SELECT * FROM ".DB_PREFIX."_news ORDER BY id DESC LIMIT ".$limit;
			$this->open(0);
			$r = $this->fetch($q,1);
			$this->close();
			return $r;
		}
		
		function getFeatured($limit=1){
			$q = "SELECT * FROM ".DB_PREFIX."_news WHERE featured='1' ORDER BY id DESC LIMIT ".$limit;
			$this->open(0);
			$r = $this->fetch($q,1);
			$this->close();
			return $r;
		}
	}
?>