<?php
defined('ABSPATH') or die('Not allowed');

/*
Plugin Name: My Scroll To Top
Description: Adds a custom scroll to top button to your WordPress site.
* Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4.0
 * Author:            CodeConfig
 * Author URI:        https://codeconfig.dev/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mstt
 * Domain Path: /languages
*/

// Define constant
define('MYSTT_VERSION', time());
define('MYSTT_FILE', __FILE__);
define('MYSTT_PATH', dirname(MYSTT_FILE));
define('MYSTT_INC', MYSTT_PATH . '/includes');
define('MYSTT_URL', plugin_dir_url(__FILE__));
define('MYSTT_ASSETS', MYSTT_URL . 'assets');

if (realpath(MYSTT_INC . '/mystt-base.php')) {
    require_once realpath(MYSTT_INC . '/mystt-base.php');
}

// Add Custom Scroll To Top HTML
function mystt_frontend()
{
    echo '<div id="my-scroll-to-top"></div>';
}
add_action("wp_footer", 'mystt_frontend');

// Customization settings
function mystt_custom($wp_customize)
{
    // Panels and Sections
    $wp_customize->add_panel('mystt_panel', array(
        'title'    => __('Scroll To Top Settings', 'mstt'),
        'priority' => 10,
    ));

    $wp_customize->add_section('my_scroll_to_top_section', array(
        'title'       => __('Position Settings', 'mstt'),
        'description' => __("Customize it to fit seamlessly with your site's design and make navigation easier for your visitors.", 'mstt'),
        'panel'       => 'mystt_panel',
        'priority'    => 10,
    ));

    $wp_customize->add_section('mystt_btn_color_section', array(
        'title'       => __('Color Settings', 'mstt'),
        'description' => __("Enhance your website's appearance by customizing the color of the Scroll to Top button.", 'mstt'),
        'panel'       => 'mystt_panel',
        'priority'    => 1,
    ));

    $wp_customize->add_section('mystt_btn_border_section', array(
        'title'       => __('Border Settings', 'mstt'),
        'description' => __("Improve your website's aesthetics by customizing the border settings of your Scroll to Top button.", 'mstt'),
        'panel'       => 'mystt_panel',
        'priority'    => 3,
    ));

    // Add settings and controls for colors, borders, and positions
    $wp_customize->add_setting('mystt_btn_color', array(
        'default'   => '#000000',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mystt_btn_color_control', array(
        'label'    => __('Background Color', 'mstt'),
        'description' => __("Change Your Scroll To Top Button Background Color", 'mstt'),
        'section'  => 'mystt_btn_color_section',
        'settings' => 'mystt_btn_color',
    )));

    // Continue adding other controls...

    // Add a setting for the button position
    $wp_customize->add_setting('mystt_btn_position', array(
        'default'   => 'right',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('mystt_btn_position_control', array(
        'label'    => __('Change Position', 'mstt'),
        'description' => __("Change Your Scroll To Top Button Position", 'mstt'),
        'section'  => 'my_scroll_to_top_section',
        'settings' => 'mystt_btn_position',
        'type'     => 'select',
        'choices'  => array(
            'right' => __('Right', 'mstt'),
            'center' => __('Center', 'mstt'),
            'left' => __('Left', 'mstt'),
        ),
    ));
}
add_action("customize_register", "mystt_custom");

// Click To Up CSS Customization
function mystt_color_css()
{
    // Get custom theme modification values
    $position = get_theme_mod("mystt_btn_position", 'right');
    $btn_color = esc_attr(get_theme_mod("mystt_btn_color"));
    $btn_border_radius = esc_attr(get_theme_mod("mystt_btn_border_radius")) . "px";
    $btn_border_style = esc_attr(get_theme_mod("mystt_btn_border_style"));
    $btn_border_width = esc_attr(get_theme_mod("mystt_btn_border_width")) . "px";
    $btn_border_color = esc_attr(get_theme_mod("mystt_btn_border_color"));
    $btn_custom_top_position = esc_attr(get_theme_mod("mystt_btn_custom_top_position")) . "px";
    $btn_hover_color = esc_attr(get_theme_mod("mystt_btn_hover_color"));
    $btn_border_hover_color = esc_attr(get_theme_mod("mystt_btn_border_hover_color"));
    $btn_icon_color = esc_attr(get_theme_mod("mystt_btn_icon_color"));
    $btn_icon_hover_color = esc_attr(get_theme_mod("mystt_btn_icon_hover_color"));

    // Determine CSS position based on selected option
    $cssPosition = ($position === 'center') ? 'margin: 0 auto; left: 0; right: 0;' : ($position === 'left' ? 'left: 30px;' : 'right: 30px;');

    // Create the CSS string
    $custom_css = "
        #my-scroll-to-top {
            background-color: {$btn_color};
            border-radius: {$btn_border_radius};
            border-style: {$btn_border_style};
            border-width: {$btn_border_width};
            border-color: {$btn_border_color};
            bottom: {$btn_custom_top_position};
            {$cssPosition}
            position: fixed;
        }

        #my-scroll-to-top:hover {
            background-color: {$btn_hover_color};
            border-color: {$btn_border_hover_color};
        }

        #my-scroll-to-top:after {
            border-color: {$btn_icon_color};
        }

        #my-scroll-to-top:hover:after {
            border-color: {$btn_icon_hover_color};
        }
    ";

    // Enqueue main stylesheet and add inline custom CSS
    wp_enqueue_style('mystt-main-style', MYSTT_ASSETS . '/css/style.css', array(), MYSTT_VERSION);
    wp_add_inline_style('mystt-main-style', $custom_css);
}
add_action('wp_head', 'mystt_color_css');
