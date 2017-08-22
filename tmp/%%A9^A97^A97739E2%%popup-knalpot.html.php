<?php /* Smarty version 2.6.13, created on 2012-02-27 16:56:12
         compiled from RedRushWeb/popup-knalpot.html */ ?>

	<div id="popup-knalpot" class="popup">
		<a class="popup-close" href="#">[x] Close</a>
          <ul class="jcarousel jcarousel-skin-tango list-sparepart-carousel">
              <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['parts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                   <div class="sparepart-list">
                    <div class="thumb-sparepart"><img src="img/sparepart/knalpot1.png" alt="" /></div>
                    <div class="sparepart-detail">
                        <span class="sparepart-name">LEVEL <?php echo $this->_tpl_vars['parts'][$this->_sections['i']['index']]->level; ?>
</span><br>
                        <span class="sparepart-name" style="font-size:20px;"><?php echo $this->_tpl_vars['parts'][$this->_sections['i']['index']]->name; ?>
</span><br>
                        <span class="sparepart-point"><?php if ($this->_tpl_vars['parts'][$this->_sections['i']['index']]->ownPart == 0): ?> <?php echo $this->_tpl_vars['parts'][$this->_sections['i']['index']]->price; ?>
 PTS. <?php else: ?> PURCHASED <?php endif; ?></span>
                        <a href="javascript:void(0)" part_id="<?php echo $this->_tpl_vars['parts'][$this->_sections['i']['index']]->id; ?>
" class="purchasePart <?php if ($this->_tpl_vars['parts'][$this->_sections['i']['index']]->ownPart == 0): ?> buy-item <?php endif; ?>" ></a>
                    </div>
                   </div>
               </li>
              <?php endfor; endif; ?>
          </ul>
	</div>
	<div class="backgroundPopup"></div>