<?php
global $coltsin_mustache;
$wp_header = coltsin_get_buffer(function() {
    wp_enqueue_script('jquery');
    wp_head();
 });
$template = coltsin_get_template('header');
$data = array(
	      'charset' => get_bloginfo('charset'),
	      'blog-name' => get_bloginfo('name'),
	      'blog-description' => get_bloginfo('description'),
	      'wp-header' => $wp_header,
	      'template-url' => get_bloginfo('template_url'),
	      'rss-feed' => get_bloginfo('rss2_url'),
	      'atom-feed' => get_bloginfo('atom_url'),
	      'pingback-url' => get_bloginfo('pingback_url'),
	      'header-class' => is_front_page() ? 'main-page' : 'blog-page',
	      'home-url' => get_home_url(),
	      'blog-url' => get_permalink(get_option('page_for_posts')),
	      'is_front_page' => is_front_page()
);
echo $coltsin_mustache->render($template, $data);
?>