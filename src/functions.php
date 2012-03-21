<?php
function coltsin_get_path($filename) {
    return get_template_directory() . '/' . $filename;
}

function coltsin_get_template($template_name) {
    return file_get_contents(coltsin_get_path("templates/$template_name.html"));
}
  
function coltsin_get_buffer($action) {
    ob_start();
    $action();
    return ob_get_clean();  
}
include(coltsin_get_path('/inc/Mustache.php'));
global $coltsin_mustache;
$coltsin_mustache = new Mustache;

add_action('admin_menu', 'coltsin_admin_menu');
add_action('admin_init', 'coltsin_admin_init');

function coltsin_admin_menu() {
  add_theme_page('Coltsin Theme', 'Coltsin Theme', 'administrator',
		 'coltsin_options', 'coltsin_options_page');
}

function coltsin_admin_init() {
  add_option('coltsin_display_options');
  add_settings_section('general_settings_section', 'General Settings', 
		       function() {}, 'coltsin_display_options');
  add_settings_field('events_category', "Event's Category", 
		     'coltsin_events_category', 'coltsin_display_options',
		     'general_settings_section');
  add_settings_field('about_page', 'About Page', 'coltsin_about_page',
		     'coltsin_display_options', 'general_settings_section');
  register_setting('coltsin_display_options', 'coltsin_display_options');
}

function coltsin_options_page() {
  global $coltsin_mustache;
  $wp_magic = coltsin_get_buffer(function() {
      settings_fields('coltsin_display_options');
      do_settings_sections('coltsin_display_options');
      settings_errors();
    });
  $template = coltsin_get_template('options');
  echo $coltsin_mustache->render($template, array('wp-magic' => $wp_magic));
}

function coltsin_about_page() {
  $pages = get_pages();
  $elements_selector = function($item, $current) {
    return array('id' => $item->ID,
		 'name' => $item->post_title,
		 'selected' => $current == $item->ID
		 );
  };
  options_select_render('about_page', $pages, $elements_selector);
}

function coltsin_events_category() {
  $categories = get_categories(array('hide_empty' => 0));
  $elements_selector = function($item, $current) {
    return array('id' => $item->term_id,
		 'name' => $item->name,
		 'selected' => $current == $item->term_id
		 );
  };
  options_select_render('events_category', $categories, $elements_selector);
}

function options_select_render($option, $items, $elements_selector) {
  global $coltsin_mustache;
  $template = coltsin_get_template('options-select');
  $options = get_option('coltsin_display_options');
  $current = $options[$option];
  $elements = array();
  $index = 0;
  foreach($items as $item) {
    $elements[$index] = $elements_selector($item, $current);
    $index++;
  }
  $data = array(
		'id' => $option,
		'name' => "coltsin_display_options[$option]",
		'elements' => $elements
		); 
  echo $coltsin_mustache->render($template, $data);
}
?>