<?php
get_header();
global $coltsin_mustache;
$template = coltsin_get_template('front-page');
$data = array();
echo $coltsin_mustache->render($template, $data);
get_footer();
?>
