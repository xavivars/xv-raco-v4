<?php


add_action('init', 'woo_add_tweets');
function woo_add_tweets() 
{
  $labels = array(
    'name' => 'Tweets',
    'singular_name' => 'Tweet',
    'add_new' => 'Afegeix',
    'add_new_item' => 'Afegeix un tweet',
    'edit_item' => 'Edita el tweet',
    'new_item' => 'Nou tweet',
    'view_item' => 'Visualitza el tweet',
    'search_items' => 'Cerca tweets',
    'not_found' =>  'No s\'han trobat tweets',
    'not_found_in_trash' => 'No hi ha tweets a la paperera',
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_icon' => get_stylesheet_directory_uri() .'/images/twitter_gray.png',
    'menu_position' => null,
    'supports' => array('title','editor','author','excerpt'),
    'rewrite'  => array('slug' => 'tweet','with_front'=>false, 'feeds'=>false)
  ); 
  register_post_type('tweet',$args);
}

?>
