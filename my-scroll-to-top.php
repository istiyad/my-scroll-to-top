<?php
defined('ABSPATH') or die('Not allowed');

/*
Plugin Name: My Scroll To Top
Description: Adds a custom scroll to top button to your WordPress site.
Version: 1.0.0
Author: CodeConfig
Author URL: https://codeconfig.dev/
*/

//  Define constant
define( 'MYSTT_VERSION', time() );
define( 'MYSTT_FILE', __FILE__ );
define( 'MYSTT_PATH', dirname( MYSTT_FILE ) );
define( 'MYSTT_INC', MYSTT_PATH . '/includes' );
define( 'MYSTT_URL', plugin_dir_url( __FILE__ ) );
define( 'MYSTT_ASSETS', MYSTT_URL . 'assets' );

if ( realpath( MYSTT_INC . '/mystt-base.php' ) ) {
    require_once realpath( MYSTT_INC . '/mystt-base.php' );
}


// Add Custom Scroll To Top HTML
function mystt_frontend() {
    echo '<div id="my-scroll-to-top"></div>';
}
add_action("wp_footer", 'mystt_frontend');

// Customization settings
function mystt_custom($wp_customize) {
    $wp_customize->add_panel('mystt_panel', array(
        'title'    => __('Scroll To Top Settings', 'my-scroll-to-top-color'),
        'priority' => 10,
    ));

    $wp_customize->add_section('my_scroll_to_top_section', array(
        'title'       => __('Position Settings', 'my-scroll-to-top-color'),
        'description' => __("Customize it to fit seamlessly with your site's design and make navigation easier for your visitors.", 'my-scroll-to-top-color'),
        'panel'       => 'mystt_panel',  
        'priority'    => 10,
    ));

    $wp_customize->add_section('mystt_btn_color_section', array(
        'title'       => __('Color Settings', 'my-scroll-to-top-color'),
        'description' => __("Enhance your website's appearance by customizing the color of the Scroll to Top button.", 'my-scroll-to-top-color'),
        'panel'       => 'mystt_panel',
        'priority'    => 1,
    ));

    $wp_customize->add_section('mystt_btn_border_section', array(
        'title'       => __('Border Settings', 'my-scroll-to-top-color'),
        'description' => __("Improve your website's aesthetics by customizing the border settings of your Scroll to Top button.", 'my-scroll-to-top-color'),
        'panel'       => 'mystt_panel',
        'priority'    => 3,
    ));

    // Add a setting for change the button color
    $wp_customize->add_setting('mystt_btn_color', array(
        'default'   => '#000000',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mystt_btn_color_control', array(
        'label'    => __('Background Color', 'my-scroll-to-top-color'),
        'description' => __("Change Your Scroll To Top Button Background Color", 'my-scroll-to-top-color'),
        'section'  => 'mystt_btn_color_section',
        'settings' => 'mystt_btn_color',
    )));
    // Add a setting for change the button hover color
    $wp_customize->add_setting('mystt_btn_hover_color', array(
        'default'   => '#476df4',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mystt_btn_hover_color_control', array(
        'label'    => __('Background Hover Color', 'my-scroll-to-top-color'),
        'description' => __("Change Your Scroll To Top Button Background Hover Color", 'my-scroll-to-top-color'),
        'section'  => 'mystt_btn_color_section',
        'settings' => 'mystt_btn_hover_color',
    )));

    // Add a setting for change the button icon color
    $wp_customize->add_setting('mystt_btn_icon_color', array(
        'default'   => '#476df4',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('mystt_btn_icon_color_control', array(
        'label'    => __('Icon Color', 'my-scroll-to-top-color'),
        'description' => __("Change Your Scroll To Top Button Icon Color", 'my-scroll-to-top-color'),
        'section'  => 'mystt_btn_color_section',
        'settings' => 'mystt_btn_icon_color',
        'type'     => 'color',
    ));

    // Add a setting for change the button icon hover color
    $wp_customize->add_setting('mystt_btn_icon_hover_color', array(
        'default'   => '#476df4',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('mystt_btn_icon_hover_color_control', array(
        'label'    => __('Icon Hover Color', 'my-scroll-to-top-color'),
        'description' => __("Change Your Scroll To Top Button Icon Hover Color", 'my-scroll-to-top-color'),
        'section'  => 'mystt_btn_color_section',
        'settings' => 'mystt_btn_icon_hover_color',
        'type'     => 'color',
    ));

    // Add a setting for the button border radius
    $wp_customize->add_setting('mystt_btn_border_radius', array(
            'default'           => 5, 
            'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('mystt_btn_border_radius_control', array(
        'label'    => __('Border Radius', 'my-scroll-to-top-range'),
        'description' => __("Change Your Scroll To Top Button Border Radius", 'my-scroll-to-top-color'),
        'section'  => 'mystt_btn_border_section',
        'settings' => 'mystt_btn_border_radius',
        'type'     => 'range',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
    ));

    // Add a setting for the button border style
    $wp_customize->add_setting('mystt_btn_border_style', array(
        'default'   => 'none',
        'transpost' => 'refresh',
    ));

    $wp_customize->add_control('mystt_btn_border_style_control', array(
    'label'    => __('Border Style', 'my-scroll-to-top-select'),
    'description' => __("Change Your Scroll To Top Button Border Style", 'my-scroll-to-top-color'),
    'section'  => 'mystt_btn_border_section',
    'settings' => 'mystt_btn_border_style',
    'type'     => 'select',
    'choices'  => array(
        'none' => __('None', 'my-scroll-to-top-select'),
        'solid' => __('Solid', 'my-scroll-to-top-select'),
        'dotted' => __('Dotted', 'my-scroll-to-top-select'),
        'dashed' => __('Dashed', 'my-scroll-to-top-select'),
        'double' => __('Double', 'my-scroll-to-top-select'),
        'groove' => __('Groove', 'my-scroll-to-top-select'),
        'hidden' => __('Hidden', 'my-scroll-to-top-select'),
        'inset' => __('Inset', 'my-scroll-to-top-select'),
        'outset' => __('Outset', 'my-scroll-to-top-select'),
        'inherit' => __('Inherit', 'my-scroll-to-top-select'),
        'initial' => __('Initial', 'my-scroll-to-top-select'),
        'revert' => __('Revert', 'my-scroll-to-top-select'),
        ),
    ));
    
    // Add a setting for the button border width
    $wp_customize->add_setting('mystt_btn_border_width', array(
            'default'           => 1, 
            'transport'         => 'refresh',
    ));

    $wp_customize->add_control('mystt_btn_border_width_control', array(
        'label'    => __('Border Width', 'my-scroll-to-top-range'),
        'description' => __("Change Your Scroll To Top Button Border Width", 'my-scroll-to-top-color'),
        'section'  => 'mystt_btn_border_section',
        'settings' => 'mystt_btn_border_width',
        'type'     => 'range',
        'input_attrs' => array(
            'min' => 0,
            'max' => 20,
            'step' => 1,
        ),
    ));
    
    // Add a setting for the button border color
    $wp_customize->add_setting('mystt_btn_border_color', array(
        'default'   => '#000',
        'transport' => 'refresh'
    ));

    $wp_customize-> add_control('mystt_btn_border_color_control', array(
        'label'    => __('Add Border Color', 'my-scroll-to-top-color'),
        'description' => __("Change Your Scroll To Top Button Border Color", 'my-scroll-to-top-color'),
        'section'  => 'mystt_btn_border_section',
        'settings' => 'mystt_btn_border_color',
        'type'     => 'color',
    ));

    // Add a setting for the button border hover color
    $wp_customize->add_setting('mystt_btn_border_hover_color', array(
        'default'   => '#848439',
        'transpost' => 'refresh',
    ));

    $wp_customize->add_control('mystt_btn_border_hover_color_control', array(
        'label'    => __('Add Border Hover Color', 'my-scroll-to-top-color'),
        'description' => __("Change Your Scroll To Top Button Border Hover Color", 'my-scroll-to-top-color'),
        'section'  => 'mystt_btn_border_section',
        'settings' => 'mystt_btn_border_hover_color',
        'type'     => 'color',
    ));

    // Add a setting for the button position
    $wp_customize->add_setting('mystt_btn_position', array(
        'default'   => 'right',
        'transpost' => 'refresh',
    ));

    $wp_customize->add_control('mystt_btn_position_right_control', array(
    'label'    => __('Change Position', 'my-scroll-to-top-select'),
    'description' => __("Change Your Scroll To Top Button Position", 'my-scroll-to-top-color'),
    'section'  => 'my_scroll_to_top_section',
    'settings' => 'mystt_btn_position',
    'type'     => 'select',
    'choices'  => array(
        'right' => __('Right', 'my-scroll-to-top-select'),
        'center' => __('Center', 'my-scroll-to-top-select'),
        'left' => __('Left', 'my-scroll-to-top-select'),
        ),
    ));

    // Add a setting for the button custom position width
    $wp_customize->add_setting('mystt_btn_custom_top_position', array(
            'default'           => 30, 
            'transport'         => 'refresh',
    ));

    $wp_customize->add_control('mystt_btn_custom_top_position_control', array(
        'label'    => __('Custom Position X', 'my-scroll-to-top-range'),
        'description' => __("Change Your Scroll To Top Button Custom Position", 'my-scroll-to-top-color'),
        'section'  => 'my_scroll_to_top_section',
        'settings' => 'mystt_btn_custom_top_position',
        'type'     => 'range',
        'input_attrs' => array(
            'min' => 30,
            'max' => 200,
            'step' => 1,
        ),
    ));

}
add_action("customize_register", "mystt_custom");

// Click To Up CSS Customization
function mystt_color_css(){
    $position = get_theme_mod("mystt_btn_position");
    $cssPosition = '';

    if($position === 'right') {

        $cssPosition = 'right: 30px;';

    }else if($position === 'center') {

        $cssPosition = 'margin: 0 auto; left: 0; right: 0;';
    
    }else if($position === 'left') {

        $cssPosition = 'left: 30px;';
    }

    ?>
    <style>
        #my-scroll-to-top{
            background-color: <?php print get_theme_mod("mystt_btn_color"); ?>;
            border-radius: <?php echo get_theme_mod("mystt_btn_border_radius") . "px"; ?>;
            border-style: <?php print get_theme_mod("mystt_btn_border_style"); ?>;
            border-width: <?php echo get_theme_mod("mystt_btn_border_width") . "px"; ?>;
            border-color: <?php print get_theme_mod("mystt_btn_border_color"); ?>;
            bottom: <?php echo get_theme_mod("mystt_btn_custom_top_position") . "px"; ?>;
            <?php echo $cssPosition; ?>
        }

        #my-scroll-to-top:hover {
            background-color: <?php print get_theme_mod("mystt_btn_hover_color"); ?>;
            border-color: <?php print get_theme_mod("mystt_btn_border_hover_color"); ?>;
        }
        
        #my-scroll-to-top:after{
            border-color: <?php print get_theme_mod("mystt_btn_icon_color"); ?>;
        }

        #my-scroll-to-top:hover:after{
            border-color: <?php print get_theme_mod("mystt_btn_icon_hover_color"); ?>;
        }
    </style>

    <?php
}
add_action('wp_head', 'mystt_color_css')


?>