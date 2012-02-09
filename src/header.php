<?
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
       'pingback-url' => get_bloginfo('pingback_url')
   );
   echo $coltsin_mustache->render($template, $data);
?>
