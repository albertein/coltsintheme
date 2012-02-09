<?
    global $coltsin_mustache;
    $template = coltsin_get_template('footer');
    $wp_footer = coltsin_get_buffer(function() {
        wp_footer();
    });
    $data = array(
        'wp-footer' => $wp_footer
    );
    echo $coltsin_mustache->render($template, $data);
?>