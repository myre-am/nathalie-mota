<?php
get_header();

// Hero Header
$hero_args = array(
    'post_type'      => 'photo',
    'posts_per_page' => 1,
    'orderby'        => 'rand',
);
$random_photo_query = new WP_Query($hero_args);

if ($random_photo_query->have_posts()) {
    while ($random_photo_query->have_posts()) {
        $random_photo_query->the_post();
        ?>
        <main>
            <section class="hero-header">
                <?php the_post_thumbnail(); ?>
                <div class="hero-title">
                    <img class="hero-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/title_header.png" alt="Hero Title">
                </div>
            </section>
        </main>
        <?php
    }
    wp_reset_postdata();
}

// Catalogue Photos
$photos_args = array(
    'post_type' => 'photo',
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'DESC',
);
$photos_query = new WP_Query($photos_args);

if ($photos_query->have_posts()) :
    ?>
    <main>
        <section class="photo-catalogue">
            <div class="photos-grid">
                <?php
                while ($photos_query->have_posts()) : $photos_query->the_post();
                    get_template_part('template_parts/photo_block', null, array('post' => $post));
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <div class="load-photos">
                <button id="load-more" class="btn-load-more" >Charger plus</button>
            </div>
        </section>
    </main>
    <?php
endif;

get_footer();
?>

