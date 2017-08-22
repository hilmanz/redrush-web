<?php /* Smarty version 2.6.13, created on 2012-03-30 10:28:20
         compiled from RedRushWeb/newsfeedSubmenu.html */ ?>
<div class="submenu">
    <ul>
        <li><a href="index.php?page=news" <?php if ($this->_tpl_vars['home']): ?>class='current'<?php endif; ?>>News Updates</a></li>
        <li><a href="index.php?page=news&act=recent" <?php if ($this->_tpl_vars['recent_activity']): ?>class='current'<?php endif; ?>>Recent Activity</a></li>
    </ul>
</div><!-- .submenu -->