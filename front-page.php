<?php
get_header();

$hero_args = array(
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'orderby' => 'rand',
);
$random_photo_query = new WP_Query($hero_args);

// Récupération des options de catégorie et de format depuis ACF
if (function_exists('acf_get_field')) {
    $field_categorie = acf_get_field('categorie');
    $field_format = acf_get_field('format');
}

$choices_categorie = $field_categorie ? $field_categorie['choices'] : [];
$choices_format = $field_format ? $field_format['choices'] : [];
?>

<main>
    <h1>Natalie Mota Photographie</h1>

    <!-- Hero Header -->
    
    <?php if ($random_photo_query->have_posts()) : while ($random_photo_query->have_posts()) : $random_photo_query->the_post(); ?>
        <section class="hero-header">
            <?php the_post_thumbnail(); ?>
            <div class="hero-title">
                <img class="hero-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/title_header.png" alt="Hero Title">
            </div>
        </section>
    <?php endwhile; wp_reset_postdata(); endif; ?>
    
    <section class="filters-container">
        <div class="filters-group">
            <!-- Filtre des catégories -->
            <div class="filter-category">
                <input type="text" id="category-input" placeholder="Catégorie" readonly>
                <ul id="category-list" class="filter-list" style="display: none;">
                    <?php foreach ($choices_categorie as $value => $label) : ?>
                        <li data-category="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></li>
                   <?php endforeach; ?>
               </ul>
           </div>
        
            <!-- Filtre des formats -->
            <div class="filter-format">
                <input type="text" id="format-input" placeholder="Format" readonly>
                <ul id="format-list" class="filter-list" style="display: none;">
                    <?php foreach ($choices_format as $value => $label) : ?>
                        <li data-format="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></li>
                   <?php endforeach; ?>
                </ul>
            </div>
       </div>

       <!-- Conteneur pour le filtre Trier par -->
       <div class="filter-sort">
            <input type="text" id="sort-input" placeholder="Trier par" readonly>
            <ul id="sort-list" class="filter-list" style="display: none;">
                <li data-sort="DESC">Du plus récent au plus ancien</li>
                <li data-sort="ASC">Du plus ancien au plus récent</li>
            </ul>
        </div>
    </section>


    <section class="photo-catalogue">
        <div class="photos-grid">
            <?php
            $photos_args = array(
                'post_type' => 'photo',
                'posts_per_page' => 8,
                'orderby' => 'date',
                'order' => 'DESC',
            );
            $photos_query = new WP_Query($photos_args);

            if ($photos_query->have_posts()) : while ($photos_query->have_posts()) : $photos_query->the_post();
                get_template_part('template_parts/photo_block', null, array('post' => $post));
            endwhile; wp_reset_postdata(); endif;
            ?>
        </div>
        <div class="load-photos">
            <button id="load-more" class="btn-load-more">Charger plus</button>
        </div>
    </section>
</main>

<?php
get_footer();
?>
