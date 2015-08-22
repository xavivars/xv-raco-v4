<?php 
/* Template Name: Tweet Archive */
get_header();
$tw = new WP_Query(array('post_type'=>'tweet','post_status'=>'publish','posts_per_page'=>100));
?>
<div id="content">
    
        <div id="main">
        
			<div class="box1 clearfix">	
				<ul class="lifestream" style="list-style-type: none">
					<?php if ( $tw->have_posts() ) : while ( $tw->have_posts() ) : $tw->the_post(); ?>
					<li class="lifestream_li">
						<img class="lifestream_img " src="http://xavi.ivars.me/wp-content/themes/racov4/lifestream/twitter.png">
						<div class="lifestream_txt">
						<?php 
							$ct = get_the_title(); 
							if(substr($ct,0,4) == 'RT @') {
								$ct = '♺ '.substr($ct,2);
							}
							echo xv_fancy_tweet($ct);
						?>
						</div>
					</li>
					<?php endwhile; endif; ?>
				</ul>
			</div>
			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('Tweets anteriors') ?></div>
				<div class="alignright"><?php previous_posts_link('Tweets posteriors') ?></div>
			</div>
		<?php wp_reset_query(); ?>

		</div><!-- / #main -->
		
        <?php get_sidebar(); ?>
        
	</div><!-- / #content -->

<?php get_footer(); ?>
