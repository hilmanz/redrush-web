<?php /* Smarty version 2.6.13, created on 2012-03-15 16:32:51
         compiled from RedRushWeb//news_view.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'RedRushWeb//news_view.html', 21, false),)), $this); ?>
<div id="main-container">
	<div class="wrapper">
    	<div id="containers">
            <div class="submenu">
            	<ul>
                	<li><a href="index.php?page=news"  <?php if ($this->_tpl_vars['home']): ?>class="current"<?php endif; ?>>News Update</a></li>
                	<li><a href="index.php?page=news&act=recent" <?php if ($this->_tpl_vars['recent_activity']): ?>class="current"<?php endif; ?>>Recent Activity</a></li>
                </ul>
            </div>
            <div class="logo">
            	<a href="index.php">&nbsp;</a>
            </div><!-- .logo -->
            <div class="panel">
            	<div class="entry">
                    <div class="title">
                        <h1>NEWS AND UPDATE</h1>
                    </div><!-- .title -->
                    <div class="scrollbar">
                    		<?php if ($this->_tpl_vars['view']): ?>
                            <h1 class="title-news"><?php echo $this->_tpl_vars['view']['title']; ?>
</h1>
                            <p>Posted: <?php echo ((is_array($_tmp=$this->_tpl_vars['view']['posted_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
<br />
                            <?php echo $this->_tpl_vars['view']['detail']; ?>
</p>
                            <?php else: ?>
                            No news and update available.
                            <?php endif; ?>
                    </div><!-- .scrollbar -->
                </div><!-- .entry -->
            </div><!-- .panel -->
            <div id="sidebar">
            	<div class="entry">
                	<div class="box">
                        <div class="title-box">
                            <h1>Feature News</h1>
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
                                    <?php echo $this->_tpl_vars['featured'][$this->_sections['i']['index']]['brief']; ?>
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
        </div><!-- #containers -->
    </div><!-- .wrapper -->
</div><!-- #main-container -->