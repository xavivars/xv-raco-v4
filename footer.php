	</div><!-- / #wrap -->

	<div id="footer">
		
		<div id="footerWrap">
<?php /*
			<p id="copy">
				<?php _e('Copyright','woothemes'); ?> &copy; <?php echo date('Y'); ?> <a href="#"><?php bloginfo('name'); ?></a>. <?php _e('All rights reserved','woothemes'); ?>.
			</p> */ 
?>			<p id="copy">
				<a href="http://xavi.ivars.me/feed" title="Sindica 'El racó de Xavi'!">
					<img src="http://xavi.ivars.me/imatges/feed-icon.png" alt="Sindica 'El racó de Xavi'!" title="Sindica 'El racó de Xavi'!"/></a>
				<a href="http://creativecommons.org/licenses/by-nc-sa/2.5/es/deed.ca" rel="license">
					<img src="http://i.creativecommons.org/l/by-nc-sa/2.5/es/80x15.png" alt="llicència de Creative Commons Reconeixement - Compartir-Igual" /></a><br />
				Pàgina gestionada amb <a href="http://wordpress.org" rel="nofollow">Wordpress</a> |
			    Allotjament a <a href="http://www.dreamhost.com/r.cgi?223626">Dreamhost</a>
			</p>
			
			<?php
			if ( function_exists('has_nav_menu') && has_nav_menu('footer-menu') ) {
				wp_nav_menu( array( 'depth' => 1, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'footerNav', 'theme_location' => 'footer-menu' ) );
			} else {
			?>
			<ul id="footerNav">
				<?php 
                if ( get_option('woo_custom_nav_menu') == 'true' ) {
                    if ( function_exists('woo_custom_navigation_output') )
                        woo_custom_navigation_output('name=Woo Menu 2');
    
                } else { ?>
				<?php wp_list_pages('sort_column=menu_order&title_li=&depth=1'); ?>
				<?php } 
				?>
				<!-- <li><a href="http://www.woothemes.com" title="Irresistible Theme by WooThemes"><img src="<?php bloginfo('template_directory'); ?>/images/img_woothemes.jpg" width="87" height="21" alt="WooThemes" /></a></li> -->
			</ul>
			<?php } ?>
		</div><!-- / #footerWrap -->
	
	</div><!-- / #footer -->

<?php wp_footer(); ?>
</body>
</html>
