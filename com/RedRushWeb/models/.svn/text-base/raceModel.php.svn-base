<?php
	class raceModel extends SQLData{
		function __construct(){ parent::SQLData();	}
		
		/**
		 * get random user untuk halaman race - choose your opponent
		 * @todo
		 * yang ditarik hanya user2 yang levelnya sama atau lebih besar dari si user.
		 * @param $user_id
		 */
		function getOpponent($user_id,$start=0,$total=10){
			$start = intval($start);
			//$q = "SELECT id,name,img,small_img FROM kana_member WHERE id <> ".$user_id." AND n_status=1 LIMIT ".$start.",".$total;
			$q = "SELECT a.*,b.level,d.title_name FROM ".RedRushDB.".kana_member a
				LEFT JOIN ".GameDB.".racing_level b	ON a.id = b.user_id
				LEFT JOIN ".RedRushDB.".rr_user_title c ON c.user_id=a.id
				LEFT JOIN ".RedRushDB.".tbl_ref_title d  ON c.title_id = d.id 
				WHERE a.id <> ".$user_id." AND a.n_status=1 LIMIT ".$start.",".$total;
			$this->open(0);
			$r = $this->fetch($q,1);
			$this->close();
			return $r;
		}
		
		
		
	}
?>