<?php

define('LIFESTREAM_DATA','/var/www/xavi.ivars.me/htdocs/wp-content/themes/racov4/lifestream.data');
define('SFC_LOCALE','ca_ES');
include(STYLESHEETPATH.'/data.php');

include(STYLESHEETPATH.'/includes/xv-cpt-tweet.php');

function xv_data($func) {
	$xav_a=$func('F');
	$xav_data='';

	if(($xav_a[0]=='a' || $xav_a[0]=='o')||($xav_a[0]=='A' || $xav_a[0]=='O'))
		$xav_data=$func('j \d\'F \d\e\ Y');
	else
		$xav_data=$func('j \d\e\ F \d\e\ Y');
	
	echo $xav_data;

	unset($xav_a);
	unset($xav_data);
}

function xv_data_comment() {
	xv_data('get_comment_date');
}

function xv_data_post() {
	xv_data('get_the_time');
}

function xv_translate_date_time($str) {

	try {
		$dt = new DateTime($str);

		$dt->setTimezone(new DateTimeZone('Europe/Madrid'));
		$xdata=$dt->format('r');
		$dat=split(',',$xdata);
		$xxdata=__($dat[0]);
		$xxdata.=',';
		$xdat=split(' ',$dat[1]);
		for($i=0;$i<sizeof($xdat);$i++) {
			if($i==2) {
				$xxdata.=__($xdat[2].'_'.$dt->format('F').'_abbreviation').' ';
			} else {
				$xxdata.=$xdat[$i].' ';
			}
		}
		return 	str_replace('.','',$xxdata);
	} catch (Exception $e) { }
	return $str;
}

function xv_anunci($str=false) {

	if($str=='blocgoogle') {
	?>
	<script type="text/javascript"><!--
		google_ad_client = "pub-5598048210598472";
		google_ad_slot = "3138536612";
		google_ad_width = 468;
		google_ad_height = 60;
	//--></script>
	<script async type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

	<?php
	} elseif($str=='blocfirefox') {
	?>
	<script type="text/javascript"><!--
		google_ad_client = "pub-5598048210598472";
		google_ad_slot = "0345104141";
		google_ad_width = 468;
		google_ad_height = 60;
		google_cpa_choice = "";
	//--></script>
	<script async type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

	<?php
	} elseif($str=='bloc-wpapertium') {
	?>
	<script type="text/javascript"><!--
		google_ad_client = "pub-5598048210598472";
		google_ad_slot = "5692788475";
		google_ad_width = 468;
		google_ad_height = 60;
	//--></script>
	<script async type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

	<?php
	} else {

	?>
	<script type="text/javascript"><!--
		google_ad_client = "pub-5598048210598472";
		google_ad_slot = "9919928197";
		google_ad_width = 468;
		google_ad_height = 60;
	//--></script>
	<script async type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

	<?php
	}
}

function gravatar_hovercards() {
	wp_enqueue_script( 'gprofiles', 'http://s.gravatar.com/js/gprofiles.js', array( 'jquery' ), 'e', true );
}
add_action('wp_enqueue_scripts','gravatar_hovercards');

function xv_extra_info() {
	global $post;
	$meta_ad = get_post_meta($post->ID,"ad",true);
	
	if(!empty($meta_ad)) {
		?><div class="box1 clearfix" style="text-align:center"><?php
		if($meta_ad != "true")
			xv_anunci($meta_ad);
		else
			xv_anunci();
		?></div><?php
	}
}
	
function xv_utils() {
	global $post;
	
	$xvutil = get_post_meta($post->ID,"xaviutil",true);
	
	if(!empty($xvutil))
	{
		$xaviutils = true;
		include("utils.$xvutil.php");
	}
}

//Add CC license to namespace, item, inline img link within description
function xv_add_license_ns() { echo ' xmlns:creativeCommons="http://backend.userland.com/creativeCommonsRssModule" '; }

function xv_add_license_item() { echo '<creativeCommons:license>http://creativecommons.org/licenses/by-nc-sa/3.0/es/deed.ca</creativeCommons:license>'; }

function xv_hide_wp_vers() { return ''; }

function xv_feed_image() { echo "<image><title>El racó de Xavi</title><url>http://xavi.ivars.me/wp-content/themes/racov4/images/logo.png</url><link>http://xavi.ivars.me</link><width>64</width><height>64</height><description>El racó de Xavi</description></image>"; }

function xv_iframe($atts) {
	$src = $atts['src'];

	if(empty($src)) return;

	$ret = '<iframe src="'.$src.'" ';

	if(!empty($atts['width']))
		$ret .= ' width="'.$atts['width'].'" ';

	if(!empty($atts['height']))
		$ret .= ' height="'.$atts['height'].'" ';

	return $ret.' ></iframe>';
}

function xv_field($atts) {
   global $post;
   $name = $atts['name'];
   if (empty($name)) return;

   return get_post_meta($post->ID, $name, true);
}

function xv_filtra_feed_content($content) {

	global $post;

	$ct  = '<p><a href="http://creativecommons.org/licenses/by-nc-sa/3.0/es/deed.ca" rel="license" ';
	$ct .= 'title="Aquesta obra està llicenciada sota una llicència Creative Commons Reconeixement-';
	$ct .= 'No comercial-Compartir Igual 3.0"><img src="http://xavi.ivars.me/wp-content/themes';
	$ct .= '/racov3/images/cc.png" alt="CC" /></a> El racó de Xavi (<a href="';
	$ct .= get_permalink($post->ID)."\">enllaç a la entrada</a>)</p><br /><br />";
	$cont = get_the_content();
	$cont = apply_filters('the_content', $cont);
	$cont = str_replace(']]>', ']]>', $cont);

	return $ct.$cont;
}

function xv_filtra_feed_title($title) {
	if(!is_feed())
		return $title;

	$title = 'El Racó de Xavi → '.$title;

	return $title;
}

function get_the_category_exclude($separator=', ',$exclude='') {
    $toexclude = explode(",", $exclude);
    $newlist = array();
    foreach((get_the_category()) as $category) {
        if(!in_array($category->category_nicename,$toexclude)){
            //$newlist[] = $category->cat_name;
            $newlist[] = '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>'  . $category->name.'</a>';
        }
    }
    return implode($separator,$newlist);
}

function custom_trim_excerpt($text) { // Fakes an excerpt if needed
    global $post;
    
    if ( '' == $text ) {
        $text = get_the_content('');

        $text = strip_shortcodes( $text );

        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $text = strip_tags($text,'<blockquote><p><b><i><em><strong><u><a>');
        $text = trim($text);
        $excerpt_length = apply_filters('excerpt_length', 120);
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words) > $excerpt_length) {
            array_pop($words);
            array_push($words, '[...]');
            $text = implode(' ', $words);
        }
    }
    return '<div>'.$text.'</div>';
}

function is_minipost() { return ( in_category(11) && !is_single()); }

if(!function_exists('lifestream')) {
	function lifestream() {
		$data = @file_get_contents(LIFESTREAM_DATA);
		if($data) {
            $arr=json_decode($data);
        } else {
            $arr = array();
        }
		echo '<ul class="lifestream">';
		$last = '';
		$wlast = '';
		foreach($arr as $linea) {
			if($linea[1]!=$last) {
				 $last = $linea[1];
				 $wlast = get_written_data($last);
				 echo '<li class="lifestream_li_date"><img src="/wp-content/themes/racov4/png.data.php?data=',
					$last,'" alt="',$wlast,'"></li>';
			}
			echo '<li class="lifestream_li">',$linea[0],'</li>';
		}
		echo '</ul>';
	}
}

function xv_br_sniff($content) {
	ob_start();pri_print_browser();$brws = ob_get_contents();ob_end_clean();
	$ct=$content.'<div class="brwsniff">'.$brws.'</div>';
	return $ct;
}

add_filter('comment_text','xv_br_sniff');


function xv_codi_script() {
	wp_enqueue_script( 'codi', get_stylesheet_directory_uri().'/codi.js', array( 'jquery' ) , false, true);
}
add_action('wp_enqueue_scripts','xv_codi_script');


add_shortcode('field', 'xv_field');

add_shortcode('iframe','xv_iframe');

add_action('rss2_ns', 'xv_add_license_ns');
add_action('rss2_item', 'xv_add_license_item');
add_action('rss2_head', 'xv_feed_image');
add_filter('the_generator','xv_hide_wp_vers');
add_action ('the_excerpt_rss','xv_filtra_feed_content');
add_action ('the_title','xv_filtra_feed_title');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_trim_excerpt');
remove_filter( 'the_content', 'ozh_ta_convert_old_posts' );

if ( !function_exists( 'ucc_clean_ozh_tweet_archiver' ) ) {
	function ucc_clean_ozh_tweet_archiver( $data ) {
		$data['tax_input']['category'] = '';
		$data['tax_input']['tag'] = $data['tax_input']['post_tag'];
		$data['post_type'] = 'tweet';
		return $data;
	}
	add_filter( 'ozh_ta_insert_tweets_post' , 'ucc_clean_ozh_tweet_archiver' );
}



if(!function_exists('xv_fancy_tweet')) {
	function xv_fancy_tweet($twit) {
		// Convert URLs into hyperlinks
	   $twit = preg_replace("/(http:\/\/)(.*?)\/([\w\.\/\&\=\?\-\,\:\;\#\_\~\%\+]*)/", "<a rel=\"nofollow\" href=\"\\0\">\\0</a>", $twit);

	   // Convert usernames (@) into links 
	   $twit = preg_replace("(@([a-zA-Z0-9\_]+))", "<a rel=\"nofollow\" href=\"http://www.twitter.com/\\1\">\\0</a>", $twit);

	   // Convert hash tags (#) to links 
	   $twit = preg_replace('/(^|\p{Z})#((\p{L}|\p{N})+)/u', '\1<a rel="nofollow" href="http://search.twitter.com/search?q=%23\2">#\2</a>', $twit);
	   
	   return $twit;
	}
}

function yoast_allow_rel() {
	global $allowedtags;
	$allowedtags['a']['rel'] = array ();
}
add_action( 'wp_loaded', 'yoast_allow_rel' );

function yoast_change_author_link( $link, $author_id, $author ) {
  if ( 'xavi' == $author )
    return 'http://xavi.ivars.me/sobre-mi-xavi-ivars/';
  return $link;
}
add_filter( 'author_link', 'yoast_change_author_link', 10, 3 );



/**
 * Usage:
 * Paste a gist link into a blog post or page and it will be embedded eg:
 * https://gist.github.com/2926827
 *
 * If a gist has multiple files you can select one using a url in the following format:
 * https://gist.github.com/2926827?file=embed-gist.php
 */
wp_embed_register_handler( 'gist', '/https:\/\/gist\.github\.com\/(\d+)(\?file=.*)?/i', 'wp_embed_handler_gist' );

function wp_embed_handler_gist( $matches, $attr, $url, $rawattr ) {

	$embed = sprintf(
			'<script src="https://gist.github.com/%1$s.js%2$s"></script>',
			esc_attr($matches[1]),
			esc_attr($matches[2])
			);

	return apply_filters( 'embed_gist', $embed, $matches, $attr, $url, $rawattr );
}

function disable_canonical_redirection_for_tag_feeds() {
	if ( is_feed() && is_tag() )
		remove_action( 'template_redirect', 'redirect_canonical' );
}
add_action( 'wp', 'disable_canonical_redirection_for_tag_feeds' );

add_filter('sfc_publish_post_types','remove_fbc_post_types');
function remove_fbc_post_types($types) {
	
	unset($types['tweet']);
	
	return $types;
}

register_sidebar( array(
    'id'          => 'fotos',
    'name'        => 'Fotos',
    'description' => ''
) );

?>
