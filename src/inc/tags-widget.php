<?php
/**
 * Plugin Name: Coltsin Tags Widget
 * Description: Display the Tags using on Wordpress and it's post count
 * Author: Alberto Avila
 * Version: 1.0.0
 * Author URI: http://albertein.com.mx
 */

defined('ABSPATH') or die("Cannot access pages directly.");
defined("DS") or define("DS", DIRECTORY_SEPARATOR);
add_action( 'widgets_init', create_function( '', 'register_widget("Coltsin_Tags_Widget");' ) );

class Coltsin_Tags_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
  public function __construct() {
    parent::__construct(
	 		'coltsin_tags_widget', // Base ID
			'Coltsin_Tags_Widget', // Name
			array('description' => 
			      'Display list of tags with its post count')
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
    $tags = get_tags(array('pad_counts' => false));
    $elements = array();
    $index = 0;
    foreach($tags as $tag) {
      $elements[$index++] = array('name' => $tag->name,
				  'count' => $tag->count,
				  'tag-link' => get_tag_link($tag->term_id)
				  );
    }
    $template = coltsin_get_template('tags-widget-render');
    echo $coltsin_mustache->render($template, array('tags' => $elements));
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
      $title = 'Tags';
    }
    $data = array('id' => $this->get_field_id('title'),
		  'name' => $this->get_field_name('title'),
		  'title' => esc_attr($title)
		  );
    $template = coltsin_get_template('tags-widget-form');
    echo $coltsin_mustache->render($template, $data);
  }

} 
