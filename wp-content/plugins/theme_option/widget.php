<?php
//include("option_home_box.php");
// Register and load the widget
function htz_home_fixed() {
    register_widget( 'htz_homes' );
}
add_action( 'widgets_init', 'htz_home_fixed' );
// Creating the widget 
class htz_homes extends WP_Widget  {
 
function __construct() {
    parent::__construct(  
        // Base ID of your widget
        'htz_homes',       
        // hatazu contact  will appear in UI
        __('home banner', 'htz_home_domain'),         
        // Widget description
        array( 'description' => __( 'home banner', 'htz_home_domain' ), ) 
        );
    }
 
    // Creating widget front-end
     
    public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
             
            // before and after widget arguments are defined by themes
            //echo $args['before_widget'];
            //if ( ! empty( $title ) )
            //echo $args['before_title'] . $title . $args['after_title'];
             
            // This is where you run the code and display the output
            //echo __( 'Hello, World!', 'htz_home_domain' );
            home_box();
            //echo $args['after_widget'];
        }
             
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'htz_home_domain' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} ?>
