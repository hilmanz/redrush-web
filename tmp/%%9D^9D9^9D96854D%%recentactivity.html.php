<?php /* Smarty version 2.6.13, created on 2012-03-22 16:47:58
         compiled from RedRushWeb//recentactivity.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'RedRushWeb//recentactivity.html', 42, false),array('modifier', 'strip_tags', 'RedRushWeb//recentactivity.html', 42, false),)), $this); ?>

<div id="main-container" class="city_top">
	<div class="wrapper">
    	<div id="containers">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "RedRushWeb/newsfeedSubmenu.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <div class="logo">
            	<a href="index.php">&nbsp;</a>
            </div><!-- .logo -->
            <div class="panel2">
            	<div class="entry recents">
                    <div class="title">
                        <h1>Recent Activity</h1>
                    </div><!-- .title -->
				           <div class="scrollbar" style="height:220px;">
                            <ul class="newsfeed" style="padding:15px 0;">
                               <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['notification']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
								<li>
								 <span class="feeds"><?php echo $this->_tpl_vars['notification'][$this->_sections['i']['index']]->message; ?>
</span>
                                 <span class="date-feeds"><?php echo $this->_tpl_vars['notification'][$this->_sections['i']['index']]->date_time; ?>
</span>
								</li>
                                <?php endfor; endif; ?>   
                                <!--  <li>
                                    <span class="feeds"><a href="#">Baskara</a> gained 250 points at RedRush Night event @ Dragonfly</span>
                                    <span class="date-feeds">34 MInutes Ago</span>
                                </li> -->
                            </ul>
                        </div><!-- .scrollbar -->
                </div><!-- .entry -->
            </div><!-- .panel -->
            <div id="sidebar">
            	<div class="entry">
                	<div class="box">
                        <div class="title-box">
                            <h1>Featured NEWS</h1>
                        </div><!-- .title -->  
                        <div class="box-red">
                        	<div class="content">
                                    <?php if ($this->_tpl_vars['featured']): ?>
                                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['featured']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                    <div class="list">
                                    <p>
                                    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['featured'][$this->_sections['i']['index']]['brief'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
<br />
                                    <a href="index.php?page=news&act=view&nid=<?php echo $this->_tpl_vars['featured'][$this->_sections['i']['index']]['id']; ?>
">Details here &raquo;</a>
                                    </p>
                                    </div><!-- .list -->
                                    <?php endfor; endif; ?>
                                    <?php else: ?>
                                    No featured news available.
                                    <?php endif; ?>
                            </div><!-- .content -->   
                        </div><!-- .box-red -->   
                    </div><!-- .box -->   
                </div><!-- .entry -->
            </div><!-- #sidebar -->
            <div class="car-extreme-img"></div>
        </div><!-- #containers -->
    </div><!-- .wrapper -->
</div><!-- #main-container -->