<?php
get_header();
global $coltsin_mustache;
$template = coltsin_get_template('home');
$items = array();
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
	
    $items[$index] = array(
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

$page_title = '';
if (is_archive()) {
  $page_title = 'Historico: ';
  if (is_tag())
    $page_title = 'Entradas sobre: ' . get_query_var('tag');
  if (is_category())
    $page_title = get_category(get_query_var('cat'))->name;
}

$data = array('posts' => $items, 
	      'single' => is_single() || is_page(),
	      'is_archive' => is_archive(),
	      'page-title' => $page_title);
echo $coltsin_mustache->render($template, $data);
get_footer();
?>
