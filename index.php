<?php get_header(); ?>

	<?php if ( get_option('woo_home') == 'true' ) : include (TEMPLATEPATH . '/custom-home.php'); else : ?>

	<div id="content">
		
			<div id="main">
						
                <h3 id="myWritings" class="replace"><?php _e('My Writings. My Thoughts.','woothemes'); ?></h3>

					<?php if (have_posts()) : ?>
															
					<?php while (have_posts()) : the_post();

						if(is_minipost()) {
					?>
					<div class="box1 clearfix">
                        <div class="post clearfix minipost">
                            <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','woothemes')?>: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3
                            ><span class="txt0"><?php edit_post_link('Edit', '', ''); ?> // <?php xv_data_post() ?> // <?php echo get_the_category_exclude(', ','miniposts') ?> // <?php comments_popup_link(__('No Comments &#187;', 'woothemes'), __('1 Comment &#187;','woothemes'), __('% Comments &#187;','woothemes')); ?></span>
	                        <?php the_content(__('<span class="continue">Continue Reading</span>','woothemes')) ?>
                        </div>
					</div>
					<?php 
						} else {
					?>


                    <div class="box1 clearfix">
                        <div class="post clearfix">
                            <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','woothemes')?>: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                            <p class="txt0"><?php edit_post_link('Edit', '', ''); ?> // <?php xv_data_post() ?> // <?php the_category(', ') ?> // <?php comments_popup_link(__('No Comments &#187;', 'woothemes'), __('1 Comment &#187;','woothemes'), __('% Comments &#187;','woothemes')); ?></p>
                        
                        <?php the_content(__('<span class="continue">Continue Reading</span>','woothemes')) ?>
    
                        </div>
                    </div>
					<?php 
						}
					
						endwhile; ?>
					
					<div class="navigation nav clearfix">
						<div class="fl"><?php next_posts_link(__('&laquo; Older Entries','woothemes')) ?></div>
						<div class="fr"><?php previous_posts_link(__('Newer Entries &raquo;','woothemes')) ?></div>
					</div>
					<?php else : ?>
					
					<h2 class='center'><?php _e('No posts found','woothemes'); ?>.</h2>
					
					<?php endif; ?>

	
            </div><!-- / #main -->
		
        <?php get_sidebar(); ?>
        
	</div><!-- / #content -->

	<?php endif; ?>
    
<?php get_footer(); ?>
