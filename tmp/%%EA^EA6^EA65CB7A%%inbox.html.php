<?php /* Smarty version 2.6.13, created on 2012-03-22 11:10:24
         compiled from RedRushWeb//inbox.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'RedRushWeb//inbox.html', 36, false),array('modifier', 'strip_tags', 'RedRushWeb//inbox.html', 36, false),)), $this); ?>

<div id="main-container" class="bg-night inbox">
	<div class="wrapper">
    	<div id="containers">
            <div class="logo">
            	<a href="index.php">&nbsp;</a>
            </div><!-- .logo -->
            <div class="panel3">
            	<div class="entry" style="padding:0 30px 0 50px;">
                    <div class="title" style="padding:10px 0 20px 0;">
                        <h1>Inbox</h1>
                    </div><!-- .title -->
                        <div class="scrollbar" style="height:230px;">
                            <div class="box" style="width:330px">
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
                       				<div class="row">
                                    <p><?php echo $this->_tpl_vars['notification'][$this->_sections['i']['index']]->message; ?>
</p><span class="tip" style="display:none;"><img src="<?php if ($this->_tpl_vars['notification'][$this->_sections['i']['index']]->small_img != ''): ?>contents/avatar/small/<?php echo $this->_tpl_vars['notification'][$this->_sections['i']['index']]->small_img;  endif; ?>" /></span>
                                    <a href="?page=user&act=detail_notification&report=<?php echo $this->_tpl_vars['notification'][$this->_sections['i']['index']]->report_id; ?>
"><?php echo $this->_tpl_vars['notification'][$this->_sections['i']['index']]->date_time; ?>
</a>
                                </div><!-- .row -->
                                <?php endfor; endif; ?> 
                            </div><!-- .box -->
                        </div><!-- .scrollbar -->
                </div><!-- .entry -->
            </div><!-- .panel -->
            <div id="sidebar">
            	<div class="entry">
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
                </div><!-- .entry -->
            </div><!-- #sidebar -->
        </div><!-- #containers -->
    </div><!-- .wrapper -->
</div><!-- #main-container -->