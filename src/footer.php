<?php
global $coltsin_mustache;
$template = coltsin_get_template('footer');
$wp_footer = coltsin_get_buffer(function() {
    wp_footer();
});
$options = get_option('coltsin_display_options');
$data = array(
	      'wp-footer' => $wp_footer,
	      'theme-path' => get_bloginfo('template_url'),
	      'is_front_page' => is_front_page(),
	      'home-url' => get_home_url(),
	      'about-url' => get_permalink($options['about_page']),
	      'events-url' => get_category_link($options['events_category'])
	      );
echo $coltsin_mustache->render($template, $data);
?>