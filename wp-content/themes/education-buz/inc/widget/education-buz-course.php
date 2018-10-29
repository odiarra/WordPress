<?php
/**
 * Recent Post
 *
 * @package Education Buz
 */

/**
 * Adds Recent post display widget.
 */
add_action( 'widgets_init', 'education_buz_register_our_course_widget' );
function education_buz_register_our_course_widget() {
    register_widget( 'education_buz_our_course_widget' );
}
class education_buz_our_course_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'education_buz_our_course',
			esc_html__('Education Buz : Our Course','education-buz'),
			array(
				'description'	=> esc_html__( 'A widget To Display Courses', 'education-buz' )
			)
		);
	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	 private function widget_fields() {
        $education_buz_post_lists = education_buz_post_lists();
		$fields = array(
            'our_course_post' => array(
                'education_buz_widgets_name' => 'our_course_post',
                'education_buz_widgets_title' => esc_html__('Course Detail Post','education-buz'),
                'education_buz_widgets_field_type' => 'select',
                'education_buz_widgets_field_options' => $education_buz_post_lists,
            ),
            'our_course_price' => array(
                'education_buz_widgets_name' => 'our_course_price',
                'education_buz_widgets_title' => esc_html__('Course Price','education-buz'),
                'education_buz_widgets_field_type' => 'text',
            ),
		);
		
		return $fields;
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
        extract($args);
            
        $our_course_post = isset( $instance['our_course_post'] ) ? $instance['our_course_post'] : '' ;
        $our_course_price = isset( $instance['our_course_price'] ) ? $instance['our_course_price'] : '' ;
        $our_course_price_query = new WP_Query(array('post_type' =>'post','post__in' => array($our_course_post),'posts_per_page' => -1,'order' => 'DESC','status' => 'publish'));
        echo $before_widget;
        
            
            if($our_course_price_query->have_posts()) : ?>
                <?php while($our_course_price_query->have_posts()) : $our_course_price_query->the_post(); ?>
                
                    <div class="recent-post-wrap wow fadeInUp">
                            
                        <?php $img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'education-buz-blog-image', false ); 
                        if($img_src[0]){ ?>
                            <div class="image_wrap_recent">
                                <a href="<?php the_permalink(); ?>" class="img_recent_post_img">
                                    <img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo esc_url($img_src[0]); ?>"/>
                                </a>
                                <?php if($our_course_price){ ?>
                                    <span class="price-course">
                                        <?php echo esc_html($our_course_price); ?>
                                    </span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        
                        <div class="recent-post-content">
                            <?php if(get_the_title()){ ?>
                                <a href="<?php the_permalink(); ?>" class="recent-post-title-widget">
                                    <?php the_title(); ?>
                                </a>
                            <?php } ?>
                        </div>
                        
                    </div>
                
                <?php endwhile;
                wp_reset_postdata();
            endif;
        echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param	array	$new_instance	Values just sent to be saved.
	 * @param	array	$old_instance	Previously saved values from database.
	 *
	 * @uses	education_buz_widgets_updated_field_value()		defined in widget-fields.php
	 *
	 * @return	array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {

			extract( $widget_field );
	
			// Use helper function to get updated field values
			$instance[$education_buz_widgets_name] = education_buz_widgets_updated_field_value( $widget_field, $new_instance[$education_buz_widgets_name] );
			
		}
				
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param	array $instance Previously saved values from database.
	 *
	 * @uses	accesspress_pro_widgets_show_widget_field()		defined in widget-fields.php
	 */
	public function form( $instance ) {
		$widget_fields = $this->widget_fields();

		// Loop through fields
		foreach( $widget_fields as $widget_field ) {
			// Make array elements available as variables 
			extract( $widget_field );
			$education_buz_widgets_field_value = isset( $instance[$education_buz_widgets_name] ) ? esc_attr( $instance[$education_buz_widgets_name] ) : '';
			education_buz_widgets_show_widget_field( $this, $widget_field, $education_buz_widgets_field_value );
		}	
	}
}