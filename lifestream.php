<?php

	// youtube
// gdata.youtube.com/feeds/base/users/xavivars/favorites?orderby=updated&alt=rss&v=2

// twitter timeline
// api.twitter.com/1/statuses/user_timeline.xml?screen_name=xavivars

// twitter favourites
// twitter.com/favorites/15352361.rss

/*
 			array(
				'feed'=>'http://twitter.com/favorites/15352361.rss',
				'url'=>'http://twitter.com/xavivars/favorites',
				'type'=>'TwitterF'
			) ,
			array(
				'feed'=>'http://api.twitter.com/1/statuses/user_timeline.xml?screen_name=xavivars',
				'url'=>'http://twitter.com/xavivars',
				'type'=>'Twitter'
			)
 */

	define('LIFESTREAM_DATA','/var/www/xavi.ivars.me/htdocs/wp-content/themes/racov4/lifestream.data');
	define('LIFESTREAM_URL','http://xavi.ivars.me/wp-content/themes/racov4/lifestream/');

	putenv ('TZ=Europe/Madrid'); 
	date_default_timezone_set('Europe/Madrid');


	function get_config_lifestream() {

		$configs = array(

			 array(
				'feed'=>'http://gdata.youtube.com/feeds/base/users/xavivars/favorites?orderby=updated&alt=rss&v=2',
				'url'=>'http://www.youtube.com/profile_favorites?user=xavivars',
				'type'=>'Youtube'
			), 
			array(
				'feed'=>'http://www.softcatala.org/apertium/twitter/twitterf.xml',
				'url'=>'http://twitter.com/xavivars/favorites',
				'type'=>'TwitterF'
			), 			
			array(
				'feed'=>'http://www.softcatala.org/apertium/twitter/twitter.xml',
				'url'=>'http://twitter.com/xavivars',
				'type'=>'Twitter'
			) ,

			array(
				'feed'=>'http://feeds.delicious.com/v2/rss/xavivars',
				'url'=>'http://www.delicious.com/xavivars',
				'type'=>'Delicious'
			) 
			 ,array(
				'feed'=>'http://www.google.com/reader/public/atom/user/13455549274430875252/state/com.google/broadcast',
				'url'=>'http://reader.google.com',
				'type'=>'GReader'
			) 
		);
		
		return $configs;
	}

	function get_lifestream($num = 10,$limit=false) {


		$youtube_image = LIFESTREAM_URL.'youtube.png';
		$twitter_image = LIFESTREAM_URL.'twitter.png';
		$twitterf_image = LIFESTREAM_URL.'twitter-star.png';
		$delicious_image = LIFESTREAM_URL.'delicious.png';
		$greader_image = LIFESTREAM_URL.'greader.png';

		$cache_dir = get_template_directory().'/lfcache/';

		$configs = get_config_lifestream();

		$feed_urls = array();
		$feed_images = array();
		$feed_types = array();
		
		echo count($configs),'<br />';
		
		foreach($configs as $config) {
			$feed_images[$config['url']] = $config['image'];
			$feed_urls[$config['url']]=$config['feed'];
			$feed_types[$config['url']]=$config['type'];
		}
		
		$feed = new SimplePie();

		echo '<pre>';
		var_dump($feed_urls);
		echo '</pre>';

		$feed->set_feed_url($feed_urls);
		$feed->set_cache_duration(3600);
		$feed->set_cache_location($cache_dir);

		$feed->init();
		$feed->handle_content_type();
		
		if ($feed->error())
			echo '-',$feed->error(),'-<br />';
		else
			echo 'noerror<br />';
		
		
		$i = 0;
		$ret = array();
		
		$items = $feed->get_items();

		foreach ($items as $item) {
			$blog_link=$item->get_feed()->get_link();
			if($blog_link == NULL) $blog_link = 'http://reader.google.com';
			$blog_title=$item->get_feed()->get_title();
			$item_link=$item->get_link();
			$item_title=$item->get_title();
			$blog_image=$feed_images[$blog_link];
			$type = $feed_types[$blog_link];
			$item_date = $item->get_date('d/m/Y H:i');
			$pubDate = $item->get_date('r');
			$hora = $item->get_date('H.i');
			$ct = $item->get_description();

			/*echo '<pre>';
			
			
			var_dump($blog_link);
			var_dump($blog_title);
			var_dump($item_link);
			var_dump($item_title);
			var_dump($ct);
			
			echo '</pre>'; exit();*/

			$imcl = '';
			$str = '';
			if($type == 'Youtube') {
				$str = 'He marcat el video &quot;<a href="'.$item_link.'">'.$item_title.'</a>&quot; com a favorit al Youtube';
				$imcl = 'lifestream_img_yt';
				$image = $youtube_image;
			}
			
			if($type == 'TwitterF') {
				if(substr($item_title,0,10) == 'xavivars: ') continue;
				$item_title=xv_fancy_tweet('@'.$item_title);
				$str = '<a rel="nofollow" href="'.$item_link.'">#</a> &quot;'.nl2br($item_title).'&quot;';
				$image = $twitterf_image;
			}
				
			if($type == 'Twitter') {
				$item_title = substr($item_title,10);
				if(substr($item_title,0,1) == '@') continue;
				if(substr($item_title,0,4) == 'RT @') {
					$item_title = xv_fancy_tweet(substr($item_title,2));
					$str = '<a rel="nofollow" href="'.$item_link.'">'.$hora.'</a>: ♺ '.nl2br($item_title);
				} else {
					$item_title = xv_fancy_tweet($item_title);
					$str = '<a rel="nofollow" href="'.$item_link.'">'.$hora.'</a>: '.nl2br($item_title);
				}
				$image = $twitter_image;
			}
			
			if($type == 'Delicious') {
				$image = $delicious_image;
				$str = '<a href="'.$item_link.'">'.$item_title.'</a>';
			}
			
			if($type == 'GReader') {
				$image = $greader_image;
				$str = 'He compartit un enllaç &quot;<a href="'.$item_link.'">'.$item_title.'</a>&quot;';
			}

			$str  = '<img class="lifestream_img '.$imcl.'" src="'.$image.'" /><div class="lifestream_txt">'.$str.'</div>';
			
			echo $i,': ',$type,'<pre>'.$str.'</pre><br />';
			
			$ret[]=array($str,$item->get_date('d/m/Y'));

			if(++$i>=$num) break;
		}
		$feed->__destruct();
		unset($feed);
		
		return $ret;
	}

	function xv_fancy_tweet($twit) {
		// Convert URLs into hyperlinks
	   $twit = preg_replace("/(http:\/\/)(.*?)\/([\w\.\/\&\=\?\-\,\:\;\#\_\~\%\+]*)/", "<a rel=\"nofollow\" href=\"\\0\">\\0</a>", $twit);

	   // Convert usernames (@) into links 
	   $twit = preg_replace("(@([a-zA-Z0-9\_]+))", "<a rel=\"nofollow\" href=\"http://www.twitter.com/\\1\">\\0</a>", $twit);

	   // Convert hash tags (#) to links 
	   $twit = preg_replace('/(^|\p{Z})#((\p{L}|\p{N})+)/u', '\1<a rel="nofollow" href="http://search.twitter.com/search?q=%23\2">#\2</a>', $twit);
	   
	   return $twit;
	}

	function get_template_directory() {
		return './';
	}

	if ( !defined('ABSPATH') )
        	define('ABSPATH', '/var/www/xavi.ivars.me/htdocs/');
	if ( !defined('WPINC') )
        	define('WPINC', 'wp-includes/');

	include('../../../wp-includes/class-simplepie.php');

	 $blogs = get_lifestream(10);

	file_put_contents(LIFESTREAM_DATA,json_encode($blogs));
?>
