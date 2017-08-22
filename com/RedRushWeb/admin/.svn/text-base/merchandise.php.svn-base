<?php
/*
 *	M.Babar Jihad
 *	23 Februari 2012
 * 	
 */
include_once $ENGINE_PATH."Admin/UserManager.php";
include_once $ENGINE_PATH."Utility/Paginate.php";
include_once APP_PATH.APPLICATION."/models/merchandiseModel.php";
include_once APP_PATH.APPLICATION."/helper/trashHelper.php";
class merchandise extends SQLData{
	var $fronList = array();
	var $frontPaging;
	var $ftitle;
	var $fdetail;
	var $fdate;
	var $_msg='';
	var $_imgNum=1;
	var $_img=array();
	var $_param = 'merchandise';
	var $model;
	var $trash;
	function __construct($req){
		parent::SQLData();
		$this->Request = $req;
		$this->View = new BasicView();
		$this->model = new merchandiseModel();
		$this->trash = new trashHelper();
		if($req){
			$this->User = new UserManager();
		}
	}
	function admin(){
		$req = $this->Request;
		if( $req->getParam('act') == 'add'){
			return $this->addMerch($req);
		}elseif( $req->getParam('act') == 'edit'){
			return $this->editMerch($req);
		}elseif( $req->getParam('act') == 'change-status'){
			return $this->changeStatus($req);
		}elseif( $req->getParam('act') == 'delete'){
			return $this->delete($req);
		}elseif( $req->getParam('act') == 'purchase-list'){
			return $this->listPurchase($req);
		}elseif( $req->getParam('act') == 'del-purchase'){
			return $this->deletePurchase($req);
		}elseif( $req->getParam('act') == 'change-purchase'){
			return $this->changePurchase($req);
		}elseif( $req->getParam('act') == 'test'){
			return $this->test($req);
		}else{
			return $this->listMerch($req);
		}
	}
	
	function test(){
		$folder = "../public_html/js/";
		$nfolder = "public_html/js";
		$file = 'popup.js'; 
		$this->trash->execute($folder,$file,$nfolder);
		//$this->trash->mkdir_array();
	}
	
	function addMerch(){
		$save = $this->Request->getPost('save');
		
		if($save==1){
			$name = $this->Request->getPost('name');
			$amount = $this->Request->getPost('amount');
			$prize = $this->Request->getPost('prizes');
			$desc = $this->Request->getPost('desc');
			$status = $this->Request->getPost('status');
			
			// primary image
			$img_name = $_FILES['images']['name'];
			$img_loc = $_FILES['images']['tmp_name'];
			$img_type = $_FILES['images']['type'];
			$img_newname = "merch_".date('YmdHis');
			
			// thumbnail image
			$timg_name = $_FILES['timages']['name'];
			$timg_loc = $_FILES['timages']['tmp_name'];
			$timg_type = $_FILES['timages']['type'];
			$timg_newname = "thumb_".$img_newname;
			
			//declare extension primary image
			if($img_type=='image/jpeg'){$ext = '.jpg';}
			if($img_type=='image/png'){$ext = '.png';}
			if($img_type=='image/gif'){$ext = '.gif';}
			
			//declare extension thumbnail image
			if($timg_type=='image/jpeg'){$t_ext = '.jpg';}
			if($timg_type=='image/png'){$t_ext = '.png';}
			if($timg_type=='image/gif'){$t_ext = '.gif';}
			
			// new file
			$newfile = $img_newname.$ext; // new file name for primary image
			$thumbfile = $timg_newname.$t_ext; // new file name for thumbnail image
			$folder = "../public_html/img/merchandise/";
			//echo $newfile;
			
			$form = array("name"=>$name,"amount"=>$amount,"prizes"=>$prize);
			$this->View->assign('form',$form);
			
			if($name == '' && $amount == '' && $prizes == '' && $desc == '' && $img_name == '' && $timg_name == ''){
				$err = 'Please Complete the form!';
			}else{
				if(!is_numeric($amount)){
					$err = "Amount must be a numeric!";
					//return false;
				}
				elseif(!is_numeric($prize)){
					$err = "Prizes must be a numeric!";
					//return false;
				}
				elseif($ext!='.jpg' && $ext!='.png' && $ext!='.gif'){
					$err = "Invalid file type! (Allowed: *.jpg, *.gif, *.png)";//return false;
				}
				elseif($t_ext!='.jpg' && $t_ext!='.png' && $t_ext!='.gif'){
					$err = "Invalid file type! (Allowed: *.jpg, *.gif, *.png)";//return false;
				}
				else{
					global $ENGINE_PATH;
					/* include_once $ENGINE_PATH."Utility/Thumbnail.php";	
					$thumb 	= new Thumbnail(); */
					if(move_uploaded_file($img_loc,$folder.$newfile)){
						if(move_uploaded_file($timg_loc,$folder.$thumbfile)){
							$data['name'] = $name;
							$data['amount'] = $amount;
							$data['prizes'] = $prize;
							$data['desc'] = $desc;
							$data['img'] = $newfile;
							$data['status'] = $status;
							$q	= $this->model->addMerchandise($data);
							if($q){
								$msg = "Success add new merchandise!";
							}
							else{
								$err = mysql_error();
								$err = "failed upload image! $err";
								/* $this->trash->execute($folder,$newfile);
								$this->trash->execute($folder,$thumbfile); */
								@unlink($folder.$newfile);
								@unlink($folder.$thumbfile);
							}
							$this->close();
							return $this->View->showMessage($msg, "index.php?s=merchandise");
						}
						else{ 
								$err = "failed processing the image"; 
								@unlink($folder.$newfile);
						}
					}
					else{
						$err = "failed move upload file";
					}
				}
				
			}
			
		}
		$this->View->assign('err',$err);
		return $this->View->toString(APPLICATION."/admin/merchandise/merch_add.html");
	}
	
	function editMerch(){
		$id = $this->Request->getParam('id');
		$list = $this->model->getMerchandiseByID($id);
		$form = array("name"=>$list['item_name'],"amount"=>$list['amount'],"prizes"=>$list['prize'],"desc"=>$list['description'],"img"=>$list['img'],"timg"=>"thumb_".$list['img'],"status"=>$list['n_status']);
		$save = $this->Request->getPost('save');
		
		if($save==1){
			$name = $this->Request->getPost('name');
			$amount = $this->Request->getPost('amount');
			$prize = $this->Request->getPost('prizes');
			$desc = $this->Request->getPost('desc');
			$status = $this->Request->getPost('status');
			
			//echo $newfile;
			$form = array("name"=>$name,"amount"=>$amount,"prizes"=>$prize,"desc"=>$desc,"img"=>$list['img'],"timg"=>"thumb_".$list['img'],"status"=>$list['n_status']);
			
			if($name == '' && $amount == '' && $prizes == '' && $desc == ''){
				$err = 'Please Complete the form!';
			}else{
				if(!is_numeric($amount)){
					$err = "Amount must be a numeric!";
					
					//return false;
				}
				elseif(!is_numeric($prize)){
					$err = "Prizes must be a numeric!";
					//return false;
				}
				else{
					if(empty($_FILES['images']['name']) && empty($_FILES['timages']['name'])){
						$data['name'] = $name;
						$data['amount'] = $amount;
						$data['prize'] = $prize;
						$data['desc'] = $desc;
						$data['status'] = $status;
						$q	= $this->model->editMerchandise($id,$data,0);
						if($q){
								$msg = "Success edit merchandise!";
						}
						else{
							$err = mysql_error();
							$err = "failed upload image! $err";
						}
						return $this->View->showMessage($msg, "index.php?s=merchandise");
						
					}else{
						// primary images data
						$img_name = $_FILES['images']['name'];
						$img_loc = $_FILES['images']['tmp_name'];
						$img_type = $_FILES['images']['type'];
						$img_newname = "merch_".date('YmdHis');
						
						// thumbnail images data
						$timg_name = $_FILES['timages']['name'];
						$timg_loc = $_FILES['timages']['tmp_name'];
						$timg_type = $_FILES['timages']['type'];
						$timg_newname = "thumb_".$img_newname;
						
						//declare extension
						if($img_type=='image/jpeg'){$ext = '.jpg';}
						if($img_type=='image/png'){$ext = '.png';}
						if($img_type=='image/gif'){$ext = '.gif';}
						//declare thumbnail extension
						if($timg_type=='image/jpeg'){$t_ext = '.jpg';}
						if($timg_type=='image/png'){$t_ext = '.png';}
						if($timg_type=='image/gif'){$t_ext = '.gif';}
						
						$newfile = $img_newname.$ext; // new images name
						$thumbfile = $timg_newname.$t_ext; // new thumbnail name
						
						if($ext!='.jpg' && $ext!='.png' && $ext!='.gif'){
							$err = "Invalid file type! (Allowed: *.jpg, *.gif, *.png)";//return false;
						}elseif($t_ext!='.jpg' && $t_ext!='.png' && $t_ext!='.gif'){
							$err = "Invalid file type! (Allowed: *.jpg, *.gif, *.png)";//return false;
						}else{
							/* global $ENGINE_PATH;
							include_once $ENGINE_PATH."Utility/Thumbnail.php";	
							$thumb 	= new Thumbnail(); */
							$folder = "../public_html/img/merchandise/";
							$nfolder = "public_html/img/merchandise/";
							if(move_uploaded_file($img_loc,$folder.$newfile)){
								if(move_uploaded_file($timg_loc,$folder.$thumbfile)){
									$data['name'] = $name;
									$data['amount'] = $amount;
									$data['prize'] = $prize;
									$data['desc'] = $desc;
									$data['img'] = $newfile;
									$data['status'] = $status;
									$q	= $this->model->editMerchandise($id,$data,1);
									if($q){
										$msg = "Success edit merchandise!";
										$this->trash->execute($folder,$list['img'],$nfolder); // copy file ke trash
										$this->trash->execute($folder,"thumb_".$list['img'],$nfolder); // copy file ke trash
										@unlink($folder.$list['img']);
										@unlink($folder."thumb_".$list['img']);
									}
									else{
										$err = mysql_error();
										$err = "failed upload image! $err";
									}
									return $this->View->showMessage($msg, "index.php?s=merchandise");
								}
								else{ 
										$err = "failed processing the image"; 
									}
							}
							else{
								$err = "failed move upload file";
							}
						}
					}
				}
				
			}
			
		}
		$this->View->assign('form',$form);
		$this->View->assign('err',$err);
		return $this->View->toString(APPLICATION."/admin/merchandise/merch_edit.html");
	}
	
	function listMerch($req,$total_per_page=50){
		
		$start = $this->Request->getParam("st");
		$this->Request->getParam("q")  != '' ? $q = " && rr_merchandise.item_name LIKE '%".$this->Request->getParam("q")."%'" : $q = "";
		
		if($start==NULL){$start = 0;}
		$list=$this->model->getMerchandise($start,$total_per_page,$q);
		$total = $this->model->countAll($q);
		
		$this->View->assign("q",$this->Request->getParam("q") );
		$this->View->assign("list",$list);
		$this->Paging = new Paginate();
		$page = $this->Paging->getAdminPaging($start,$total_per_page,$total,'index.php?s=merchandise&q='.$this->Request->getParam("q"));
		$this->View->assign("paging",$page);
		return $this->View->toString(APPLICATION."/admin/merchandise/merch_list.html");
	}
	
	function changeStatus(){
		$id = intval($this->Request->getParam('id'));
		$status = intval($this->Request->getParam('status'));
		if($id==null && $status==null){
			return $this->listMerch();
		}else{
			$r = $this->model->changeStatus($id,$status);
			if($r){
				sendRedirect('index.php?s=merchandise');exit;
			}else{
				sendRedirect('index.php?s=merchandise');exit;
			}
		}
	}
	
	function delete(){
		$id = intval($this->Request->getParam('id'));
		if($id==null){
			return $this->listMerch();
		}else{
			$i = "SELECT img FROM ".RedRushDB.".rr_merchandise WHERE id='".$id."'";
			$this->open(0);
			$img = $this->fetch($i);
			//print_r($img);exit;
			$this->close();
			$folder = "../public_html/img/merchandise/";
			$nfolder = "public_html/img/merchandise/";
			$this->trash->execute($folder,$img['img'],$nfolder); // copy file ke trash
			$this->trash->execute($folder,"thumb_".$img['img'],$nfolder); // copy file ke trash
			@unlink($folder.$img['img']);
			@unlink($folder.'thumb_'.$img['img']);
			
			$r = $this->model->deleteMerchandise($id);
			if($r){
				sendRedirect('index.php?s=merchandise');exit;
			}else{
				sendRedirect('index.php?s=merchandise');exit;
			}
		}
	}
	
	function listPurchase($req,$total_per_page=50){
		
		$start = $this->Request->getParam("st");
		$this->Request->getParam("q")  != '' ? $q = " && (m.item_name LIKE '%".$this->Request->getParam("q")."%' OR u.name LIKE '%".$this->Request->getParam("q")."%')" : $q = "";
		
		if($start==NULL){$start = 0;}
		$list=$this->model->getPurchaseList($start,$total_per_page,$q);
		$total = $this->model->countPurchase($q);
		
		$this->View->assign("q",$this->Request->getParam("q") );
		$this->View->assign("list",$list);
		$this->Paging = new Paginate();
		$page = $this->Paging->getAdminPaging($start,$total_per_page,$total,'index.php?s=merchandise&act=purchase-list&q='.$this->Request->getParam("q"));
		$this->View->assign("paging",$page);
		return $this->View->toString(APPLICATION."/admin/merchandise/purch_list.html");
	}
	
	function deletePurchase(){
		$id = intval($this->Request->getParam('id'));
		if($id==null){
			return $this->listPurchase();
		}else{
			$r = $this->model->deletePurchase($id);
			if($r){
				sendRedirect('index.php?s=merchandise&act=purchase-list');exit;
			}else{
				sendRedirect('index.php?s=merchandise&act=purchase-list');exit;
			}
		}
	}
	
	/* Change Purchase Status */
	function changePurchase(){
		$id = $this->Request->getPost('id');
		$stat = $this->Request->getPost('status');
		
		if($stat!='' && $id!=''){
			if($stat==0){
				$q = "UPDATE ".RedRushDB.".rr_purchase_merchandise SET n_status='0' WHERE id='".$id."';";
				$data= '<font color=gray>successfully pending.</font>';
			}
			elseif($stat==1){
				$q = "UPDATE ".RedRushDB.".rr_purchase_merchandise SET n_status='1' WHERE id='".$id."';";
				$data= '<font color=green>successfully approved.</foto>';
			}
			else{
				$q = "UPDATE ".RedRushDB.".rr_purchase_merchandise SET n_status='2' WHERE id='".$id."';";
				$data= '<font color=red>successfully rejected.</font>';
			}
			$this->open(0);
			$f = $this->query($q);
			$this->close();
			if($f){
				echo $data;
				exit;
			}
			else{
				$data = "<font color='red'>Failed 1!</font>";
				echo $data;
				exit;
			}
		}
		else{
			$data = "<font color='red'>Failed 2!</font>";
			echo $data;
			exit;
		}
	}
	
	function fixTinyEditor($content){
		global $CONFIG;
		$content = str_replace("\\r\\n","",$content);
		$content = htmlspecialchars(stripslashes($content), ENT_QUOTES);
		$content = str_replace("../contents", "contents", $content);
		//$content = htmlspecialchars( stripslashes($content) );
		$content = str_replace("&lt;", "<", $content);
		$content = str_replace("&gt;", ">", $content);
		return $content;
	}
	function showTinyEditor($content){
		global $CONFIG;
		$content = str_replace("contents/", "../contents/", $content);
		return $content;
	}
}
?>
