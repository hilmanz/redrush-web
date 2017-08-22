<?php
	class merchandiseModel extends SQLData{
		function __construct(){ parent::SQLData();	}
		
		function countAll($q=null){
			$q = "SELECT COUNT(*) total FROM ".RedRushDB.".rr_merchandise
				WHERE 1 $q";
			$this->open(0);
			$r = $this->fetch($q);
			$this->close();
			return $r['total'];
		}
		
		function getMerchandise($start=0,$total=1,$q=null){
		
			//id 	item_name 	amount 	prize 	img 	created_date 	n_status 
			$q = "
				SELECT * FROM ".RedRushDB.".rr_merchandise
				WHERE 1 $q LIMIT ".$start.",".$total;
			$this->open(0);
			$r = $this->fetch($q,1);
			$this->close();
			return $r;
		}
		
		function getMerchandiseByID($id=null){
			if($id==null)return false;
			//id 	item_name 	amount 	prize 	img 	created_date 	n_status 
			$q = "
				SELECT * FROM ".RedRushDB.".rr_merchandise
				WHERE id=".$id.";";
			$this->open(0);
			$r = $this->fetch($q);
			$this->close();
			return $r;
		}
		
		
		function addMerchandise($data){
		
			
			//id 	item_name 	amount 	prize 	img 	created_date 	n_status 
			$q = "
					INSERT INTO ".RedRushDB.".rr_merchandise 
					(id, item_name, amount, prize, description, img, created_date, n_status) 
					VALUES 
					(NULL, '".$data['name']."', ".$data['amount'].", ".$data['prizes'].", '".$data['desc']."', '".$data['img']."', now(), '".$data['status']."')";
			$this->open(0);
			$r = $this->query($q);
			$this->close();
			return $r;
		}
		
		
		function editMerchandise($item_id,$data,$img=0){
			if($item_id==NULL) return false;
			if($img==1){
				$q = "
				UPDATE ".RedRushDB.".rr_merchandise 
				SET 
					item_name = '".$data['name']."',
					amount = ".$data['amount'].", 
					prize = ".$data['prize'].", 
					description = '".$data['desc']."',
					img = '".$data['img']."', 
					n_status = '".$data['status']."' 
				WHERE 
					id = ".$item_id."";
			}else{
				$q = "
				UPDATE ".RedRushDB.".rr_merchandise 
				SET 
					item_name = '".$data['name']."',
					amount = ".$data['amount'].", 
					prize = ".$data['prize'].", 
					description = '".$data['desc']."',
					n_status = '".$data['status']."' 
				WHERE 
					id = ".$item_id."";
			}
			$this->open(0);
			$r = $this->query($q);
			$this->close();
			return $r;
		}
		
		
		function changeStatus($id,$n_status){
			$q = "UPDATE ".RedRushDB.".rr_merchandise 
			SET 
				n_status = '".$n_status."' 
			WHERE 
				id = ".$id."";
			$this->open(0);
			$r = $this->query($q);
			$this->close();
			return $r;
		}
		
		function deleteMerchandise($id){
			$q = "DELETE FROM ".RedRushDB.".rr_merchandise WHERE id='".$id."'";
			$this->open(0);
			$r = $this->query($q);
			$this->close();
			return $r;
		}
		
		function getPurchaseList($start=0,$total=1,$q=null){
			$q = "SELECT u.name AS user_name, m.item_name, pm.* 
					FROM ".RedRushDB.".rr_purchase_merchandise pm 
					INNER JOIN ".RedRushDB.".rr_merchandise m 
					ON m.id = pm.merchandise_id 
					INNER JOIN ".RedRushDB.".kana_member u 
					ON u.id = pm.user_id 
					LEFT JOIN tbl_form_merchandise fm
					ON fm.purchase_merchandise_id=pm.purchase_merchandise_id
				WHERE 1 $q 
				ORDER BY pm.purchase_date DESC 
				LIMIT ".$start.",".$total;
			$this->open(0);
			$r = $this->fetch($q,1);
			$this->close();
			return $r;
		}
		
		function countPurchase($q=null){
			$q = "SELECT COUNT(*) total
				FROM ".RedRushDB.".rr_purchase_merchandise pm
					INNER JOIN ".RedRushDB.".rr_merchandise m
					ON m.id = pm.merchandise_id
					INNER JOIN ".RedRushDB.".kana_member u
					ON u.id = pm.user_id
					LEFT JOIN tbl_form_merchandise fm
					ON fm.purchase_merchandise_id=pm.purchase_merchandise_id
				WHERE 1 $q";
			$this->open(0);
			$r = $this->fetch($q);
			$this->close();
			return $r['total'];
		}
		
		function deletePurchase($id){
			$q = "DELETE FROM ".RedRushDB.".rr_purchase_merchandise WHERE id='".$id."'";
			$this->open(0);
			$r = $this->query($q);
			$this->close();
			return $r;
		}
		
	}
?>