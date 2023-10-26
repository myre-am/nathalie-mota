<?php
get_header();

?>
<main>
<?php
    if (have_posts()) :
        while (have_posts()) : the_post();
?>
    
    <div class="photo-details">
        <h1 class="photo-title"><?php the_title(); ?></h1>
        <?php the_post_thumbnail('medium', array()); ?>
        
        <p>Référence : <?php echo get_field('reference'); ?></p>
        <p>Type : <?php echo get_field('Type'); ?></p>
        <p>Format : <?php echo get_field('Format'); ?></p>
        <p>Catégorie : <?php echo get_field('Catégorie'); ?></p>
        <p>Année : <?php echo get_field('annee'); ?></p>
    </div>
<?php
    endwhile;
    endif;
?>

</main>

<?php get_footer(); ?>

