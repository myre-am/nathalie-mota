<!doctype html>
<html lang="<?php echo get_bloginfo('language'); ?>">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Photographe d'event">


        <?php wp_head();?>
    </head>
    
<body>
<header class="header">
    <div>
        <?php if (get_theme_mod('logo')) : ?>
            <img src="<?php echo esc_url(get_theme_mod('logo')); ?>" alt="Logo du site">
        <?php else : ?>
        <img class="logo" src="<?php echo get_template_directory_uri() . '/assets/images/logo.png'; ?>" alt="Logo de Nathalie Moto">
        <?php endif; ?>
        
    </div>
    <nav>
        <?php
            wp_nav_menu(array(
            'theme_location' => 'menu-principal', 
            'menu_class' => 'menu-principal'));
        ?>        
    </nav>

</header>
    

    