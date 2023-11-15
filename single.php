<?php
get_header();

?>


    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); <?>

        <div><h1>YOOO</h1></div>
        

    
    <?php        
        endwhile;
        endif;
    ?>
        
    


<?php get_footer(); ?>
