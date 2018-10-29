<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education Buz
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-buz' ); ?></a>

    <?php $education_buz_top_header_enable_disable = get_theme_mod('education_buz_top_header_enable_disable');
    if($education_buz_top_header_enable_disable == 'enable'){ ?>
    <div class="tb-top-header">
        <div class="tb-container clearfix">
            <div class="tb-secondary">
                <?php $education_buz_facebook_link = get_theme_mod('education_buz_facebook_link');
                    $education_buz_twitter_link = get_theme_mod('education_buz_twitter_link');
                    $education_buz_youtube_link = get_theme_mod('education_buz_youtube_link');
                    $education_buz_google_link = get_theme_mod('education_buz_google_link');
                    $education_buz_linkedin_link = get_theme_mod('education_buz_linkedin_link');
                    $education_buz_pinterest_link = get_theme_mod('education_buz_pinterest_link');
                    if($education_buz_facebook_link || $education_buz_twitter_link || $education_buz_youtube_link || 
                    $education_buz_google_link || $education_buz_linkedin_link || $education_buz_pinterest_link){ ?>
                        <div class="social-links">
                            <?php if($education_buz_facebook_link){?><a class="facebook" href="<?php echo esc_url($education_buz_facebook_link); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a><?php }
                            if($education_buz_twitter_link){?><a class="twitter" href="<?php echo esc_url($education_buz_twitter_link); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a><?php }
                            if($education_buz_youtube_link){?><a class="youtube" href="<?php echo esc_url($education_buz_youtube_link); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a><?php }
                            if($education_buz_google_link){?><a class="google" href="<?php echo esc_url($education_buz_google_link); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a><?php }
                            if($education_buz_linkedin_link){?><a class="linkedin" href="<?php echo esc_url($education_buz_linkedin_link); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a><?php }
                            if($education_buz_pinterest_link){?><a class="pinterest" href="<?php echo esc_url($education_buz_pinterest_link); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a><?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php
                    $education_buz_header_info_one = get_theme_mod('education_buz_header_info_one');
                    $education_buz_header_info_two = get_theme_mod('education_buz_header_info_two');
                    if($education_buz_header_info_one || $education_buz_header_info_one){
                    $education_buz_top_header_info_one_icon = get_theme_mod('education_buz_top_header_info_one_icon');
                    $education_buz_top_header_info_two_icon = get_theme_mod('education_buz_top_header_info_two_icon');?>
                        <div id="top-site-info">
                        
                            <?php if($education_buz_header_info_one){ ?>
                                <div class="info-top">
                                    <span>
                                        <?php if($education_buz_top_header_info_one_icon){?>
                                            <i class="fa <?php echo esc_attr($education_buz_top_header_info_one_icon); ?>" aria-hidden="true"></i>
                                        <?php } ?>
                                        <?php echo esc_html($education_buz_header_info_one); ?>
                                    </span>
                                </div>
                            <?php } ?>
                            
                            <?php if($education_buz_header_info_two){ ?>
                                <div class="info-top">
                                    <span>
                                        <?php if($education_buz_top_header_info_two_icon){?>
                                            <i class="fa <?php echo esc_attr($education_buz_top_header_info_two_icon); ?>" aria-hidden="true"></i>
                                        <?php } ?>
                                        <?php echo esc_html($education_buz_header_info_two); ?>
                                    </span>
                                </div>
                            <?php } ?>
                            
                		</div>
                    <?php } ?>
              </div>
        </div>
    </div>
    <?php } ?>
    
	<header id="masthead" class="site-header">
        
		<nav id="site-navigation" class="main-navigation">
        
            <div class="tb-container">
            
                <div class="tb-logo-menu">
                    <div class="site-branding">
                        <?php if ( function_exists( 'the_custom_logo' ) ){?>
                        
                            <?php if ( has_custom_logo() ) { ?>
                                <div class="site-logo">
                                    <?php the_custom_logo(); ?>
                                </div>
                            <?php }else{?>
                                <div class="site-text">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                                        <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                                    </a>
                                </div>
                            <?php }
                            
                        } ?>
                    </div><!-- .site-branding -->
                    
                    <div class="menu-main-wrap">
                        <div id="toggle" class="toggle">
            	            <span class="one"> </span>
            	            <span class="two"> </span>
            	            <span class="three"> </span>
            	        </div>
            			<?php
            				wp_nav_menu( array(
            					'theme_location' => 'education-buz-primary-menu',
            					'menu_id'        => 'primary-menu',
            				) );
            			?>
                    </div>
                    
                    <?php $education_buz_header_search_enable = get_theme_mod('education_buz_search_enable');
                     if($education_buz_header_search_enable == 'enable'){ ?>
                         <div class="search-toggle">
                            <a href="javascript:void(0)" class="search-icon"><i class="fa fa-search"></i></a>
            				<div class="tb-search">
            				    <?php get_search_form(); ?>
            				</div>
                        </div>
                    <?php } ?>
                </div>
                
            </div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<div id="content" class="site-content">
    <?php
    if(!is_home() || !is_front_page()){
        do_action('education_buz_header_banner');
    }
    
    if(is_home() || is_front_page()){
            $education_buz_banner_enable_disable = get_theme_mod('education_buz_banner_enable_disable');
            if($education_buz_banner_enable_disable == 'enable'){
                do_action('education_buz_home_banner');
            }
    }
