<?php /* Smarty version 2.6.13, created on 2012-03-21 14:41:27
         compiled from RedRushWeb//garages.html */ ?>

<div id="main-container">
	<div class="wrapper">
    	<div id="containers">
        	<div id="garage">
            	<div id="profile">
                	<div class="thumb"><img src="<?php if ($this->_tpl_vars['player']['small_img'] == ''): ?> img/thumb.jpg <?php else: ?> contents/avatar/small/<?php echo $this->_tpl_vars['player']['small_img']; ?>
 <?php endif; ?>" /></div>
                    <div class="box-user">
                    	<span class="username"><?php echo $this->_tpl_vars['player']['name']; ?>
</span>
                    	<span class="reputation"><?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['player']['level']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
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
?><img src="img/star.png" alt="" /><?php endfor; endif; ?></span>
                    	<span class="total-race"><?php echo $this->_tpl_vars['player']['races']; ?>
 Race</span>
                    	<span class="total-win"><?php echo $this->_tpl_vars['player']['wins']; ?>
 Wins</span>
                    </div>
                </div><!-- #profile -->
            	<div id="score">
                	
                </div><!-- #score -->
            	<div id="car">
 					<img id="wings" class="wingscarLeft" src="" />
                	<img  id="body" src="contents/car/body/default.png" />
					<img id="tire" class="tirecarLeft" src="contents/car/tire/default.png" />
					<img id="decals" class="decalscarLeft" src="" />
					<img id="tints" class="tintscarLeft" src="contents/car/tints/default.png" />
					<img id="hoods" class="hoodscarLeft" src="" />
                </div><!-- #car -->
                <div id="statistik">
                	<div id="topspeed" class="gradient">
                    	<span>TOP SPEED</span>
                        <div class="progress"><img src="img/progress-bar.gif" width="<?php echo $this->_tpl_vars['player']['attributes']['speed']; ?>
%" height="10" /></div>
                  </div>
                	<div id="handling" class="gradient">
                    	<span>HANDLING</span>
                        <div class="progress"><img src="img/progress-bar.gif" width="<?php echo $this->_tpl_vars['player']['attributes']['handling']; ?>
%" height="10" /></div>
                    </div>
                	<div id="accleration" class="gradient">
                    	<span>ACCELERATION</span>
                        <div class="progress"><img src="img/progress-bar.gif" width="<?php echo $this->_tpl_vars['player']['attributes']['acceleration']; ?>
%" height="10" /></div>
                    </div>
                </div><!-- #statistik -->
                <div id="button-race">
                	<a href="index.php?page=race&act=challenge&rtoken=<?php echo $this->_tpl_vars['rtoken']; ?>
" class="race-now">&nbsp;</a>
                	<a href="#" onclick="history.back();" class="back-now">&nbsp;</a>
                </div><!-- #button-race -->
                <!-- 
                <div id="button-vote">
                	<a href="#" class="vote-now">&nbsp;</a>
                </div>
                 -->
            </div><!-- #garage -->
        </div><!-- #containers -->
    </div><!-- .wrapper -->
</div><!-- #main-container -->

<?php echo '
<script>
$(document).ready(function() {
	$(document).keydown(function(event) {
		  if ( event.ctrlKey==true || event.keyCode == 123) {
			 return false;
		   }
		});
var carLayer = \'carLeft\';
'; ?>

var carBody = "<?php if ($this->_tpl_vars['body']['type'] == ''): ?>porche<?php else:  echo $this->_tpl_vars['body']['type'];  endif; ?>";
var bodyColor = "<?php if ($this->_tpl_vars['body']['color'] == ''): ?>default<?php else:  echo $this->_tpl_vars['body']['color'];  endif; ?>";
var tireColor = "<?php if ($this->_tpl_vars['tire']['color'] == ''): ?>default<?php else:  echo $this->_tpl_vars['tire']['color'];  endif; ?>";
var decalsColor = "<?php if ($this->_tpl_vars['decals']['color'] == 'default'):  else:  echo $this->_tpl_vars['decals']['color'];  endif; ?>";
var tintsColor = "<?php if ($this->_tpl_vars['tints']['color'] == 'default'):  else:  echo $this->_tpl_vars['tints']['color'];  endif; ?>";
var wingsColor = "<?php if ($this->_tpl_vars['wings']['color'] == 'default'):  else:  echo $this->_tpl_vars['wings']['color'];  endif; ?>";
var hoodsColor = "<?php if ($this->_tpl_vars['hoods']['color'] == 'default'):  else:  echo $this->_tpl_vars['hoods']['color'];  endif; ?>";
<?php echo '

$(\'#car img#body\').attr(\'src\',\'contents/\'+carLayer+\'/\'+carBody+\'/body/\'+bodyColor+\'.png\');
$(\'#car img#tire\').attr(\'src\',\'contents/\'+carLayer+\'/\'+carBody+\'/tire/\'+tireColor+\'.png\');
$(\'#car img#decals\').attr(\'src\',\'contents/\'+carLayer+\'/\'+carBody+\'/decals/\'+decalsColor+\'.png\');
$(\'#car img#tints\').attr(\'src\',\'contents/\'+carLayer+\'/\'+carBody+\'/tints/\'+tintsColor+\'.png\');
$(\'#car img#wings\').attr(\'src\',\'contents/\'+carLayer+\'/\'+carBody+\'/wings/\'+wingsColor+\'.png\');	
$(\'#car img#hoods\').attr(\'src\',\'contents/\'+carLayer+\'/\'+carBody+\'/hoods/\'+hoodsColor+\'.png\');	



});

</script>
'; ?>