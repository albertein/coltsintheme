<?php
get_header();
global $coltsin_mustache;
$template = coltsin_get_template('home');
$posts = array();
$index = 0;
if (have_posts()) {
  while(have_posts()) {
    the_post();
    $tags = array();
    $tags_raw = get_the_tags();
    $count = 0;
    if (is_array($tags_raw)) {
      foreach($tags_raw as $tag) {
	$tags[$count] = array(
			      'name' => $tag->name,
			      'tag_link' => get_tag_link($tag->term_id)
			      );
	$count++;
      }
    }
	
    $posts[$index] = array(
			    'title' => get_the_title(),
			    'permalink' => get_permalink(get_the_ID()),
			    'content' => get_the_content(),
			    'day' => get_the_date('j'),
			    'month' => get_the_date('M'),
			    'tags' => $tags
			    );
    $index++;

  }
}
$data = array('posts' => $posts);
echo $coltsin_mustache->render($template, $data);
get_footer();
?>
