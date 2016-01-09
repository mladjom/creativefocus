<?php

/**
 * creativefocus Theme Customizer
 *
 * @package creativefocus
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function creativefocus_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    require_once dirname(__FILE__) . '/controls/layout.php';

    /**
     * Layout
     */
    $wp_customize->add_section('creativefocus_layout', array(
        'title' => __('Layout', 'creativefocus'),
        'priority' => 50,
    ));

    $wp_customize->add_setting('creativefocus_layout', array(
        'default' => 'right',
        'sanitize_callback' => 'creativefocus_sanitize_layout',
    ));

    $wp_customize->add_control(new Layout_Picker_Creativefocus_Control($wp_customize, 'creativefocus_layout', array(
        'label' => __('General layout', 'creativefocus'),
        'section' => 'creativefocus_layout',
        'settings' => 'creativefocus_layout',
        'priority' => 1,
    )));
    /**
     * Blog Columns
     */
    $wp_customize->add_section('creativefocus_blog_columns', array(
        'title' => __('Blog Columns', 'creativefocus'),
        'priority' => 60,
    ));

    $wp_customize->add_setting('creativefocus_blog_columns', array(
        'default' => '3',
        'sanitize_callback' => 'creativefocus_sanitize_blog_columns',
    ));
    $wp_customize->add_control('creativefocus_blog_columns', array(
        'label' => __('Blog Columns', 'creativefocus'),
        'section' => 'creativefocus_blog_columns',
        'type' => 'select',
        'choices' => array(
            '1' => __('1 Column', 'creativefocus'),
            '2' => __('2 Columns', 'creativefocus'),
            '3' => __('3 Columns', 'creativefocus'),
        ),
        'priority' => 1,
    ));
}

add_action('customize_register', 'creativefocus_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function creativefocus_customize_preview_js() {
    wp_enqueue_script('creativefocus_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array('customize-preview'), '20130508', true);
}

add_action('customize_preview_init', 'creativefocus_customize_preview_js');

/**
 * Sanitizes the layout setting
 *
 * Ensures only array keys matching the original settings specified in add_control() are valid
 *
 * @since 1.0.0
 */
if (!function_exists('creativefocus_sanitize_layout')) {

    function creativefocus_sanitize_layout($input) {
        $valid = array(
            'right' => 'Right',
            'left' => 'Left',
            'without' => 'Without',
        );

        if (array_key_exists($input, $valid)) {
            return $input;
        } else {
            return '';
        }
    }

}

/**
 * Layout classes
 * Adds 'right-sidebar' 'left-sidebar' and without-sidebar classes to the body tag
 * @param  array $classes current body classes
 * @return string[] modified body classes
 * @since  1.0.0
 */
function creativefocus_layout_class($classes) {
    $layout = get_theme_mod('creativefocus_layout');

    if ('without' == $layout) {
        remove_action('creativefocus_sidebar', 'creativefocus_get_sidebar', 10);
    }

    if ('' == $layout) {
        $layout = 'right';
    }

    $classes[] = $layout . '-sidebar';

    return $classes;
}

add_filter('body_class', 'creativefocus_layout_class');

/**
 * Sanitizes the blog columns setting
 *
 * Ensures only array keys matching the original settings specified in add_control() are valid
 *
 * @since 1.0.0
 */
if (!function_exists('creativefocus_sanitize_blog_columns')) {

    function creativefocus_sanitize_blog_columns($input) {
        $valid = array(
            '1' => '1 Column',
            '2' => '2 Columns',
            '3' => '3 Columns',
        );

        if (array_key_exists($input, $valid)) {
            return $input;
        } else {
            return '';
        }
    }

}

/**
 * Blog Column classes
 * Adds 'right-sidebar' 'left-sidebar' and without-sidebar classes to the body tag
 * @param  array $classes current body classes
 * @return string[]          modified body classes
 * @since  1.0.0
 */
function creativefocus_blog_columns_class($classes) {
    $layout = get_theme_mod('creativefocus_blog_columns');

    if ('' == $layout) {
        $layout = '1';
    }

    $classes[] = 'col-' . $layout;

    return $classes;
}

add_filter('post_class', 'creativefocus_blog_columns_class');
