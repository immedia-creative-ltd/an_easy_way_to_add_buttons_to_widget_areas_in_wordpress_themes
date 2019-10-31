<?php
/**
 * Plugin Name:   Bootstrap Button Widget Plugin
 * Description:   Adds an example widget that displays a bootstrap button in a widget area.
 * Version:       1.0
 * Author:        Cameron Kinross
 * Plugin URI:    https://www.immedia-creative.com/
 * Author URI:    https://www.immedia-creative.com/
 */

class bootstrap_button_Widget extends WP_Widget {


  // Set up the widget name and description.
  public function __construct() {
    $widget_options = array( 
		'classname' => 'button_widget',
		'description' => 'This creates a button Widget' 
		);
		
    parent::__construct( 'button_widget', 'Button Widget', $widget_options );
  }


  // Create the widget output.
  public function widget( $args, $instance ) {
    $value =  $instance[ 'value' ];
    $link =  $instance[ 'link' ];
    $targetBlank =  $instance[ 'targetBlank' ];
    $classes =  $instance[ 'classes' ];
    $id =  $instance[ 'id' ];
	
	// Retrieve the checkbox
	if( 'on' == $instance[ 'targetBlank' ] ) { 
		$target = 'target="_blank"';
	} 
	
	if( $classes != '' ){
		$classes = 'class="' . $classes . '"';
	}	
	
	if( $id != '' ){
		$id = 'id="' . $id . '"';
	}

	echo '<a href="' . $link . '" ' . $target . $classes . $id . '>' . $value . '</a>';

  }

  
  // Create the admin area widget settings form.
  public function form( $instance ) {
    $value = ! empty( $instance['value'] ) ? $instance['value'] : '';
    $link = ! empty( $instance['link'] ) ? $instance['link'] : ''; 
    $targetBlank = ! empty( $instance['targetBlank'] ) ? $instance['targetBlank'] : '';
    $classes = ! empty( $instance['classes'] ) ? $instance['classes'] : '';
    $id = ! empty( $instance['id'] ) ? $instance['id'] : ''; ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'value' ); ?>">Value:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'value' ); ?>" name="<?php echo $this->get_field_name( 'value' ); ?>" class="widefat" value="<?php echo esc_attr( $value ); ?>" />
    </p>
	<p>
      <label for="<?php echo $this->get_field_id( 'link' ); ?>">Link:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" class="widefat" value="<?php echo esc_attr( $link ); ?>" />
    </p>	
	<p>
      <label for="<?php echo $this->get_field_id( 'classes' ); ?>">Additional classes (separate with space):</label>
      <input type="text" id="<?php echo $this->get_field_id( 'classes' ); ?>" name="<?php echo $this->get_field_name( 'classes' ); ?>" class="widefat" value="<?php echo esc_attr( $classes ); ?>" />
    </p>	
	<p>
      <label for="<?php echo $this->get_field_id( 'id' ); ?>">Custom ID:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" class="widefat" value="<?php echo esc_attr( $id ); ?>" />
    </p>
	<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance[ 'targetBlank' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'targetBlank' ); ?>" name="<?php echo $this->get_field_name( 'targetBlank' ); ?>" /> 
		<label for="<?php echo $this->get_field_id( 'targetBlank' ); ?>">Open link in new tab?</label>
	</p><?php
  }


  // Apply settings to the widget instance.
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'value' ] = strip_tags( $new_instance[ 'value' ] );
    $instance[ 'link' ] = strip_tags( $new_instance[ 'link' ] );
    $instance[ 'targetBlank' ] = strip_tags( $new_instance[ 'targetBlank' ] );
    $instance[ 'classes' ] = strip_tags( $new_instance[ 'classes' ] );
    $instance[ 'id' ] = strip_tags( $new_instance[ 'id' ] );
    return $instance;
  }

}

// Register the widget.
function jpen_register_example_widget() { 
  register_widget( 'bootstrap_button_Widget' );
}
add_action( 'widgets_init', 'jpen_register_example_widget' );

?>