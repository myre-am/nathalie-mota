<?php

// Chargement du style du thème & script
function enqueue_styles_and_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/css/style.css', array(), filemtime(get_stylesheet_directory() . '/css/style.css'));
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), filemtime(get_stylesheet_directory().'/assets/js/script.js'), true);
    wp_localize_script('custom-script', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), filemtime(get_stylesheet_directory().'/assets/js/lightbox.js'), true);

    // Chargement du script de filtrage personnalisé
    wp_enqueue_script('my-custom-filter', get_template_directory_uri() . '/assets/js/custom-filter.js', array('jquery'), null, true);
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
add_theme_support('post-thumbnails');

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

    echo json_encode(['max' => $ajaxposts->max_num_pages, 'html' => $output]);
    exit;
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

// Filtres des photos

function filters_images() {
    // Récupération des paramètres de la requête AJAX
    $selectedCategory = $_POST['selectedCategory'] ?? 'all';
    $selectedFormat = $_POST['selectedFormat'] ?? 'all';
    $sortOrder = $_POST['sortOrder'] ?? 'DESC'; // L'ordre de tri

    // Préparation des arguments pour WP_Query
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'orderby' => 'date',
        'order' => $sortOrder, // Utilisation de l'ordre de tri
        'meta_query' => array(
            'relation' => 'AND'
        )
    );

    // Ajout des filtres de catégorie et de format
    if ($selectedCategory != 'all') {
        array_push($args['meta_query'], array(
            'key' => 'categorie',
            'value' => $selectedCategory,
            'compare' => '='
        ));
    }

    if ($selectedFormat != 'all') {
        array_push($args['meta_query'], array(
            'key' => 'format',
            'value' => $selectedFormat,
            'compare' => '='
        ));
    }

    // Exécution de la requête WP_Query
    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template_parts/photo_block', null, array());
        }
    } else {
        echo 'Aucun résultat trouvé.';
    }

    wp_reset_postdata();

    $response = ob_get_clean();
    echo $response;
    exit;
}

add_action('wp_ajax_nopriv_filters_images', 'filters_images');
add_action('wp_ajax_filters_images', 'filters_images');



