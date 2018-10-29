<?php
/** Customizer Options
 */
 add_action('customize_register','education_buz_customizer_options');
 function education_buz_customizer_options($wp_customize){
    $education_buz_Category_list = education_buz_Category_list();
    $education_buz_post_lists = education_buz_post_lists();
    
    $wp_customize->get_section( 'title_tagline' )->panel = 'education_buz_header_panel';
    
    /** Header Pannel */
	$wp_customize->add_panel(
        'education_buz_header_panel', 
    	array(
    		'priority'       => 4,
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
        	'title'          => esc_html__( 'Header Settings', 'education-buz' ),
        ) 
    );
    
    /** Home Pannel */
	$wp_customize->add_panel(
        'education_buz_general_panel', 
    	array(
    		'priority'       => 5,
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
        	'title'          => esc_html__( 'General Settings', 'education-buz' ),
        ) 
    );
    
    /** Home Pannel */
	$wp_customize->add_panel(
        'education_buz_home_panel', 
    	array(
    		'priority'       => 5,
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
        	'title'          => esc_html__( 'Satic Home Settings', 'education-buz' ),
        ) 
    );
    
    /** Footer Pannel */
	$wp_customize->add_panel(
        'education_buz_footer_panel', 
    	array(
    		'priority'       => 6,
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
        	'title'          => esc_html__( 'Footer Settings', 'education-buz' ),
        ) 
    );
    
    /** Banner Section **/
    $wp_customize->add_section(
        'education_buz_home_banner_section',
        array(
            'title'		=> esc_html__( 'Banner Settings', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 1,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_banner_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_banner_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Banner', 'education-buz' ),
            'description' 	=> esc_html__( 'Home Page Header Banner', 'education-buz' ),
            'section' 	=> 'education_buz_home_banner_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 4,
        )
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_slider_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_cat_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_slider_cat',
        array(
            'label' => esc_html__('Slider Category','education-buz'),
            'priority' => 6,
            'type' => 'select',
            'choices' => $education_buz_Category_list,
            'section' => 'education_buz_home_banner_section'
        )
    );
    
    
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_seprate_one',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_slider_feature_post_seprate_one', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Slider Feature Post One', 'education-buz' ),
                'section' 	=> 'education_buz_home_banner_section',
                'priority'  => 8,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_one',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_slider_feature_post_one',
        array(
            'label' => esc_html__('Slider Feature Post One','education-buz'),
            'priority' => 9,
            'type' => 'select',
            'choices' => $education_buz_post_lists,
            'section' => 'education_buz_home_banner_section'
        )
    );
    
    $wp_customize->add_setting(
		'education_buz_slider_feature_color_one',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_hex_color',
			
            'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'education_buz_slider_feature_color_one',
			array(
				'settings'		=> 'education_buz_slider_feature_color_one',
				'section'		=> 'education_buz_home_banner_section',
				'label'			=> esc_html__('Slider Feature Color One', 'education-buz' ),
                'priority' => 10,
			)
		)
	);
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_seprate_two',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_slider_feature_post_seprate_two', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Slider Feature Post Two', 'education-buz' ),
                'section' 	=> 'education_buz_home_banner_section',
                'priority'  => 13,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_two',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_slider_feature_post_two',
        array(
            'label' => esc_html__('Slider Feature Post Two','education-buz'),
            'priority' => 14,
            'type' => 'select',
            'choices' => $education_buz_post_lists,
            'section' => 'education_buz_home_banner_section'
        )
    );
    
    $wp_customize->add_setting(
		'education_buz_slider_feature_color_two',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'education_buz_slider_feature_color_two',
			array(
				'settings'		=> 'education_buz_slider_feature_color_two',
				'section'		=> 'education_buz_home_banner_section',
				'label'			=> esc_html__('Slider Feature Color Two', 'education-buz' ),
                'priority' => 15,
			)
		)
	);
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_seprate_three',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_slider_feature_post_seprate_three', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Slider Feature Post Three', 'education-buz' ),
                'section' 	=> 'education_buz_home_banner_section',
                'priority'  => 18,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_three',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_slider_feature_post_three',
        array(
            'label' => esc_html__('Slider Feature Post Three','education-buz'),
            'priority' => 19,
            'type' => 'select',
            'choices' => $education_buz_post_lists,
            'section' => 'education_buz_home_banner_section'
        )
    );
    
    $wp_customize->add_setting(
		'education_buz_slider_feature_color_three',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'education_buz_slider_feature_color_three',
			array(
				'settings'		=> 'education_buz_slider_feature_color_three',
				'section'		=> 'education_buz_home_banner_section',
				'label'			=> esc_html__('Slider Feature Color Three', 'education-buz' ),
                'priority' => 21,
			)
		)
	);
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_seprate_four',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_slider_feature_post_seprate_four', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Slider Feature Post Four', 'education-buz' ),
                'section' 	=> 'education_buz_home_banner_section',
                'priority'  => 24,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_four',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_slider_feature_post_four',
        array(
            'label' => esc_html__('Slider Feature Post Four','education-buz'),
            'priority' => 25,
            'type' => 'select',
            'choices' => $education_buz_post_lists,
            'section' => 'education_buz_home_banner_section'
        )
    );
    
    $wp_customize->add_setting(
		'education_buz_slider_feature_color_four',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'education_buz_slider_feature_color_four',
			array(
				'settings'		=> 'education_buz_slider_feature_color_four',
				'section'		=> 'education_buz_home_banner_section',
				'label'			=> esc_html__('Slider Feature Color Four','education-buz' ),
                'priority' => 26,
			)
		)
	);
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_seprate_five',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_slider_feature_post_seprate_five', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Slider Feature Post Five', 'education-buz' ),
                'section' 	=> 'education_buz_home_banner_section',
                'priority'  => 29,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_five',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_slider_feature_post_five',
        array(
            'label' => esc_html__('Slider Feature Post Five','education-buz'),
            'priority' => 30,
            'type' => 'select',
            'choices' => $education_buz_post_lists,
            'section' => 'education_buz_home_banner_section'
        )
    );
    
    $wp_customize->add_setting(
		'education_buz_slider_feature_color_five',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'education_buz_slider_feature_color_five',
			array(
				'settings'		=> 'education_buz_slider_feature_color_five',
				'section'		=> 'education_buz_home_banner_section',
				'label'			=> esc_html__('Slider Feature Color Five', 'education-buz' ),
                'priority' => 31,
			)
		)
	);
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_seprate_six',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_slider_feature_post_seprate_six', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Slider Feature Post Six', 'education-buz' ),
                'section' 	=> 'education_buz_home_banner_section',
                'priority'  => 35,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_slider_feature_post_six',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_slider_feature_post_six',
        array(
            'label' => esc_html__('Slider Feature Post Six','education-buz'),
            'priority' => 36,
            'type' => 'select',
            'choices' => $education_buz_post_lists,
            'section' => 'education_buz_home_banner_section'
        )
    );
    
    $wp_customize->add_setting(
		'education_buz_slider_feature_color_six',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'education_buz_slider_feature_color_six',
			array(
				'settings'		=> 'education_buz_slider_feature_color_six',
				'section'		=> 'education_buz_home_banner_section',
				'label'			=> esc_html__('Slider Feature Color Six', 'education-buz' ),
                'priority' => 37,
			)
		)
	);
    
    /** About Section **/
    $wp_customize->add_section(
        'education_buz_home_about_section',
        array(
            'title'		=> esc_html__( 'About Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_about_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_about_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable About Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_about_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** About Section Title **/
    $wp_customize->add_setting(
    'education_buz_about_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_about_section_title',
        array(
            'label' => esc_html__('Section Title','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_home_about_section'
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_about_post_one_seprate',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_about_post_one_seprate', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'About Post One', 'education-buz' ),
                'section' 	=> 'education_buz_home_about_section',
                'priority'  => 7,
            )	            	
        )
    );
    
    /** Header Info One **/
    $wp_customize->add_setting(
        'education_buz_about_post_one_icon',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_FA_Icons_Control(
        $wp_customize, 
            'education_buz_about_post_one_icon', 
            array(
                'type' 		=> 'education_buz_fa_icons',
                'label' 	=> esc_html__( 'Post One FA Iocn', 'education-buz' ),
                'section' 	=> 'education_buz_home_about_section',
                'priority'  => 10,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_about_post_one',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_about_post_one',
        array(
            'label' => esc_html__('About Post One','education-buz'),
            'priority' => 11,
            'type' => 'select',
            'choices' => $education_buz_post_lists,
            'section' => 'education_buz_home_about_section'
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_about_post_two_seprate',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_about_post_two_seprate', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'About Post Two', 'education-buz' ),
                'section' 	=> 'education_buz_home_about_section',
                'priority'  => 14,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_about_post_two_icon',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_FA_Icons_Control(
        $wp_customize, 
            'education_buz_about_post_two_icon', 
            array(
                'type' 		=> 'education_buz_fa_icons',
                'label' 	=> esc_html__( 'Post Two FA Iocn', 'education-buz' ),
                'section' 	=> 'education_buz_home_about_section',
                'priority'  => 15,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_about_post_two',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_about_post_two',
        array(
            'label' => esc_html__('About Post Two','education-buz'),
            'priority' => 17,
            'type' => 'select',
            'choices' => $education_buz_post_lists,
            'section' => 'education_buz_home_about_section'
        )
    );
    
    
    $wp_customize->add_setting(
    'education_buz_about_post_three_seprate',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_about_post_three_seprate', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'About Post Three', 'education-buz' ),
                'section' 	=> 'education_buz_home_about_section',
                'priority'  => 20,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_about_post_three_icon',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_FA_Icons_Control(
        $wp_customize, 
            'education_buz_about_post_three_icon', 
            array(
                'type' 		=> 'education_buz_fa_icons',
                'label' 	=> esc_html__( 'Post Three FA Iocn', 'education-buz' ),
                'section' 	=> 'education_buz_home_about_section',
                'priority'  => 21,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_about_post_three',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_about_post_three',
        array(
            'label' => esc_html__('About Post Three','education-buz'),
            'priority' => 22,
            'type' => 'select',
            'choices' => $education_buz_post_lists,
            'section' => 'education_buz_home_about_section'
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_about_post_four_seprate',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_about_post_four_seprate', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'About Post Four', 'education-buz' ),
                'section' 	=> 'education_buz_home_about_section',
                'priority'  => 30,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_about_post_four_icon',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_FA_Icons_Control(
        $wp_customize, 
            'education_buz_about_post_four_icon', 
            array(
                'type' 		=> 'education_buz_fa_icons',
                'label' 	=> esc_html__( 'Post Four FA Iocn', 'education-buz' ),
                'section' 	=> 'education_buz_home_about_section',
                'priority'  => 31,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_about_post_four',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_about_post_four',
        array(
            'label' => esc_html__('About Post Four','education-buz'),
            'priority' => 32,
            'type' => 'select',
            'choices' => $education_buz_post_lists,
            'section' => 'education_buz_home_about_section'
        )
    );
    
    /** Feature Section **/
    $wp_customize->add_section(
        'education_buz_home_feature_section',
        array(
            'title'		=> esc_html__( 'Feature Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_feature_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_feature_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Feature Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_feature_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Feature Section Title **/
    $wp_customize->add_setting(
    'education_buz_feature_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_feature_section_title',
        array(
            'label' => esc_html__('Section Title','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_home_feature_section'
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_feature_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_cat_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_feature_cat',
        array(
            'label' => esc_html__('Feature Category','education-buz'),
            'priority' => 8,
            'type' => 'select',
            'choices' => $education_buz_Category_list,
            'section' => 'education_buz_home_feature_section'
        )
    );
    
    
    $wp_customize->add_setting(
    'education_buz_feature_section_image',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'education_buz_feature_section_image',
           array(
               'label'      => esc_html__( 'Section Feature Image', 'education-buz' ),
               'section'    => 'education_buz_home_feature_section',
               'settings'   => 'education_buz_feature_section_image',
               'priority' => 16,
           )
       )
    );
    
    /** Skill Section **/
    $wp_customize->add_section(
        'education_buz_home_skill_section',
        array(
            'title'		=> esc_html__( 'Skill Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_skill_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_skill_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Skill Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_skill_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Skill Section Title **/
    $wp_customize->add_setting(
    'education_buz_skill_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_skill_section_title',
        array(
            'label' => esc_html__('Section Title','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_home_skill_section'
        )
    );
    
    /** Skill Section Sub Title **/
    $wp_customize->add_setting(
    'education_buz_skill_section_desc',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_textarea'
        )
    );
    $wp_customize->add_control(
    'education_buz_skill_section_desc',
        array(
            'label' => esc_html__('Section Description','education-buz'),
            'priority' => 6,
            'type' => 'textarea',
            'section' => 'education_buz_home_skill_section'
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_skill_seprate_one',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_skill_seprate_one', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Skill One', 'education-buz' ),
                'section' 	=> 'education_buz_home_skill_section',
                'priority'  => 8,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_skill_title_one',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_skill_title_one',
        array(
            'label' => esc_html__('Skill Title One','education-buz'),
            'priority' => 10,
            'type' => 'text',
            'section' => 'education_buz_home_skill_section'
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_skill_percent_one',
        array(
            'default' => '',
            'sanitize_callback' => 'absint'
        )
    );
    $wp_customize->add_control(
    'education_buz_skill_percent_one',
        array(
            'label' => esc_html__('Skill Percent One','education-buz'),
            'priority' => 11,
            'type' => 'number',
            'section' => 'education_buz_home_skill_section'
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_skill_seprate_two',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_skill_seprate_two', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Skill Two', 'education-buz' ),
                'section' 	=> 'education_buz_home_skill_section',
                'priority'  => 14,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_skill_title_two',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_skill_title_two',
        array(
            'label' => esc_html__('Skill Title Two','education-buz'),
            'priority' => 15,
            'type' => 'text',
            'section' => 'education_buz_home_skill_section'
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_skill_percent_two',
        array(
            'default' => '',
            'sanitize_callback' => 'absint'
        )
    );
    $wp_customize->add_control(
    'education_buz_skill_percent_two',
        array(
            'label' => esc_html__('Skill Percent Two','education-buz'),
            'priority' => 16,
            'type' => 'number',
            'section' => 'education_buz_home_skill_section'
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_skill_seprate_three',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_skill_seprate_three', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Skill Three', 'education-buz' ),
                'section' 	=> 'education_buz_home_skill_section',
                'priority'  => 17,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_skill_title_three',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_skill_title_three',
        array(
            'label' => esc_html__('Skill Title Three','education-buz'),
            'priority' => 18,
            'type' => 'text',
            'section' => 'education_buz_home_skill_section'
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_skill_percent_three',
        array(
            'default' => '',
            'sanitize_callback' => 'absint'
        )
    );
    $wp_customize->add_control(
    'education_buz_skill_percent_three',
        array(
            'label' => esc_html__('Skill Percent Three','education-buz'),
            'priority' => 19,
            'type' => 'number',
            'section' => 'education_buz_home_skill_section'
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_skill_seprate_four',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_skill_seprate_four', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Skill Four', 'education-buz' ),
                'section' 	=> 'education_buz_home_skill_section',
                'priority'  => 20,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_skill_title_four',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_skill_title_four',
        array(
            'label' => esc_html__('Skill Title Four','education-buz'),
            'priority' => 21,
            'type' => 'text',
            'section' => 'education_buz_home_skill_section'
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_skill_percent_four',
        array(
            'default' => '',
            'sanitize_callback' => 'absint'
        )
    );
    $wp_customize->add_control(
    'education_buz_skill_percent_four',
        array(
            'label' => esc_html__('Skill Percent Four','education-buz'),
            'priority' => 22,
            'type' => 'number',
            'section' => 'education_buz_home_skill_section'
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_skill_section_image',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'education_buz_skill_section_image',
           array(
               'label'      => esc_html__( 'Skill Section Image', 'education-buz' ),
               'section'    => 'education_buz_home_skill_section',
               'settings'   => 'education_buz_skill_section_image',
               'priority' => 30,
           )
       )
    );
    
    /** Course Section **/
    $wp_customize->add_section(
        'education_buz_home_course_section',
        array(
            'title'		=> esc_html__( 'Course Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_course_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_course_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Course Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_course_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Course Section Title **/
    $wp_customize->add_setting(
    'education_buz_course_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_course_section_title',
        array(
            'label' => esc_html__('Section Title','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_home_course_section'
        )
    );
    
    /** CTA Section **/
    $wp_customize->add_section(
        'education_buz_home_cta_section',
        array(
            'title'		=> esc_html__( 'CTA Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_cta_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_cta_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Cta Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_cta_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** CTA Section Title **/
    $wp_customize->add_setting(
    'education_buz_cta_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_cta_section_title',
        array(
            'label' => esc_html__('Section Title','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_home_cta_section'
        )
    );
    
    /** CTA Section Sub Title **/
    $wp_customize->add_setting(
    'education_buz_cta_section_desc',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_textarea'
        )
    );
    $wp_customize->add_control(
    'education_buz_cta_section_desc',
        array(
            'label' => esc_html__('Section Description','education-buz'),
            'priority' => 6,
            'type' => 'textarea',
            'section' => 'education_buz_home_cta_section'
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_cta_button_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_cta_button_text',
        array(
            'label' => esc_html__('Button Text','education-buz'),
            'priority' => 7,
            'type' => 'text',
            'section' => 'education_buz_home_cta_section'
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_cta_button_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
    'education_buz_cta_button_link',
        array(
            'label' => esc_html__('Button Link','education-buz'),
            'priority' => 8,
            'type' => 'text',
            'section' => 'education_buz_home_cta_section'
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_cta_bg_image',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'education_buz_cta_bg_image',
           array(
               'label'      => esc_html__( 'Section BG Image', 'education-buz' ),
               'section'    => 'education_buz_home_cta_section',
               'settings'   => 'education_buz_cta_bg_image',
               'priority' => 9,
           )
       )
    );
    
    /** Blog Section **/
    $wp_customize->add_section(
        'education_buz_home_blog_section',
        array(
            'title'		=> esc_html__( 'Blog Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_blog_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_blog_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Blog Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_blog_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Blog Section Title **/
    $wp_customize->add_setting(
    'education_buz_blog_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_blog_section_title',
        array(
            'label' => esc_html__('Section Title','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_home_blog_section'
        )
    );
    $wp_customize->add_setting(
        'education_buz_blog_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_cat_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_blog_cat',
        array(
            'label' => esc_html__('Blog Category','education-buz'),
            'priority' => 8,
            'type' => 'select',
            'choices' => $education_buz_Category_list,
            'section' => 'education_buz_home_blog_section'
        )
    );
    
    /** Portfolio Section **/
    $wp_customize->add_section(
        'education_buz_home_portfolio_section',
        array(
            'title'		=> esc_html__( 'Portfolio Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_portfolio_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_portfolio_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Portfolio Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_portfolio_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Portfolio Section Title **/
    $wp_customize->add_setting(
    'education_buz_portfolio_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_portfolio_section_title',
        array(
            'label' => esc_html__('Section Title','education-buz'),
            'priority' => 4,
            'type' => 'text',
            'section' => 'education_buz_home_portfolio_section'
        )
    );
    $wp_customize->add_setting(
        'education_buz_portfolio_layout',
        array(
            'default' => 'layout-1',
            'sanitize_callback' => 'education_buz_sanitize_radio_image'
        )
    );
   	$wp_customize->add_control(
		new education_buz_Custom_Radio_Image_Control( 
			$wp_customize,
			'education_buz_portfolio_layout',
			array(
				'settings'		=> 'education_buz_portfolio_layout',
				'section'		=> 'education_buz_home_portfolio_section',
				'label'			=> esc_html__( 'Portfolio Layout', 'education-buz' ),
                'priority'  => 5,
				'choices'		=> array(
					'layout-1' 	=> get_template_directory_uri() . '/images/layout-1.png',
					'layout-2' 	=> get_template_directory_uri() . '/images/layout-2.png',
				)
			)
		)
	);
    
    $wp_customize->add_setting(
        'education_buz_portfolio_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_cat_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_portfolio_cat',
        array(
            'label' => esc_html__('Portfolio Category','education-buz'),
            'priority' => 8,
            'type' => 'select',
            'choices' => $education_buz_Category_list,
            'section' => 'education_buz_home_portfolio_section'
        )
    );
    
    /** Subscribe Section **/
    $wp_customize->add_section(
        'education_buz_home_subscribe_section',
        array(
            'title'		=> esc_html__( 'Subscribe Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_subscribe_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_subscribe_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Subscribe Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_subscribe_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_subscribe_bg_image',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'education_buz_subscribe_bg_image',
           array(
               'label'      => esc_html__( 'Section BG Image', 'education-buz' ),
               'section'    => 'education_buz_home_subscribe_section',
               'settings'   => 'education_buz_subscribe_bg_image',
               'priority' => 9,
           )
       )
    );
    
    
    /** Blog Section **/
    $wp_customize->add_section(
        'education_buz_home_blog_section',
        array(
            'title'		=> esc_html__( 'Blog Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_blog_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_blog_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Blog Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_blog_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Blog Section Title **/
    $wp_customize->add_setting(
    'education_buz_blog_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_blog_section_title',
        array(
            'label' => esc_html__('Section Title','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_home_blog_section'
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_blog_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_cat_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_blog_cat',
        array(
            'label' => esc_html__('Blog Category','education-buz'),
            'priority' => 8,
            'type' => 'select',
            'choices' => $education_buz_Category_list,
            'section' => 'education_buz_home_blog_section'
        )
    );
    
    /** Testimonial Section **/
    $wp_customize->add_section(
        'education_buz_home_testimonial_section',
        array(
            'title'		=> esc_html__( 'Testimonial Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_testimonial_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_testimonial_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Testimonial Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_testimonial_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Testimonial Section Title **/
    $wp_customize->add_setting(
    'education_buz_testimonial_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_testimonial_section_title',
        array(
            'label' => esc_html__('Section Title','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_home_testimonial_section'
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_testimonial_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_cat_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_testimonial_cat',
        array(
            'label' => esc_html__('Testimonial Category','education-buz'),
            'priority' => 8,
            'type' => 'select',
            'choices' => $education_buz_Category_list,
            'section' => 'education_buz_home_testimonial_section'
        )
    );
    
    /** Team Section **/
    $wp_customize->add_section(
        'education_buz_home_team_section',
        array(
            'title'		=> esc_html__( 'Team Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_team_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_team_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Team Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_team_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Team Section Title **/
    $wp_customize->add_setting(
    'education_buz_team_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_team_section_title',
        array(
            'label' => esc_html__('Section Title','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_home_team_section'
        )
    );
    $wp_customize->add_setting(
        'education_buz_team_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_cat_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_team_cat',
        array(
            'label' => esc_html__('Team Category','education-buz'),
            'priority' => 8,
            'type' => 'select',
            'choices' => $education_buz_Category_list,
            'section' => 'education_buz_home_team_section'
        )
    );
    
    /** Client Section **/
    $wp_customize->add_section(
        'education_buz_home_client_section',
        array(
            'title'		=> esc_html__( 'Client Section', 'education-buz' ),
            'panel'     => 'education_buz_home_panel',
            'priority'  => 5,
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_client_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_client_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Client Section', 'education-buz' ),
            'section' 	=> 'education_buz_home_client_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Client Section Title **/
    $wp_customize->add_setting(
    'education_buz_client_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_client_section_title',
        array(
            'label' => esc_html__('Section Title','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_home_client_section'
        )
    );
    $wp_customize->add_setting(
        'education_buz_client_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'education_buz_sanitize_post_cat_list',
        )
    );
    $wp_customize->add_control(
        'education_buz_client_cat',
        array(
            'label' => esc_html__('Client Category','education-buz'),
            'priority' => 8,
            'type' => 'select',
            'choices' => $education_buz_Category_list,
            'section' => 'education_buz_home_client_section'
        )
    );
    
    
    /** Header Layout Section **/
    $wp_customize->add_section(
        'education_buz_top_header_section',
        array(
            'title'		=> esc_html__( 'Top Header', 'education-buz' ),
            'panel'     => 'education_buz_header_panel',
            'priority'  => 10,
        )
    );
    
    /** Top Header Setting **/
    $wp_customize->add_setting(
        'education_buz_top_header_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_top_header_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Top Header', 'education-buz' ),
            'section' 	=> 'education_buz_top_header_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_top_header_social_seprate',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_top_header_social_seprate', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Social Icon Link', 'education-buz' ),
                'section' 	=> 'education_buz_top_header_section',
                'priority'  => 2,
            )	            	
        )
    );
            
    /** Top Header Social Icon **/
    $wp_customize->add_setting(
    'education_buz_facebook_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
    'education_buz_facebook_link',
        array(
            'label' => esc_html__('Facebook Link','education-buz'),
            'priority' => 4,
            'type' => 'text',
            'section' => 'education_buz_top_header_section'
        )
    );
    $wp_customize->add_setting(
        'education_buz_twitter_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'education_buz_twitter_link',
        array(
            'label' => esc_html__('Twitter Link','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_top_header_section'
        )
    );
     
    $wp_customize->add_setting(
        'education_buz_youtube_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'education_buz_youtube_link',
        array(
            'label' => esc_html__('Youtube Link','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_top_header_section'
        )
    );
     
    $wp_customize->add_setting(
        'education_buz_google_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'education_buz_google_link',
        array(
            'label' => esc_html__('Google Link','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_top_header_section'
        )
    );
     
    $wp_customize->add_setting(
        'education_buz_linkedin_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
     );
    $wp_customize->add_control(
        'education_buz_linkedin_link',
        array(
            'label' => esc_html__('LinkedIn Link','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_top_header_section'
        )
    );
 
    $wp_customize->add_setting(
        'education_buz_pinterest_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'education_buz_pinterest_link',
        array(
            'label' => esc_html__('Pinterest Link','education-buz'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'education_buz_top_header_section'
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_top_header_info_seprate',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_top_header_info_seprate', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Header Info One', 'education-buz' ),
                'section' 	=> 'education_buz_top_header_section',
                'priority'  => 20,
            )	            	
        )
    );
    
    /** Header Info One **/
    $wp_customize->add_setting(
        'education_buz_top_header_info_one_icon',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_FA_Icons_Control(
        $wp_customize, 
            'education_buz_top_header_info_one_icon', 
            array(
                'type' 		=> 'education_buz_fa_icons',
                'label' 	=> esc_html__( 'FA Iocn One', 'education-buz' ),
                'section' 	=> 'education_buz_top_header_section',
                'priority'  => 21,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_header_info_one',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_header_info_one',
        array(
            'label' => esc_html__('Info One','education-buz'),
            'priority' => 23,
            'type' => 'text',
            'section' => 'education_buz_top_header_section'
        )
    );
    
    /** Header Info Two **/
    $wp_customize->add_setting(
        'education_buz_top_header_info_two_seprate',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_Section_Separator(
        $wp_customize, 
            'education_buz_top_header_info_two_seprate', 
            array(
                'type' 		=> 'education_buz_separator',
                'label' 	=> esc_html__( 'Header Info Two', 'education-buz' ),
                'section' 	=> 'education_buz_top_header_section',
                'priority'  => 24,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_top_header_info_two_icon',
	        array(
	            'default' => '',
	            'sanitize_callback' => 'sanitize_text_field',
	        )
    );
    $wp_customize->add_control( new education_buz_Customize_FA_Icons_Control(
        $wp_customize, 
            'education_buz_top_header_info_two_icon', 
            array(
                'type' 		=> 'education_buz_fa_icons',
                'label' 	=> esc_html__( 'FA Iocn Two', 'education-buz' ),
                'section' 	=> 'education_buz_top_header_section',
                'priority'  => 24,
            )	            	
        )
    );
    
    $wp_customize->add_setting(
    'education_buz_header_info_two',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_header_info_two',
        array(
            'label' => esc_html__('Info Two','education-buz'),
            'priority' => 25,
            'type' => 'text',
            'section' => 'education_buz_top_header_section'
        )
    );
    
    
    /** Menu Section **/
    $wp_customize->add_section(
        'education_buz_menu_section',
        array(
            'title'		=> esc_html__( 'Menu Section', 'education-buz' ),
            'panel'     => 'education_buz_header_panel',
            'priority'  => 6,
        )
    );
    
    /** Menu Search Enable Disable **/
    $wp_customize->add_setting(
        'education_buz_search_enable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_search_enable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Header Search', 'education-buz' ),
            'section' 	=> 'education_buz_menu_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );

    /** Footer Section **/
    $wp_customize->add_section(
        'education_buz_copyright_text',
        array(
            'title'		=> esc_html__( 'Footer Setting', 'education-buz' ),
            'panel'     => 'education_buz_footer_panel',
            'priority'  => 1,
        )
    );
    
    /** Footer Copyright Text **/
    $wp_customize->add_setting(
    'education_buz_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'education_buz_footer_copyright_text',
        array(
            'label' => esc_html__('Footer Copyright Text','education-buz'),
            'priority' => 1,
            'type' => 'text',
            'section' => 'education_buz_copyright_text'
        )
    );
    
    $wp_customize->add_setting(
        'education_buz_go_top_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'education_buz_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new education_buz_Customize_Switch_Control(
        $wp_customize, 
        'education_buz_go_top_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Footer Go Up Button', 'education-buz' ),
            'section' 	=> 'education_buz_copyright_text',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'education-buz' ),
                'disable' 	=> esc_html__( 'Disable', 'education-buz' )
                ),
            'priority'  => 1,
        )
        )
    );
    
 }
 
 
 /** Customizer Class **/
 if ( class_exists( 'WP_Customize_Control' ) ) {
    
    /** Switch Button **/
    class education_buz_Customize_Switch_Control extends WP_Customize_Control {

		public $type = 'switch';

		public function render_content() {
	?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
		        <div class="switch_button">
		        	<?php 
		        		$show_choices = $this->choices;
		        		foreach ( $show_choices as $key => $value ) {
		        			echo '<span class="switch_part '.esc_attr($key).'" data-switch="'.esc_attr($key).'">'. esc_html($value).'</span>';
		        		}
		        	?>
                  	<input type="hidden" id="switch_button" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" />
                </div>
            </label>
	<?php
		}
	}
    
    
    /** Radio Image Control Class **/
    class education_buz_Custom_Radio_Image_Control extends WP_Customize_Control {

    	public $type = 'radio-image';
    
    	public function render_content() {
    		if ( empty( $this->choices ) ) {
    			return;
    		}			
    		
    		$name = '_customize-radio-' . $this->id;
    		?>
    		<span class="customize-control-title">
    			<?php echo esc_html( $this->label ); ?>
    			<?php if ( ! empty( $this->description ) ) : ?>
    				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    			<?php endif; ?>
    		</span>
    		<div id="input_<?php echo esc_attr($this->id); ?>" class="image">
    			<?php foreach ( $this->choices as $value => $label ) : ?>
    				<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr($this->id) . esc_attr($value); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
    					<label for="<?php echo esc_attr($this->id) . esc_attr($value); ?>">
    						<img src="<?php echo esc_url( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
    					</label>
    				</input>
    			<?php endforeach; ?>
    		</div>
    		<?php
    	}
    }
    
    /** Separator Class **/
	class education_buz_Customize_Section_Separator extends WP_Customize_Control {
		
		public $type = 'education_buz_separator';

		public function render_content() {
	?>
		<div class="customize-section-wrap">
			<label>
				<span class="customize-control-title sepratop-customizer"><?php echo esc_html( $this->label ); ?></span>
			</label>
		</div>
	<?php
		}
	}
    
    class education_buz_Customize_FA_Icons_Control extends WP_Customize_Control {

		public $type = 'education_buz_fa_icons';

		public function render_content() {

			$saved_icon_value = $this->value();
	?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<div class="tb-fa-icons">
					<div class="ta-icon-preview"><?php if( !empty( $saved_icon_value ) ) { echo '<i class="fa '. esc_attr($saved_icon_value) .'"></i>'; } ?></div>
					<ul class="icons-list-wrapper">
						<?php 
							$education_buz_FA_icons = education_buz_FA_icons();
							foreach ( $education_buz_FA_icons as $education_buz_FA_icon ) {
						          echo '<li><i class="fa fa-'. esc_attr($education_buz_FA_icon) .'" aria-hidden="true"></i></li>';
							}
						?>
					</ul>
					<input type="hidden" class="tb-icon-value" value="" <?php esc_attr($this->link()); ?>>
				</div>

			</label>
	<?php
		}
	}
    
    
}
 
/** Sanitize Function **/
function education_buz_sanitize_enable_disable( $input ) {
    $valid_keys = array(
            'enable'  => esc_html__( 'Enable', 'education-buz' ),
            'disable'  => esc_html__( 'Disable', 'education-buz' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

function education_buz_sanitize_radio_image( $input ) {
    $valid_keys = array(
            'layout-1'  => esc_html__( 'Layout 1', 'education-buz' ),
            'layout-2'  => esc_html__( 'Layout 2', 'education-buz' ),
            'layout-3'  => esc_html__( 'Layout 3', 'education-buz' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/** Customizer Category List Sanitize **/
function education_buz_sanitize_post_cat_list($input){
    $education_buz_Category_list = education_buz_Category_list();
    if(array_key_exists($input,$education_buz_Category_list)){
        return $input;
    }
    else{
        return '';
    }
}

/** Customizer Category List Sanitize **/
function education_buz_sanitize_post_list($input){
    $education_buz_post_lists = education_buz_post_lists();
    if(array_key_exists($input,$education_buz_post_lists)){
        return $input;
    }
    else{
        return '';
    }
}

/** Customizer Textarea Sanitize **/
function education_buz_sanitize_textarea($input){
    return wp_kses_post( force_balance_tags( $input ) );
}