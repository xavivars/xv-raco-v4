<div id="sidebar" <?php if ( get_option('woo_mainright') == 'true' ) echo 'class="fl"'; ?>>

    <!-- Add you sidebar manual code here to show above the widgets -->
    <div class="widgetized">
		<?php if (function_exists('woo_sidebar') && woo_sidebar('top') )  ?>	
    </div>	           
    <!-- Add you sidebar manual code here to show below the widgets -->	

    <!-- Sidebar Video -->    
    <?php if ( get_option('woo_video') == 'false' ) include ( STYLESHEETPATH . "/includes/video.php" ); ?>

    <!-- Sidebar Tabs -->
    <?php if ( get_option('woo_tabs') == 'false' ) include ( STYLESHEETPATH . "/includes/tabs.php" ); ?>
    <?php /* echo '<!-- ',STYLESHEETPATH . "/includes/tabs.php" ,' -->'; */ ?>
    <!-- Add you sidebar manual code here to show above the widgets -->
    <div class="widgetized">
		<?php if (function_exists('woo_sidebar') && woo_sidebar('primary') )  ?>	
    </div>	           
    <!-- Add you sidebar manual code here to show below the widgets -->			
                
</div><!-- / #sidebar -->
			
