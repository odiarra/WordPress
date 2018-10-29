<?php
/**
 * Education Buz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Education Buz
 */

if ( ! function_exists( 'education_buz_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function education_buz_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on education_buz, use a find and replace
		 * to change 'education-buz' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'education-buz', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
        add_theme_support( 'woocommerce' );
    	add_theme_support( 'wc-product-gallery-zoom' );
    	add_theme_support( 'wc-product-gallery-lightbox' );
    	add_theme_support( 'wc-product-gallery-slider' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
        add_image_size('education_buz-single-page',1170,600,true);
        add_image_size('education-buz-slider-1',1920,900,true);
        add_image_size('education-buz-client-image',250,100,true);
        add_image_size('education-buz-testimonial-image',200,200,true);
        add_image_size('education-buz-blog-image',450,300,true);
        add_image_size('education-buz-portfolio-1-image',800,800,true);
        add_image_size('education-buz-portfolio-2-image',480,700,true);
        add_image_size('education-buz-portfolio-3-image',480,350,true);
        add_image_size('education-buz-team-image',300,400,true);
        add_image_size('education-buz-feature-image',64,64,true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'education-buz-primary-menu' => esc_html__( 'Primary Menu', 'education-buz' ),
		) );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'education_buz_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 80,
    		'width'       => 262,
    		'flex-width'  => true,
    		'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'education_buz_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function education_buz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'education_buz_content_width', 640 );
}
add_action( 'after_setup_theme', 'education_buz_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function education_buz_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'education-buz' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'education-buz' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Home Subscribe Form', 'education-buz' ),
		'id'            => 'education-buz-subscribe-form',
		'description'   => esc_html__( 'Add widgets here.', 'education-buz' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Our Course', 'education-buz' ),
		'id'            => 'education-buz-our-course',
		'description'   => esc_html__( 'Add widgets here.', 'education-buz' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
}
add_action( 'widgets_init', 'education_buz_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function education_buz_scripts() {
    $education_buz_font_query_args = array('family' => 'Open+Sans:300,300i,400,400i,700,700i,800,800i|Roboto:400,500,700');
    wp_enqueue_style( 'education-buz-google-fonts', add_query_arg($education_buz_font_query_args, "//fonts.googleapis.com/css"));
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_style( 'jquery-fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/js/OwlCarousel/owl.carousel.css' );
    wp_enqueue_style( 'education-buz-woocommerce-styles', get_template_directory_uri() . '/woocommerce/woocommerce-styles.css' );
	wp_enqueue_style( 'education-buz-style', get_stylesheet_uri());
    wp_enqueue_style( 'education-buz-responsive', get_template_directory_uri() . '/css/responsive.css' );
    
    wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/js/waypoints/jquery.waypoints.js', array( 'jquery' ), '2.0.5', true );
    wp_enqueue_script( 'isotope-pkgd', get_template_directory_uri(). '/js/isotope/isotope.pkgd.min.js',array('jquery'));
    wp_enqueue_script( 'packery-mode-pkgd', get_template_directory_uri(). '/js/isotope/packery-mode.pkgd.min.js',array('jquery'));
    wp_enqueue_script( 'theia-sticky-sidebar',get_template_directory_uri().'/js/theia-sticky-sidebar/theia-sticky-sidebar.js',array('jquery'));
    wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.js',array('jquery') );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/OwlCarousel/owl.carousel.js',array('jquery') );
	wp_enqueue_script( 'education-buz-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'education-buz-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    wp_enqueue_script( 'education-buz-custom', get_template_directory_uri() . '/js/education-buz-custom.js', array('jquery','imagesloaded'));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'education_buz_scripts' );

function education_buz_customizer_enqueue(){
    wp_enqueue_script( 'jquery-ui-button' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_style( 'education-buz-customizer-style', get_template_directory_uri() . '/inc/customizer/css/customizer-style.css' );
    wp_enqueue_script( 'education-buz-customizer-script', get_template_directory_uri() . '/inc/customizer/js/customizer-script.js', array( 'jquery', 'customize-controls' ), '20160714', true );
}
add_action('customize_controls_enqueue_scripts','education_buz_customizer_enqueue');
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer Option.
 */
require get_template_directory() . '/inc/customizer/customizer-options.php';

/**
 * education_buz Functions.
 */
require get_template_directory() . '/inc/education-buz-function.php';

/**
 * Widget Fields
 **/
require get_template_directory() . '/inc/widget/widgets-field.php';

/**
 * Sidebar Recent Post
 **/
require get_template_directory() . '/inc/widget/education-buz-sidebar-recent-post.php';

/**
 * Sidebar Recent Post
 **/
require get_template_directory() . '/inc/widget/education-buz-course.php';

/**
 * Sidebar Recent Post
 **/
require get_template_directory() . '/woocommerce/woocommerce-functions.php';