<?php
/**
 * wpw functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wpw
 */

if (!function_exists('wpw_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wpw_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wpw, use a find and replace
		 * to change 'wpw' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('wpw', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'primary' => esc_html__('Primary', 'wpw'),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('wpw_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		add_theme_support('post-formats', array('gallery', 'quote', 'video', 'aside', 'image', 'link'));
	}
endif;
add_action('after_setup_theme', 'wpw_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wpw_content_width()
{
	$GLOBALS['content_width'] = apply_filters('wpw_content_width', 640);
}

add_action('after_setup_theme', 'wpw_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wpw_widgets_init()
{
	register_sidebar(array(
		'name' => esc_html__('Sidebar', 'wpw'),
		'id' => 'sidebar-1',
		'description' => esc_html__('Add widgets here.', 'wpw'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

add_action('widgets_init', 'wpw_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function wpw_scripts()
{
	wp_enqueue_style('wpw-bootstrap', "//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
	wp_enqueue_style('wpw-fontawesome', "//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
	wp_enqueue_style('wpw-jqueryui', "//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css");

	wp_enqueue_style('wpw-style', get_stylesheet_uri());

	wp_enqueue_script('wpw-jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js');
	wp_enqueue_script('wpw-jqueryui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
	wp_enqueue_script('wpw-bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
	wp_enqueue_script('wpw-fontawesome', 'https://use.fontawesome.com/5e3322d959.js');

	wp_enqueue_style('bootstrap-select', "//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css");
	wp_enqueue_script('bootstrap-select', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js');
	wp_enqueue_script('bootstrap-validation', '//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js');

	wp_enqueue_script('wpw-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);
	wp_enqueue_script('wpw-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);
	wp_enqueue_script('wpw-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20151215', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}

add_action('wp_enqueue_scripts', 'wpw_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/wpw.php';
