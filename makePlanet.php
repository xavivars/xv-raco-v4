<?php

	// youtube
// gdata.youtube.com/feeds/base/users/xavivars/favorites?orderby=updated&alt=rss&v=2

// twitter timeline
// api.twitter.com/1/statuses/user_timeline.xml?screen_name=xavivars

// twitter favourites
// twitter.com/favorites/15352361.rss

define(LIFESTREAM_DATA,'/home/xavivars/lifestream.xml');
define(LIFESTREAM_URL,'http://xavi.ivars.me/wp-content/themes/irresistible/lifestream/');

 putenv ('TZ=Europe/Madrid'); 
date_default_timezone_set('Europe/Madrid');

function get_lifestream($num = 5,$limit=false) {

	$cache_dir = get_template_directory().'/lfcache/';

    $configs = get_lifestream_config();

    $feed_urls = array();
    $feed_images = array();
    $feed_names = array();
    
    foreach($configs as $config) {
	    $feed_images[$config['url']] = $config['image'];
	    $feed_urls[$config['url']]=$config['feed'];
	    $feed_names[$config['url']]=$config['name'];
    }
    
    

    $feed = new SimplePie();


    $feed->set_feed_url($feed_urls);
    $feed->set_cache_duration(3600);
    $feed->set_cache_location($cache_dir);

    $feed->init();
    $feed->handle_content_type();

    $i = 0;
    $ret = array();
    
    $items = $feed->get_items();

    foreach ($items as $item) {
        $blog_link=$item->get_feed()->get_link();
        $blog_title=$item->get_feed()->get_title();
        $item_link=$item->get_link();
        $item_title=$item->get_title();
        $blog_image=$feed_images[$blog_link];
        $blog_name = $feed_names[$blog_link];
        $item_date = $item->get_date('d/m/Y H:i');
		$pubDate = $item->get_date('r');
		$ct = $item->get_description();

		if($blog_name == 'Youtube')
			$str = 'He marcat el video &quot;<a href="'.$item_link.'">'.$item_title.'</a>&quot; al Youtube ('.$item_date.')';
		
		if($blog_name == 'TwitterF')
			$str = 'He marcat un tweet &quot;<a href="'.$item_link.'">'.$item_title.'</a>&quot; ('.$item_date.')';
			
		if($blog_name == 'Twitter')
			$str = 'He fet un tweet &quot;<a href="'.$item_link.'">'.$item_title.'</a>&quot; ('.$item_date.')';

		$str  = '<img class="lifestream_img" src="'.$blog_image.'" /><span class="lifestream_txt">'.$str.'</span>';
		$ret[]=$str;
		
        if(++$i>=$num) break;
    }
    $feed->__destruct();
    unset($feed);
    
    return $ret;
}

function get_lifestream_config() {

    $configs = array(

        array(
            'feed'=>'http://gdata.youtube.com/feeds/base/users/xavivars/favorites?orderby=updated&alt=rss&v=2',
            'url'=>'http://www.youtube.com/profile_favorites?user=xavivars',
            'name'=>'Youtube',
            'image'=>LIFESTREAM_URL.'youtube.png',
        ),
        array(
            'feed'=>'http://twitter.com/favorites/xavivars.rss',
            'url'=>'http://twitter.com/xavivars/favorites',
            'name'=>'TwitterF',
            'image'=>LIFESTREAM_URL.'twitter-star.png',
        ),
        array(
            'feed'=>'http://twitter.com/statuses/user_timeline/15352361.rss',
            'url'=>'http://twitter.com/xavivars',
            'name'=>'Twitter',
            'image'=>LIFESTREAM_URL.'twitter.png',
        )
	);
	
	return $configs;
}

		function get_template_directory() {
			return './';
		}

		include('../../../wp-includes/class-simplepie.php');
		include('./lifestream.php');
	 $blogs = get_lifestream(20);

	echo json_encode($blogs);
	

?>
