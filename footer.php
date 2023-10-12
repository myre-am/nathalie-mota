<footer>
    <nav>
    <?php get_template_part( 'template-parts/modale-contact' ); ?>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'menu-footer', 
            'menu_class' => 'footer-menu', 
        ));
        ?>
    </nav>
</footer>
