<div id="tabs">

    <ul class="idTabs tabs clearfix">
        <li class="nav1"><a href="#comm"><img src="<?php bloginfo('template_directory'); ?>/images/ico-1.gif" alt="<?php _e('Comments',woothemes)?>" /></a></li>
        <li class="nav2"><a href="#pop"><img src="<?php bloginfo('template_directory'); ?>/images/ico-2.gif" alt="<?php _e('Popular',woothemes)?>" /></a></li>
        <li class="nav3"><a href="#tagcloud"><img src="<?php bloginfo('template_directory'); ?>/images/ico-5.gif" alt="<?php _e('Etiquetes',woothemes)?>" /></a></li>												
    </ul>
    <div class="inside">

        <ul id="comm">
            <?php include(STYLESHEETPATH . '/includes/comments.php' ); ?>                    
        </ul>

        <ul id="pop">
            <?php include(STYLESHEETPATH . '/includes/popular.php' ); ?>                    
        </ul>

        <div id="tagcloud">
            <?php wp_tag_cloud('smallest=7&largest=18&exclude=458'); ?>
        </div>

    </div><!--inside-->

</div><!--tabs-->
<br />
