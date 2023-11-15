<!-- Bloc détail photo + Overlay--> 

<div class="bloc-photo">
    <a href="<?php the_permalink(); ?>">
        <div class="img-container">
            <?php the_post_thumbnail('full'); ?>
        </div>
            <div class="photo-overlay">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icone_eye.png" alt="Eye Icon" class="eye-icon">
                <span class="photo-ref"><?php echo get_field('reference'); ?> </span>
                <span class="photo-cat"><?php echo get_field('Catégorie'); ?></span>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icone_window.png" alt="Window Icon" class="window-icon">
            </div>
    
        
    </a>
</div>
