<?php /* Smarty version 2.6.13, created on 2012-03-22 17:01:19
         compiled from RedRushWeb//challenge.html */ ?>
<?php echo '
<style>

#challenge-finish-report{
	margin: -200px 0 0 -225px;
    width: 470px;
	}
#challenge-finish-report .entry{
padding: 10px 30px 0;
}
#challenge-finish-report .title {
    margin: 0 0 15px;
    overflow: hidden;
    padding: 0;
}

.vOff{
visibility: hidden;
}
.vOn{
visibility: visible;
}
</style>

'; ?>

<div id="main-container" class="bg-challenge">
	<div class="wrapper">
     <?php echo '
        <noscript><h1 style="font-size:36px; color:#FFF; position:fixed; top:55%; left:37%;">Please Enable Your Javascript!</h1></noscript>
    '; ?>

    	<div id="countdown">
        	<div class="panel-countdown">
            	<div class="red-lamp lamp1"></div>
            	<div class="red-lamp lamp2"></div>
            	<div class="red-lamp lamp3"></div>
            	<div class="red-lamp lamp4"></div>
            	<div class="green-lamp lamp5"></div>
            </div>
        </div>
    	<div id="containers">
        	<div id="challenge-box">
            	<div class="player-box">
                    <div class="thumb">
                        <a  href="index.php?page=garage"><img src="<?php if ($this->_tpl_vars['player1']['small_img'] == ''): ?> img/thumb.jpg <?php else: ?> contents/avatar/small/<?php echo $this->_tpl_vars['player1']['small_img']; ?>
 <?php endif; ?>" /></a>
                    </div><!-- .thumb -->
                    <div class="caption">
                        <span class="username"><?php echo $this->_tpl_vars['player1']['name']; ?>
</span>
                    </div><!-- .caption -->
                </div>
                <div class="vs"></div>
            	<div class="player-box">
                    <div class="thumb">
                        <a  href="index.php?page=garage&rtoken=<?php echo $this->_tpl_vars['race_again_token']; ?>
"><img src="<?php if ($this->_tpl_vars['player2']['small_img'] == ''): ?> img/thumb.jpg <?php else: ?> contents/avatar/small/<?php echo $this->_tpl_vars['player2']['small_img']; ?>
 <?php endif; ?>" /></a>
                    </div><!-- .thumb -->
                    <div class="caption">
                        <span class="username"><?php echo $this->_tpl_vars['player2']['name']; ?>
</span>
                    </div><!-- .caption -->
                </div>
			</div>
            <div class="box sircuit-name" id="circuit"> 
                <div class="titles">
                    <h1>circuit</h1>
                </div><!-- .title -->  
                <div class="entry">
                    <div class="row">
                        <h2><?php echo $this->_tpl_vars['report']['circuit_name']; ?>
</h2>
                        <h3><?php echo $this->_tpl_vars['report']['circuit_desc']; ?>
</h3>
                    </div><!-- .row -->
                </div><!-- .red-box -->
            </div><!-- .sircuit-name -->  
            <div class="logo">
            	<a href="index.php">&nbsp;</a>
            </div><!-- .logo -->
			    <div class="panel3" id="challenge-report">
			       	<div class="entry">
                    <div class="title">
                        <h1>Race Report <?php if ($this->_tpl_vars['caps50']): ?>(You've won race 50 times )<?php else:  if ($this->_tpl_vars['caps10']): ?>(You've won race this player 10 times )<?php endif;  endif; ?> </h1>
                        <input name="race_sessid" type="hidden" value="<?php echo $this->_tpl_vars['report']['race_sessid']; ?>
" />
                    </div><!-- .title -->
                    <div class="scrollbar" style="overflow:auto">
                    	<div class="box report" id="race-report" style="height:1000px;">
                        <?php $this->assign('nom', $this->_tpl_vars['total']); ?>
						
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['report']['txt']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['step'] = ((int)-1) == 0 ? 1 : (int)-1;
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
						<?php if ($this->_tpl_vars['nom'] == 1): ?> <div class="row reportClass" style="display:block;color:yellow" prog1="<?php echo $this->_tpl_vars['report']['user1_prog'][$this->_sections['i']['index']]; ?>
" prog2="<?php echo $this->_tpl_vars['report']['user2_prog'][$this->_sections['i']['index']]; ?>
" id="rowreport<?php echo $this->_tpl_vars['nom']; ?>
" ><p><?php echo $this->_tpl_vars['report']['txt'][$this->_sections['i']['index']]; ?>
</p></div>
                        <?php else: ?> <div nowrap class="row reportClass" style="display:none;" id="rowreport<?php echo $this->_tpl_vars['nom']; ?>
" prog1="<?php echo $this->_tpl_vars['report']['user1_prog'][$this->_sections['i']['index']]; ?>
" prog2="<?php echo $this->_tpl_vars['report']['user2_prog'][$this->_sections['i']['index']]; ?>
"><p><?php echo $this->_tpl_vars['report']['txt'][$this->_sections['i']['index']]; ?>
</p></div>
						<?php endif; ?>
                        <?php $this->assign('nom', $this->_tpl_vars['nom']-1); ?>
                        <?php endfor; endif; ?>
                        	
                        </div><!-- .box -->
                    </div><!-- .scrollbar -->
				  <div class="wins" >
                   <div style="width: 100%; text-align: left; padding-left: 55px; padding-top: 20px;" class="message">
                   <a href="index.php?page=race&amp;act=challenge&amp;rtoken=<?php echo $this->_tpl_vars['race_again_token']; ?>
"  style="display:none" class="check-race-report1" >Race Again</a> 
                   <a href="index.php?page=race" class="check-race-report2" style="display:none" >Find Another User</a>
				  </div>
				   </div>
                </div><!-- .entry -->
            </div><!-- .panel -->
			
			<div class="panel3" id="challenge-finish-report" style="display:none">
            	<div class="entry">
                    <div class="title">
                        <h1>Race Report</h1>
                    </div><!-- .title -->
                    <?php if ($this->_tpl_vars['is_winner'] == 1): ?>
                    <div class="wins">
                        <div class="cup">
                            <img src="img/trophy.png" />
                        </div>
                        <div class="message">
                          <h1>You Win  !</h1>
						   <?php if ($this->_tpl_vars['caps50']):  else: ?>
						   <?php if ($this->_tpl_vars['caps10']):  else: ?> 
						   <h2>Your Point<br />+ <?php echo $this->_tpl_vars['points']; ?>
 Pts</h2>
						   <?php endif;  endif; ?>
                         
                            <a href="index.php?page=race&act=challenge&rtoken=<?php echo $this->_tpl_vars['race_again_token']; ?>
">Race Again</a>
                            <a href="index.php?page=race">Find Another User</a>
							<a href="javascript:void(0)" class="check-report">See Race Report</a>
                        </div>
                    </div><!-- .wins -->
					<?php elseif ($this->_tpl_vars['is_winner'] == 2): ?>
                    <div class="loser">
                        <div class="cup">
                            <img src="img/draw.png" />
                        </div>
                        <div class="message">
                            <h1>DRAW  !</h1>
                            <a href="index.php?page=race&act=challenge&rtoken=<?php echo $this->_tpl_vars['race_again_token']; ?>
">Race Again</a>
                            <a href="index.php?page=race">Find Another User</a>
							<a href="javascript:void(0)" class="check-report">See Race Report</a>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="loser">
                        <div class="cup">
                            <img src="img/lose.png" />
                        </div>
                        <div class="message">
                            <h1>You LOSE  !</h1>
                            <a href="index.php?page=race&act=challenge&rtoken=<?php echo $this->_tpl_vars['race_again_token']; ?>
">Race Again</a>
                            <a href="index.php?page=race">Find Another User</a>
							<a href="javascript:void(0)" class="check-report">See Race Report</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div><!-- .entry -->
            </div><!-- .panel -->
			
            <div id="sidebar">
            	<div class="entry">
              		                      <div id="circuit-progress">
                    	<div class="titles">
                        	<h1>RACE Indicator</h1>
                        </div>
                    	<div class="players">
                        	<div class="username"><?php echo $this->_tpl_vars['player1']['name']; ?>
</div>
                        	<div class="bar">
                         	   <img class="progress prog1"  src="img/progress-bar.gif" width="10px" height="0%" />
                               <div class="small-car prog1car small-<?php echo $this->_tpl_vars['bodyCarColorPlayer1']; ?>
" style="position:absolute; bottom:0%"></div>
                            </div>
                        </div>
                    	<div class="players">
                        	<div class="username"><?php echo $this->_tpl_vars['player2']['name']; ?>
</div>
                        	<div class="bar">
                         	   <img class="progress prog2" src="img/progress-bar.gif" width="10px" height="0%" />
                               <div class="small-car prog2car small-<?php echo $this->_tpl_vars['bodyCarColorPlayer2']; ?>
" style="bottom:0%"></div>
                            </div>
                        </div>
                    </div>
                </div><!-- .entry -->
            </div><!-- #sidebar -->
        </div><!-- #containers -->
    </div><!-- .wrapper -->
</div><!-- #main-container -->



<?php echo '
<script>
$(document).ready(function() {
	$(document).keydown(function(event) {
		  if ( event.ctrlKey==true || event.keyCode == 123 || event.keyCode == 116 || event.keyCode == 8) {
			 return false;
		   }
		});
	$(\'#containers\').hide();
	var no = 0;
	'; ?>

	var maxNo = <?php if ($this->_tpl_vars['total'] == ''): ?>50<?php else:  echo $this->_tpl_vars['total'];  endif; ?>;
	var user1 = <?php if ($this->_tpl_vars['user1prog'] == ''): ?>50<?php else:  echo $this->_tpl_vars['user1prog'];  endif; ?>;
	var user2 = <?php if ($this->_tpl_vars['user2prog'] == ''): ?>50<?php else:  echo $this->_tpl_vars['user2prog'];  endif; ?>;
	var fullLap=parseInt(user2);
	if(user1>user2) fullLap = parseInt(user1);
	
	var user1prog = (((parseInt(user1)/fullLap))*90)/10;
	var user2prog = (((parseInt(user2)/fullLap))*90)/10;
	var user1name = '<?php echo $this->_tpl_vars['player1']['name']; ?>
';
	var user2name = '<?php echo $this->_tpl_vars['player2']['name']; ?>
';
	var user1car = <?php if ($this->_tpl_vars['total'] == ''): ?>'red'<?php else: ?>'<?php echo $this->_tpl_vars['bodyCarColorPlayer1']; ?>
'<?php endif; ?>;
	var user2car = <?php if ($this->_tpl_vars['total'] == ''): ?>'blue'<?php else: ?>'<?php echo $this->_tpl_vars['bodyCarColorPlayer2']; ?>
'<?php endif; ?>;
	//var totalProg1 = ( <?php echo $this->_tpl_vars['user1progTotal']; ?>
 + user1prog) / 10 ;
	//var totalProg2 = ( <?php echo $this->_tpl_vars['user2progTotal']; ?>
 + user2prog) / 10 ;
	<?php echo '
	
	var top=0;
	var prog1 = 0;
	var prog2 = 0;
	var add1 = 0;
	var add2 = 0;
	var searchFlagRacer;
	var arrsearchFlagRacer;

	
		$("#rowreport1").attr(\'style\',\'color:yellow;text-align:center\');
		$("#rowreport1").animate({fontSize: "30px"});
		
	function lamp1(){
		$(\'.lamp1\').animate({opacity:0},0).delay(800).animate({opacity:1}, 800);
	}
	function lamp2(){
		$(\'.lamp2\').animate({opacity:0},0).delay(1600).animate({opacity:1}, 800);
	}
	function lamp3(){
		$(\'.lamp3\').animate({opacity:0},0).delay(2400).animate({opacity:1}, 800);
	}
	function lamp4(){
		$(\'.lamp4\').animate({opacity:0},0).delay(3200).animate({opacity:1}, 800);
	}
	function lamp5(){
		$(\'.lamp5\').animate({opacity:0},0).delay(4000).animate({opacity:1}, 800);

	}
	function racenow(){
		//$(\'#countdown\').delay(4800).animate({opacity:0}, 800);
		$(\'#countdown\').delay(4800).slideUp(200);
		//$(\'#containers\').animate({opacity:0},0).delay(4800).animate({opacity:1}, 800, function() {
			$(\'#containers\').delay(4800).show(200, function() {
		startRace();
	 
	});  
		
	}
	lamp1();
	lamp2();
	lamp3();
	lamp4();
	lamp5();
	racenow();	
		
	function startRace(){	
	var overtake = 0;

	var refreshId = setInterval(function()
	{
		no++;
		
		if(no<=maxNo){ 
		$(\'body\').css(\'cursor\', \'none\');
		$("#rowreport"+(no-1)).attr(\'style\',\'color:#ccc; width:90%;  font-family: KlavikaLightCapsLight; text-transform:uppercase;\');

		if(no>1){
			if ( $.browser.msie ) {
			$("#rowreport"+no).attr(\'style\',\'color:yellow; width:90%; font-size:30px;  text-align:center;font-family: KlavikaBold;text-transform:uppercase;\');
			$("#rowreport"+no).fadeIn(1000);
			}else{
			$("#rowreport"+no).attr(\'style\',\'color:yellow; width:90%;  text-align:center;font-family: KlavikaBold;text-transform:uppercase;\');
			$("#rowreport"+no).animate({fontSize: "30px"});	
			}
		//prog1+=parseInt($("#rowreport"+(no)).attr(\'prog1\'))+totalProg1;
		//prog2+=parseInt($("#rowreport"+(no)).attr(\'prog2\'))+totalProg2;
		searchFlagRacer = $(\'#rowreport\'+(no)+\' p span\').attr(\'class\');
		//hasAccident = $(\'#rowreport\'+(no)+\' p span\').attr(\'class\');
		if(overtake==1 ){
		$(\'.prog2car\').html(\'<img src="img/topview/car_top_\'+user2car+\'.png" />\');
		$(\'.prog1car\').html(\'<img src="img/topview/car_top_\'+user1car+\'.png" />\');
		overtake=0;
		}
		
		if(searchFlagRacer){
		arrsearchFlagRacer = searchFlagRacer.split(\'_\');
		if(arrsearchFlagRacer[0]==\'takeover\'){
			if(arrsearchFlagRacer[1]==user1name) {add1 = 3;$(\'.prog1car\').html(\'<img src="img/topview/car_top_\'+user1car+\'_ot.png" />\');$(\'.prog1car\').removeClass(\'small-\'+user1car);$(\'.prog1car\').fadeOut();}
			if(arrsearchFlagRacer[1]==user2name) {add2 = 3;$(\'.prog2car\').html(\'<img src="img/topview/car_top_\'+user2car+\'_ot.png" />\');$(\'.prog2car\').removeClass(\'small-\'+user2car);$(\'.prog2car\').fadeOut();}
			overtake = 1;
		}
		
		if(arrsearchFlagRacer[0]==\'accident\'){
			if(arrsearchFlagRacer[1]==user1name) {add2 = 3;$(\'.prog1car\').html(\'<img src="img/topview/car_top_\'+user1car+\'_crash.png" />\');$(\'.prog1car\').removeClass(\'small-\'+user1car);$(\'.prog1car\').fadeOut();}
			if(arrsearchFlagRacer[1]==user2name) {add1 = 3;$(\'.prog2car\').html(\'<img src="img/topview/car_top_\'+user2car+\'_crash.png" />\');$(\'.prog2car\').removeClass(\'small-\'+user2car);$(\'.prog2car\').fadeOut();}
			}
		
		
		if(arrsearchFlagRacer[0]==\'dominate\'){
			if(arrsearchFlagRacer[1]==user1name) {$(\'.prog1car\').html(\'<img src="img/topview/car_top_\'+user1car+\'_ot.png" />\');$(\'.prog1car\').removeClass(\'small-\'+user1car);$(\'.prog1car\').fadeOut();}
			if(arrsearchFlagRacer[1]==user2name) {$(\'.prog2car\').html(\'<img src="img/topview/car_top_\'+user2car+\'_ot.png" />\');$(\'.prog2car\').removeClass(\'small-\'+user2car);$(\'.prog2car\').fadeOut();}
			overtake = 1;
		}
		}
		prog1+=parseInt(user1prog)+0.5+add1;
		prog2+=parseInt(user2prog)+0.5+add2;
		if(add1==3) {add1=0;}	
		if(add2==3) {add2=0;}
		$(\'.prog2car\').fadeIn();
		$(\'.prog1car\').fadeIn();
		$(\'.prog1\').height(prog1+\'%\');
		//$(\'.prog1car\').animate({"bottom": +prog1+\'%\'}, "slow");
		//$(\'.prog2\').height(prog2+\'%\');
		//$(\'.prog2car\').animate({"bottom": +prog2+\'%\'}, "slow");
			if ( $.browser.msie ) {
			$(\'.prog1car\').attr(\'style\',\'bottom: \'+prog1+\'%\');
			$(\'.prog2\').height(prog2+\'%\');
			$(\'.prog2car\').attr(\'style\',\'bottom:\' +prog2+\'%\');
			}else{
				$(\'.prog1car\').animate({"bottom": +prog1+\'%\'}, "slow");
				$(\'.prog2\').height(prog2+\'%\');
				$(\'.prog2car\').animate({"bottom": +prog2+\'%\'}, "slow");
			}
		
		}
		
		}
		
		if(no>maxNo){ 
		$(\'body\').css(\'cursor\', \'pointer\');
		clearInterval(refreshId);
		$(\'#challenge-report\').fadeOut();
		$(\'#challenge-finish-report\').fadeIn();
		
		
		}
		
		//if(no>=5 && no<=maxNo) $(".scrollbar-pane").attr(\'style\',\'top:\'+((top+=50)*(-1))+\'px;left: 0px; position: absolute; overflow: visible; height: auto;\');
	
		
	}, 2000);
	
	}
	
	$(\'.check-report\').click(function(){
	$(\'#challenge-finish-report\').fadeOut();
	$(\'#challenge-report\').fadeIn();
	$(\'.check-race-report1\').attr(\'style\',\'display:inline-block;\');
	$(\'.check-race-report2\').attr(\'style\',\' display: inline-block;float: right;padding-right: 45px;\');
	
	});
	

	
});</script>

<script type="text/javascript" src="js/jquery.scroll.min.js"></script>
<script type="text/javascript">
  $(\'.scrollbar\').scrollbar();
</script>
'; ?>