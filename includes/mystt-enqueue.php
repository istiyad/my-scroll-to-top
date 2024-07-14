<?php
defined('ABSPATH') or die('Not allowed');

// Enqueue JavaScript and CSS files
function mystt_script() {
    // Enqueue JavaScript file
    wp_enqueue_script('my-scroll-to-top', MYSTT_ASSETS . '/js/my-scroll-to-top.js', array('jquery'), MYSTT_VERSION, true);
    // Enqueue CSS file
    wp_enqueue_style('my-scroll-to-top-style', MYSTT_ASSETS . '/css/my-scroll-to-top.css', array(), MYSTT_VERSION, 'all');
}
add_action('wp_enqueue_scripts', 'mystt_script');