<?php 
class MopTracker{
	var $strHTML = "";
	var $strScript = "";
	function __construct(){
		
	}
	function track($sessId,$PageRef,$ActivityName,$ActivityValue,$CPMOO,$user){
		$params = array('sessId'=>$sessId,"PageRef"=>$PageRef,"ActivityName"=>$ActivityName,"ActivityValue"=>$ActivityValue,"CPMOO"=>$CPMOO,"user"=>$user);
		$r = urlencode64(serialize($params));
		
		$this->strHTML.="document.write('<img src=\'img.php?r=".$r."\'/>');";
		
		$this->strScript.="<img src=\'img.php?r=".$r."\'/>";
		
	}
	function trackNoRun($sessId,$PageRef,$ActivityName,$ActivityValue,$CPMOO,$user){
		$params = array('sessId'=>$sessId,"PageRef"=>$PageRef,"ActivityName"=>$ActivityName,"ActivityValue"=>$ActivityValue,"CPMOO"=>$CPMOO,"user"=>$user);
		$r = urlencode64(serialize($params));
		
		return "<img src=\'img.php?r=".$r."\'/>";
		
	}
	function getEmbedScript(){
		return $this->strHTML;
	}
	function getScript(){
		
		return $this->strScript;
	}
}
?>
