<?php
/**
 * Plugin Name: Coltsin Events Widget
 * Description: Display the upcoming events 
 * Author: Alberto Avila
 * Version: 1.0.0
 * Author URI: http://albertein.com.mx
 */

defined('ABSPATH') or die("Cannot access pages directly.");
defined("DS") or define("DS", DIRECTORY_SEPARATOR);
add_action( 'widgets_init', create_function( '', 'register_widget("Coltsin_Events_Widget");' ) );

class Coltsin_Events_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
  public function __construct() {
    parent::__construct(
	 		'coltsin_events_widget', // Base ID
			'Coltsin_Events_Widget', // Name
			array('description' => 
			      'Display the upcoming events')
			);
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    global $coltsin_mustache;
    extract( $args );
    $title = apply_filters( 'widget_title', $instance['title'] );

    echo $before_widget;
    if ( ! empty( $title ) )
      echo $before_title . $title . $after_title;
    $options = get_option('coltsin_display_options');
    $today = date("Y-m-d");
    $items = get_posts(array('category' => $options['events_category'],
			     'order' => 'DESC',
			     'orderby' => 'meta_value',
			     'meta_key' => 'eventdate',
			     'meta_query' => array('key' => 'eventdate',
						   'value' => $today,
						   'compare' => '>=',
						   'type' => 'date'
						   )
			     )
		       );
    $elements = array();
    $index = 0;
    foreach($items as $item) {
      $event_date = strtotime(get_post_meta($item->ID, 'eventdate', true));
      $elements[$index++] = array('title' => $item->post_title,
				  'date' => date('d/m/y', $event_date),
				  'event-link' => get_permalink($item->ID)
				  );
    }
    $template = coltsin_get_template('events-widget-render');
    echo $coltsin_mustache->render($template, array('events' => $elements));
    echo $after_widget;
  }


  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    global $coltsin_mustache;
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    }
    else {
      $title = 'Events';
    }
    $data = array('id' => $this->get_field_id('title'),
		  'name' => $this->get_field_name('title'),
		  'title' => esc_attr($title)
		  );
    $template = coltsin_get_template('simple-widget-form');
    echo $coltsin_mustache->render($template, $data);
  }

} 
