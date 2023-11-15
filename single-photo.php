<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
      <!-- Détail d'une photo --> 
        <div class="photo-details">
            <div class="photo-content">
                <h1><?php the_title(); ?></h1>

                <p>Référence : <?php echo get_field('reference'); ?></p>
                <p>Type : <?php echo get_field('Type'); ?></p>
                <p>Format : <?php echo get_field('Format'); ?></p>
                <p>Catégorie : <?php echo get_field('Catégorie'); ?></p>
                <p>Année : <?php echo get_field('annee'); ?></p>
            </div>
            <div class="photo-image">
                <?php the_post_thumbnail('large', array()); ?>
            </div>
        </div>
        <!-- Bouton contact --> 
        <div class="infos-photos">
            <div class="photo-contact">
                <p>Cette photo vous intéresse?</p>
                <button class="open-modale" data-reference="<?php echo get_field('reference'); ?>"> Contact </button>
            </div>
            <?php
                 // Récupéréation des inofmations du post précédant
                $prev_post = get_previous_post();
                $prev_thumbnail = $prev_post ? get_the_post_thumbnail($prev_post->ID, 'thumbnail') : '';
                $prev_link = get_permalink($prev_post->ID);

                // Récupération des informations du post suivant
                $next_post = get_next_post();
                $next_thumbnail = $next_post ? get_the_post_thumbnail($next_post->ID, 'thumbnail') : '';
                $next_link = get_permalink($next_post->ID);
            ?>
            <div class="photo-navigation">
                
                <?php if ($prev_post): ?>
                <a href="<?php echo esc_url($prev_link); ?>" class="thumbnail-nav prev-photo">
                    <span class="miniature1" ><?php echo $prev_thumbnail; ?></span>
                    <img class="nav-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/Arrow_left.png" alt="Précédente" />
                </a>
                <?php endif; ?>
                
                
                <?php if ($next_post): ?>
                <a href="<?php echo esc_url($next_link); ?>" class="thumbnail-nav next-photo">
                    <span class="miniature2" ><?php echo $next_thumbnail; ?></span>
                    <img class="nav-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/Arrow_right.png" alt="Suivante" />
                </a>
                <?php endif; ?>
                
            </div>
        </div>

        <div class="related-photos-title">
            <h3>VOUS AIMEREZ AUSSI...</h3>
        </div>

        <!-- Photos apparentés --> 
        <div class="related-photos">           
            

            <?php
            $current_photo_id = get_the_ID();
            $related_cat = get_field('Catégorie');

            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 2,
                'post__not_in' => array($current_photo_id),
                'meta_query' => array(
                    array(
                        'key' => 'Catégorie',
                        'value' => $related_cat,
                        'compare' => '='
                    )
                )
            );

            $related_query = new WP_Query($args);

            if ($related_query->have_posts()):
                while ($related_query->have_posts()): $related_query->the_post();
                    get_template_part('template_parts/photo_block');
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>Aucune autre photo trouvée dans cette catégorie.</p>';
            endif;
            ?>
        </div>
        <!-- Bouton 'toutes les photos'--> 
        <div class="all-photos">
            <button class="btn-all-photos">
                <a href="<?php echo home_url( '/' ); ?>" >Toutes les photos</a>
            </button>
        </div>

    <?php
    endwhile;
endif;

get_footer();
?>
