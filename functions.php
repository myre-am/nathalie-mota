<?php

function enqueue_styles_and_scripts() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/style.css'));
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/script.js', array(), filemtime(get_stylesheet_directory().'/assets/js/script.js'), true);
}
add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');

// Menus
function register_custom_menus() {
    register_nav_menu('menu-principal', 'Menu Principal'); 
    register_nav_menu('menu-footer', 'Menu Footer'); 
}
add_action('after_setup_theme', 'register_custom_menus');

// Personnalisation du logo
function theme_customizer_logo($wp_customize) {
    // Paramètre pour le logo
    $wp_customize->add_setting('logo', array(
        'transport' => 'refresh',
    ));

    // Contrôle pour le logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label' => 'Changer le logo',
        'section' => 'title_tagline',
        'settings' => 'logo',
    )));
}
add_action('customize_register', 'theme_customizer_logo');