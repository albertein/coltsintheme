<?php
get_header();
global $coltsin_mustache;
$template = coltsin_get_template('front-page');
$options = get_option('coltsin_display_options');
$events = array();
$index = 0;
query_posts(array(
		  'cat' => $options['events_category'],
		  'posts_per_page' => 1));
if (have_posts) {
  while(have_posts()) {
    the_post();
    $event_date = new DateTime(get_post_meta(get_the_ID(), 'eventdate', true));
    $now = new DateTime(date('Y-m-d'));
    $eta = $now->diff($event_date)->format('%a');
    $events[$index] = array(
			    'title' => get_the_title(),
			    'content' => get_the_content(),
			    'permalink' => get_permalink(get_the_ID()),
			    'ETA' => $eta
			    );
    $index++;
  }
}
$data = array('events' => $events);
echo $coltsin_mustache->render($template, $data);
get_footer();
?>
