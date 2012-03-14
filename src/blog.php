<?
global $coltsin_mustache;
$template = coltsin_get_template('blog');
$data = array(
	      );
echo $coltsin_mustache->render($template, $data);
?>