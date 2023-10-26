<?php
get_header();

?>

<main>
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            // Utilisation du modèle single-photo.php pour les publications de type 'photo'
            if (get_post_type() === 'photo') {
                get_template_part('single-photo');
            } else {
                // Utilisation du modèle par défaut pour les autres types de publications
                get_template_part('content', get_post_format());
            }
        endwhile;
    endif;
    ?>
        
    
</main>

<?php get_footer(); ?>
