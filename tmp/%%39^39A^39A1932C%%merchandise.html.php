<?php /* Smarty version 2.6.13, created on 2012-04-02 12:13:02
         compiled from RedRushWeb//merchandise.html */ ?>

<div id="main-container" class="bg-blue">
	<div class="wrapper">
    	<div id="containers">
            <div class="logo">
            	<a href="index.php">&nbsp;</a>
            </div><!-- .logo -->
            <div class="panel4">
                <div class="titles">
                    <h1>Your Current Points : <span class="yellow"> <?php echo $this->_tpl_vars['points']; ?>
 Pts.</span> </h1>
                    <a class="add-points" href="?page=race">&nbsp;</a>
                </div>
            	<div class="entry">
                    <div class="scrollbar">
                    	<div class="merchandise">
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['merchandise']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        	<div class="item">
                            	<div class="thumb-frame">
                                	<a class="thumb-item" href="index.php?page=merchandise&act=merchandiseDetail&merchandiseID=<?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]->id; ?>
">
                                   <?php if ($this->_tpl_vars['merchandise'][$this->_sections['i']['index']]->ownMerchandise == 0): ?><img src="img/merchandise/<?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]->img; ?>
" alt="" /><?php else: ?><img class="img-purchase" src="img/merchandise/<?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]->img; ?>
" alt="" /><?php endif; ?>
                                    </a><!-- .thumb-item -->
                                </div><!-- .thumb-frame -->
                                <div class="caption">
                                	<span class="price"><?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]->prize; ?>
 Pts.</span>
                                   <?php if ($this->_tpl_vars['merchandise'][$this->_sections['i']['index']]->ownMerchandise == 0): ?> <a class="btn-redeem"  href="index.php?page=merchandise&act=merchandiseDetail&merchandiseID=<?php echo $this->_tpl_vars['merchandise'][$this->_sections['i']['index']]->id; ?>
" >&nbsp;</a> <?php else: ?> <span class="purchased-item">PURCHASED</span> <?php endif; ?>
                                </div><!-- .caption -->
                            </div><!-- .item -->
                        <?php endfor; endif; ?>
                        	
                        </div><!-- .merchandise -->
                    </div><!-- .scrollbar -->
                </div><!-- .entry -->
            </div><!-- .panel -->
        </div><!-- #containers -->
    </div><!-- .wrapper -->
</div><!-- #main-container -->