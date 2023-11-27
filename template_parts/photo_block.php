<!-- Bloc détail photo + Overlay--> 

<div class="bloc-photo">
    <div class="img-container">
        <?php the_post_thumbnail('full', ['class' => 'gallery-image']); ?>
    </div>
    <div class="photo-overlay">
        <a href="<?php the_permalink(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icone_eye.png" alt="Eye Icon" class="eye-icon">
        </a>
        <span class="photo-ref" hidden><?php echo get_field('reference'); ?></span>
        <span class="photo-cat" hidden><?php echo get_field('categorie'); ?></span>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icone_window.png" alt="Open Light Box" class="window-icon">
    </div>
</div>