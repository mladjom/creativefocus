<?php
/**
 * creativefocus functions and definitions
 *
 * @package creativefocus
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 1140; /* pixels */
}
/**
 * Assign the Tilesrus version to a var
 */
$theme = wp_get_theme();
$creativefocus_version = $theme['Version'];

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function creativefocus_setup()
{

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on creativefocus, use a find and replace
     * to change 'creativefocus' to the name of your theme in all the template files
     */
    load_theme_textdomain('creativefocus', get_template_directory() . '/languages');

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
     * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1140, 9999, false);

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'creativefocus'),
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

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
    ));

    // Set up the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('creativefocus_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    )));

}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function creativefocus_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'creativefocus'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

/**
 * Enqueue scripts and styles.
 */
function creativefocus_scripts()
{
    global $creativefocus_version;
    // Use minified libraries if SCRIPT_DEBUG is turned off
    $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
    wp_enqueue_style('creativefocus-style', get_template_directory_uri() . '/assets/css/style' . $suffix . '.css', array(), $creativefocus_version);
    wp_enqueue_script('creativefocus-script', get_template_directory_uri() . '/assets/js/script' . $suffix . '.js', array('jquery'), $creativefocus_version, true);
    wp_enqueue_script('creativefocus-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), $creativefocus_version, true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
