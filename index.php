<?php 
/**
 * Main template file
 * 
 * @package AquilaKili
 */
    get_header();
?>

<div id="primary">
        <main id="main" class="site-main mt-5" role="main">
                <?php 
                        if( have_posts() ) {
                                ?>
                                <div class="container">
                                        <?php 
                                                
                                        ?>
                                        <?php 
                                                while ( have_posts() ) : the_post();
                                                the_title();
                                                the_excerpt();
                                                endwhile;
                                        ?>
                                </div>
                                <?php
                        }
                ?>
        </main>
</div>

<?php 
get_footer();
