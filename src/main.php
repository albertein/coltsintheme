<?
global $coltsin_mustache;
$template = coltsin_get_template('main');
$data = array();
echo $coltsin_mustache->render($template, $data);
?>