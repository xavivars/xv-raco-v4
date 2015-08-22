<?php


class XV_Bookmarks_Widget extends WP_Widget {
        function XV_Bookmarks_Widget() {
        parent::WP_Widget(false, $name = 'Blogs amics');        
    }
        static function xv_bookmarks() {
			$books = get_bookmarks('orderby=name&show_description=1');
			foreach ($books as $book) {
				echo '<li><a href="'.$book->link_url.'">';
				if (substr($book->link_image,0,4) == 'http') {
					echo '<span class="imgfavicon"><img src="'.$book->link_image.'" alt="'.$book->link_name.'" /></span>';
				}
				echo $book->link_name.'</a><div class="antifloat"></div>';
				echo '</li>';
			}
		}
        function widget($args, $instance) {             
			extract($args);
			echo $before_widget, $before_title, 'Blogs amics', $after_title , '<ul>';
			
			self::xv_bookmarks();
			
        	echo '</ul>', $after_widget;
        }
}

register_widget('XV_Bookmarks_Widget');

?>
