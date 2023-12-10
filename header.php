<!doctype html>
<html lang="<?php echo get_bloginfo('language'); ?>">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Photographe d'event">


        <?php wp_head();?>
    </head>
    
<body>
    <!-- Header  -->
    
<header class="header">
    <div>
        <a href="<?php echo home_url(); ?>">
            <?php if (get_theme_mod('logo')) : ?>
            <img src="<?php echo esc_url(get_theme_mod('logo')); ?>" alt="Logo du site">
            <?php else : ?>
            <img class="logo" src="<?php echo get_template_directory_uri() . '/assets/images/logo.png'; ?>" alt="Logo de Nathalie Moto">
            <?php endif; ?>
        </a>
        
    </div>
    <nav>
        <?php
            wp_nav_menu(array(
            'theme_location' => 'menu-principal', 
            'menu_class' => 'menu-principal'));
        ?>
         
    </nav>
    <!-- Menu burger -->
    <button class="burger-menu-button">
        <span></span>
        <span></span>
        <span></span>
    </button>

</header>
    

    