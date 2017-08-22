<?php /* Smarty version 2.6.13, created on 2012-02-17 13:15:30
         compiled from RedRushWeb//challenge-finish.html */ ?>


<div id="main-container" class="bg-challenge">
	<div class="wrapper">
    	<div id="containers">
        	<div id="challenge-box">
            	<div class="player-box">
                    <div class="thumb">
                        <a href="garages.php"><img src="img/thumb.jpg" /></a>
                    </div><!-- .thumb -->
                    <div class="caption">
                        <span class="username">Player A</span>
                    </div><!-- .caption -->
                </div>
                <div class="vs"></div>
            	<div class="player-box">
                    <div class="thumb">
                        <a href="garages.php"><img src="img/thumb.jpg" /></a>
                    </div><!-- .thumb -->
                    <div class="caption">
                        <span class="username">PlayerB</span>
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
                        <h1>Race Report</h1>
                    </div><!-- .title -->
                    <?php if ($this->_tpl_vars['result']['is_winner'] == 1): ?>
                    <div class="wins">
                        <div class="cup">
                            <img src="img/trophy.png" />
                        </div>
                        <div class="message">
                            <h1>You Win  !</h1>
                          <h2>Your Point<br />
                                + <?php echo $this->_tpl_vars['result']['point']; ?>
 Pts</h2>
                            <a href="index.php?page=race&act=challenge&rtoken=<?php echo $this->_tpl_vars['rtoken']; ?>
">Race Again</a>
                            <a href="index.php?page=race">Find Another User</a>
                        </div>
                    </div><!-- .wins -->
                    <?php else: ?>
                    <div class="loser">
                        <div class="message">
                            <h1>You LOSE  !</h1>
                            <!-- <h2>Your Point<br />
                                 0 Pts</h2> -->
                            <a href="index.php?page=race&act=challenge&rtoken=<?php echo $this->_tpl_vars['rtoken']; ?>
">Race Again</a>
                            <a href="index.php?page=race">Find Another User</a>
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
                        	<div class="username">Player 1</div>
                        	<div class="bar">
                         	   <img class="progress" src="img/progress-bar.gif" width="10px" height="50%" />
                               <div class="small-car" style="position:absolute; bottom:50%">
                               	<img src="img/car-red.png" />
                               </div>
                            </div>
                        </div>
                    	<div class="players">
                        	<div class="username">Player 2</div>
                        	<div class="bar">
                         	   <img class="progress" src="img/progress-bar.gif" width="10px" height="30%" />
                               <div class="small-car" style="bottom:30%">
                               	<img src="img/car-grey.png" />
                               </div>
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
	var no = 0;
	'; ?>

	var maxNo = <?php echo $this->_tpl_vars['total']; ?>
;
	<?php echo '
	//alert(maxNo);
	var top=0;
	var refreshId = setInterval(function()
	{
		no++;
		//$("#rowreport"+no).show(slow);
		
		$("#rowreport"+no).attr(\'style\',\'display:block;color:yellow\');
		if(no<=maxNo) $("#rowreport"+(no-1)).attr(\'style\',\'color:white\');
		
		//if(no>=5 && no<=maxNo) $(".scrollbar-pane").attr(\'style\',\'top:\'+((top+=50)*(-1))+\'px;left: 0px; position: absolute; overflow: visible; height: auto;\');
		//$(".scrollbar-pane").scrollTop(no*100);
		//$("#race-report").prepend(\'<div class="row" id="rowreport"><p>{$report.txt[i]}</p></div>\');
	}, 2000);
	//scrollTop($(document).height())
	//alert($(\'.scrollbar\').height());
});</script>
'; ?>