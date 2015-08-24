<?php
/*
Template Name: Archives Page
*/
?>

<?php get_header(); ?>

    <div id="content">
    
        <div id="main">
        
            <div class="box1 clearfix">

                <div class="post clearfix">
            

                    <h2><?php _e('The Last 30 Posts','woothemes'); ?></h2>
        
                    <ul>
                        <?php query_posts('showposts=30'); ?>
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                            <?php $wp_query->is_home = false; ?>
                            <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - <?php xv_data_post() ?> - <?php echo $post->comment_count ?> comments</li>
                        
                        <?php endwhile; endif; ?>	
                    </ul>				
    
                    <h2><?php _e('Categories','woothemes'); ?></h2>
        
                    <ul>
                        <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
                    </ul>	
                    
                    <h2><?php _e('Monthly Archives','woothemes'); ?></h2>
        
                    <ul>
                        <?php wp_get_archives('type=monthly&show_post_count=1') ?>	
                    </ul>				

                 </div>                   

            </div>
                            
        <?php comments_template(); ?>
            
        </div><!-- / #main -->
			
<?php get_sidebar(); ?>
			
	</div><!-- / #content -->

<?php get_footer(); ?>
