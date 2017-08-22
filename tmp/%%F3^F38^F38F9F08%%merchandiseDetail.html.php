<?php /* Smarty version 2.6.13, created on 2012-03-09 11:30:07
         compiled from RedRushWeb//merchandiseDetail.html */ ?>

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
                    	<div class="merchandise">
                        	<div class="description">
                            	<h1><?php echo $this->_tpl_vars['merchandise']->item_name; ?>
</h1>
                                <span class="orange" style="display:block;"><?php if ($this->_tpl_vars['ownPart'] == 0): ?> <?php echo $this->_tpl_vars['merchandise']->prize; ?>
 PTS. <?php else: ?> <span class="purchased-item-detail">PURCHASED</span> <?php endif; ?></span>
                                <p><?php echo $this->_tpl_vars['merchandise']->description; ?>
</p>
								<?php if ($this->_tpl_vars['merchandise']->variant != '1'): ?>
                                <div class="size-tshirt">
                                    <input type="radio" value="s" name="variant" /><label>S</label>
                                    <input type="radio" value="l" name="variant" /><label>L</label>
                                </div>
								<?php endif; ?>
                              <?php if ($this->_tpl_vars['ownPart'] == 0): ?>     <a class="btn-redeem2" href="?page=merchandise&act=redeem_form&merchandise_id=<?php echo $this->_tpl_vars['merchandise']->id; ?>
" merchandise_id="<?php echo $this->_tpl_vars['merchandise']->id; ?>
" >&nbsp;</a><?php else: ?> &nbsp; <?php endif; ?> <a class="btn-backs" href="index.php?page=merchandise">&nbsp;</a>
                            </div>
                            <div class="merchandise-list">
                          	<img class="img-purchase-detail" src="img/merchandise/<?php echo $this->_tpl_vars['merchandise']->img; ?>
" alt="" />
                            </div>
                           
                        </div><!-- .merchandise -->
                </div><!-- .entry -->
            </div><!-- .panel -->
        </div><!-- #containers -->
    </div><!-- .wrapper -->
</div><!-- #main-container -->
					   <div id="popup-merchandise" class="popup popupmerchandise ">
						
							<div class="confirm-buy">
                                   <h2>Confirm Reedem</h2>
                                    <div class="thumb-merchandise" ><?php if ($this->_tpl_vars['ownPart'] == 0): ?><img src="img/merchandise/<?php echo $this->_tpl_vars['merchandise']->img; ?>
" alt="" /><?php else: ?><img class="img-purchase-detail" src="img/merchandise/<?php echo $this->_tpl_vars['merchandise']->img; ?>
" alt="" /><?php endif; ?></div>
                                    <h3>Reedem This Merchandise ?</h3>
                                    <span class="sparepart-point purchase_point" ><?php if ($this->_tpl_vars['ownPart'] == 0): ?> <?php echo $this->_tpl_vars['merchandise']->prize; ?>
 PTS. <?php else: ?> PURCHASED <?php endif; ?></span>
                                    <div class="confirm-btn">
                                     <?php if ($this->_tpl_vars['ownPart'] == 0): ?>  <a href="javascript:void(0)"  merchandise_id="<?php echo $this->_tpl_vars['merchandise']->id; ?>
" class="purchaseMerchandise purchase"  >Yes</a><?php else: ?>  <span class="purchased-item-detail">PURCHASED</span> <?php endif; ?>
                                        <a href="#" class="cancel-purchase">Exit</a>
                                    </div>
                       
							</div>  								
                            </div>
                            <div class="backgroundPopup"></div>

<?php echo '
<script>
$(document).ready(function() {

$(\'.purchaseMerchandise\').click(function(){
$(\'a.btn-redeem2\').css({\'display\' : \'none\'});
$(\'#merchandise_id\').val($(this).attr(\'merchandise_id\'));
//$(\'#purchaseMerchandise\').submit();

var merchandise_id = $(this).attr(\'merchandise_id\');
$.post(\'?page=merchandise&act=purchaseMerchandise\', { merchandise_id: merchandise_id },
				function(data) {
			$(\'.purchase_point\').html(data);
	});



});
$(\'.cancel-purchase\').click(function(){
	$(".backgroundPopup").fadeOut("slow");
	$(".popup").fadeOut("slow");
	popupStatus = 0;
});
});
</script>
'; ?>