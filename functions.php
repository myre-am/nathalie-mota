<?php

// Chargement du style du thème & script
function enqueue_styles_and_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/css/style.css', array(), filemtime(get_stylesheet_directory() . '/css/style.css'));
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), filemtime(get_stylesheet_directory().'/assets/js/script.js'), true);
    wp_localize_script('custom-script', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));

}
add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');

// Menus
function register_my_menus() {
    register_nav_menu('menu-principal', 'Menu Principal'); 
    register_nav_menu('menu-footer', 'Menu Footer'); 
}
add_action('after_setup_theme', 'register_my_menus');

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
add_theme_support( 'post-thumbnails' );

// Bouton 'Charger plus' / AJAX / 

function load_more_photos() {
    $paged = $_POST['paged'] ?? 1;

    $ajaxposts = new WP_Query([
        'post_type' => 'photo',
        'posts_per_page' => 8, 
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $paged,
    ]);

    $response = '';
    $max_pages = $ajaxposts->max_num_pages;

    if ($ajaxposts->have_posts()) {
        ob_start();
        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            get_template_part('template_parts/photo_block');
        endwhile;
        $output = ob_get_contents();
        ob_end_clean();
    } else {
        $output = '';
    }

    echo json_encode(['max' => $max_pages, 'html' => $output]);
    exit;
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');




