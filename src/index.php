<? 
include(coltsin_get_path('/inc/Mustache.php'));
global $coltsin_mustache;
$coltsin_mustache = new Mustache;
get_header();
if (is_front_page()) 
  get_template_part('main');
else if (is_home()) //blog
  get_template_part('blog');
get_footer();
?>