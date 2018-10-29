<?php
/**
 * Template Name: Home Page
 */
get_header(); 

    /** About Section **/
    $education_buz_about_enable_disable = get_theme_mod('education_buz_about_enable_disable');
    if($education_buz_about_enable_disable){
        get_template_part( 'template-parts/sections/section', 'about' );
    }
    
    /** Skill Section **/
    $education_buz_skill_enable_disable = get_theme_mod('education_buz_skill_enable_disable');
    if($education_buz_skill_enable_disable){
        get_template_part( 'template-parts/sections/section', 'skill' );
    }
    
    /** Course Section **/
    $education_buz_course_enable_disable = get_theme_mod('education_buz_course_enable_disable');
    if($education_buz_course_enable_disable){
        get_template_part( 'template-parts/sections/section', 'course' );
    }
    
    /** Feature Section **/
    $education_buz_feature_enable_disable = get_theme_mod('education_buz_feature_enable_disable');
    if($education_buz_feature_enable_disable){
        get_template_part( 'template-parts/sections/section', 'feature' );
    }
    
    /** CTA Section **/
    $education_buz_cta_enable_disable = get_theme_mod('education_buz_cta_enable_disable');
    if($education_buz_cta_enable_disable){
        get_template_part( 'template-parts/sections/section', 'cta' );
    }
    
    /** Portfolio Section **/
    $education_buz_portfolio_enable_disable = get_theme_mod('education_buz_portfolio_enable_disable');
    if($education_buz_portfolio_enable_disable){
        get_template_part( 'template-parts/sections/section', 'portfolio' );
    }
    
    /** Team Section **/
    $education_buz_team_enable_disable = get_theme_mod('education_buz_team_enable_disable');
    if($education_buz_team_enable_disable){
        get_template_part( 'template-parts/sections/section', 'team' );
    }
    
    /** Blog Section **/
    $education_buz_blog_enable_disable = get_theme_mod('education_buz_blog_enable_disable');
    if($education_buz_blog_enable_disable){
        get_template_part( 'template-parts/sections/section', 'blog' );
    }
    
    /** Testimonial Section **/
    $education_buz_testimonial_enable_disable = get_theme_mod('education_buz_testimonial_enable_disable');
    if($education_buz_testimonial_enable_disable){
        get_template_part( 'template-parts/sections/section', 'testimonial' );
    }
    
    /** Subscribe Section **/
    $education_buz_subscribe_enable_disable = get_theme_mod('education_buz_subscribe_enable_disable');
    if($education_buz_subscribe_enable_disable){
        get_template_part( 'template-parts/sections/section', 'subscribe' );
    }
    
    /** Client Section **/
    $education_buz_client_enable_disable = get_theme_mod('education_buz_client_enable_disable');
    if($education_buz_client_enable_disable){
        get_template_part( 'template-parts/sections/section', 'client' );
    }
    
    
get_footer();