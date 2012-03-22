<?php
get_header();
global $coltsin_mustache;
$template = coltsin_get_template('front-page');
$options = get_option('coltsin_display_options');
$events = array();
$index = 0;
$items = get_posts(array(
		  'cat' => $options['events_category'],
		  'numberposts' => 1));
foreach($items as $item) {
  $event_date = new DateTime(get_post_meta($item->ID, 'eventdate', true));
  $now = new DateTime(date('Y-m-d'));
  $eta = $now->diff($event_date)->format('%a');
  $events[$index++] = array(
			  'title' => $item->post_title,
			  'content' => $item->post_content,
			  'permalink' => get_permalink($item->ID),
			  'ETA' => $eta
			  );

}
$data = array('events' => $events);
echo $coltsin_mustache->render($template, $data);
get_footer();
?>
