<?php
    global $coltsin_mustache;
    $template = coltsin_get_template('footer');
    $wp_footer = coltsin_get_buffer(function() {
        wp_footer();
    });
    $data = array(
		  'wp-footer' => $wp_footer,
		  'theme-path' => get_bloginfo('template_url'),
		  'is_front_page' => is_front_page(),
		  'home-url' => get_home_url()
    );
    echo $coltsin_mustache->render($template, $data);
?>