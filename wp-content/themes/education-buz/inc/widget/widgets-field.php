<?php
/**
 * Define fields for Widgets.
 * 
 * @package Education Buz
 */

function education_buz_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
	$education_buz_pagelist[0] = array(
        'value' => 0,
        'label' => esc_html__('--choose--','education-buz')
    );
    $arg = array('posts_per_page'   => -1);
    $education_buz_pages = get_pages($arg);
    foreach($education_buz_pages as $education_buz_page) :
        $education_buz_pagelist[$education_buz_page->ID] = array(
            'value' => $education_buz_page->ID,
            'label' => $education_buz_page->post_title
        );
    endforeach;
    //print_r($widget_field);
	extract( $widget_field );
	
	switch( $education_buz_widgets_field_type ) {
	
		// Standard text field
		case 'text' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $education_buz_widgets_name )); ?>"><?php echo esc_html($education_buz_widgets_title); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($instance->get_field_id( $education_buz_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $education_buz_widgets_name )); ?>" type="text" value="<?php echo esc_attr($athm_field_value); ?>" />
				
				<?php if( isset( $education_buz_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($education_buz_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
		
		// Select field
		case 'select' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $education_buz_widgets_name )); ?>"><?php echo esc_html($education_buz_widgets_title); ?>:</label>
				<select name="<?php echo esc_attr($instance->get_field_name( $education_buz_widgets_name )); ?>" id="<?php echo esc_attr($instance->get_field_id( $education_buz_widgets_name )); ?>" class="widefat">
					<?php
					foreach ( $education_buz_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
						<option value="<?php echo esc_attr($athm_option_name); ?>" id="<?php echo esc_attr($instance->get_field_id( $athm_option_name )); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo esc_html($athm_option_title); ?></option>
					<?php } ?>
				</select>

				<?php if( isset( $education_buz_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($education_buz_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		case 'number' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $education_buz_widgets_name )); ?>"><?php echo esc_html($education_buz_widgets_title); ?>:</label><br />
				<input name="<?php echo esc_attr($instance->get_field_name( $education_buz_widgets_name )); ?>" type="number" step="1" min="1" id="<?php echo esc_attr($instance->get_field_id( $education_buz_widgets_name )); ?>" value="<?php echo esc_html($athm_field_value); ?>" class="small-text" />
				
				<?php if( isset( $education_buz_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($education_buz_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
	}
	
}

function education_buz_widgets_updated_field_value( $widget_field, $new_field_value ) {
    
	extract( $widget_field );
	
	// Allow only integers in number fields
	if( $education_buz_widgets_field_type == 'number' ) {
		return absint( $new_field_value );
	}
    elseif ($education_buz_widgets_field_type == 'multicheckboxes') {
         return wp_kses_post($new_field_value);
    } 
    elseif( $education_buz_widgets_field_type == 'textarea' ) {
        
		if( !isset( $education_buz_widgets_allowed_tags ) ) {
			$education_buz_widgets_allowed_tags = '<p><strong><em><a>';
		}
		return strip_tags( $new_field_value, $education_buz_widgets_allowed_tags );
		
	}
    else {
		return strip_tags( $new_field_value );
	}

}