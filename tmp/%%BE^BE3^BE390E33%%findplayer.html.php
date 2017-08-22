<?php /* Smarty version 2.6.13, created on 2012-03-16 14:47:46
         compiled from RedRushWeb//findplayer.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'RedRushWeb//findplayer.html', 19, false),)), $this); ?>

<div id="main-container" class="lights">
	<div class="wrapper">
    	<div id="containers">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "RedRushWeb/topuserSubmenu.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <div class="logo">
            	<a href="index.php">&nbsp;</a>
            </div><!-- .logo -->
            <div class="panel2">
            	<div class="entry" style="padding:0 30px 0 50px;">
                    <div class="title">
                        <h1>We Found XX Player</h1>
                    </div><!-- .title -->
                        <div class="scrollbar" style="height:250px;">
                            <div class="box racer">
							<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['player']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?>
                                <div class="row">
                                    <div class="thumb">
                                        <a href="index.php?page=garage&rtoken=<?php echo ((is_array($_tmp=$this->_tpl_vars['player'][$this->_sections['i']['index']]->racing_token)) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
"><img src="<?php if ($this->_tpl_vars['player'][$this->_sections['i']['index']]->small_img == ''): ?> img/thumb.jpg <?php else: ?> contents/avatar/small/<?php echo $this->_tpl_vars['player'][$this->_sections['i']['index']]->small_img; ?>
 <?php endif; ?>" /></a>
                                    </div><!-- .thumb -->
                                    <div class="caption">
                                        <span class="username"><?php echo $this->_tpl_vars['player'][$this->_sections['i']['index']]->name; ?>
</span>
                                        <span class="reputation"><?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['player'][$this->_sections['i']['index']]->level) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?><img src="img/star.png" alt="" /><?php endfor; endif; ?></span>
                                        <span class="level">Level <?php echo $this->_tpl_vars['player'][$this->_sections['i']['index']]->level; ?>
</span>
                                    </div><!-- .caption -->
                                    <div class="action-challenge">
                                                                                 <?php if ($this->_tpl_vars['player'][$this->_sections['i']['index']]->racing_token != ''): ?>
										 <a class="challenge icon_race2" href="index.php?page=race&act=challenge&rtoken=<?php echo ((is_array($_tmp=$this->_tpl_vars['player'][$this->_sections['i']['index']]->racing_token)) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
">Challenge</a>
										 <?php endif; ?>
                                    </div><!-- .action -->
                                </div><!-- .row -->
                                <?php endfor; endif; ?>
                            </div><!-- .box -->
                        </div><!-- .scrollbar -->
                </div><!-- .entry -->
            </div><!-- .panel -->
            <div id="sidebar">
            	<div class="entry">
                    <div id="profile2">
                        <div class="thumb"><a href="index.php?page=garage"><img src="<?php if ($this->_tpl_vars['small_img'] == ''): ?> img/thumb.jpg <?php else: ?> contents/avatar/small/<?php echo $this->_tpl_vars['small_img']; ?>
 <?php endif; ?>" /></a></div>
                        <div class="box-user">
                            <span class="username"><?php echo $this->_tpl_vars['name']; ?>
</span>
                            <span class="reputation"><?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['level']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <span class="total-race"><?php echo $this->_tpl_vars['races']; ?>
 Race</span>
                            <span class="total-win"><?php echo $this->_tpl_vars['wins']; ?>
 Wins</span>
                            <span class="rank">Rank 34</span>
                            <span class="total-point"><?php echo $this->_tpl_vars['points']; ?>
 PTS</span>
                        </div>
                    </div><!-- #profile --> 
                </div><!-- .entry -->
            </div><!-- #sidebar -->
            <div class="lights-img"></div>
        </div><!-- #containers -->
    </div><!-- .wrapper -->
</div><!-- #main-container -->