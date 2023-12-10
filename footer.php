<!-- Footer -->

<footer>
    
    <?php get_template_part( 'template_parts/modal-contact' ); ?>
    <?php get_template_part( 'template_parts/lightbox' ); ?>
    
    <?php
        wp_nav_menu(array(
            'theme_location' => 'menu-footer', 
            'menu_class' => 'footer-menu', 
        ));
    ?>
    
    
</footer>
<?php wp_footer(); ?>
</body>
</html
