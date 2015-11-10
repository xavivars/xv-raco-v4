<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head profile="http://gmpg.org/xfn/11">

<title><?php woo_title(); ?></title>
<?php woo_meta(); ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/ie.css" /><![endif]-->
<!--[if IE 6]>
<script src="<?php bloginfo('template_directory'); ?>/includes/js/pngfix.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/includes/js/menu.js"></script>
<![endif]-->

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php 
	if(!is_single()) {
		echo '<meta property="og:image" content="http://xavi.ivars.me/wp-content/themes/irresistible/images/logo.png"/>',"\n";
	}
	wp_head(); 
?>

</head>

<body id="woothemes" <?php body_class('woothemes'); ?>>

	<div id="wrap">

		<div id="header">
			<?php
			if ( function_exists('has_nav_menu') && has_nav_menu('primary-menu') ) {
				wp_nav_menu( array( 'depth' => 5, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'nav', 'menu_class' => 'nav', 'theme_location' => 'primary-menu' ) );
			} else {
			?>
            <ul id="nav" class="nav">
				<?php 
                if ( get_option('woo_custom_nav_menu') == 'true' ) {
                    if ( function_exists('woo_custom_navigation_output') )
                        woo_custom_navigation_output('name=Woo Menu 1&depth=3');
    
                } else { ?>
				<li<?php if ( is_home() ) : ?> class="current_page_item"<?php endif; ?>><a href="<?php echo get_option('home'); ?>/"><?php _e('Home','woothemes'); ?></a></li>
				<?php 
                if (get_option('woo_nav') == 'true' ) 
                    wp_list_categories('sort_column=menu_order&depth=3&title_li=&exclude='); 
                else
                    wp_list_pages('sort_column=menu_order&depth=3&title_li=&exclude='); 
                ?>
				<?php } ?>
			</ul>
			<?php } ?>
			<form id="topSearch" class="search" method="get" action="<?php bloginfo('url'); ?>">
					
				<p class="fields">
					<input type="text" value="<?php echo strtolower(__('Search','woothemes')); ?>" name="s" id="s" onfocus="if (this.value == '<?php echo strtolower(__('search','woothemes')); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo strtolower(__('search','woothemes')); ?>';}" />
					<button class="replace" type="submit" name="submit"><?php _e('Search','woothemes'); ?></button>
				</p>

			</form>
			
            <div id="logo">
                <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('description'); ?>"><img class="title" src="<?php if ( get_option('woo_logo') <> "" ) { echo get_option('woo_logo'); } else { bloginfo('template_directory'); ?>/images/logo.png<?php } ?>" alt="<?php bloginfo('name'); ?>" /></a>
                <h1 class="replace"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>	
                		
            </div>
            
			<div id="hi">
			
				<p class="nomargin"><?php echo stripslashes( get_option( 'woo_about' ) ); ?></p>
				
				<p><a href="<?php echo stripslashes( get_option( 'woo_aboutlink' ) ); ?>">llig més</a></p>
			
			</div>
			
		</div>
		
