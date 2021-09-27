<?php 
/**
 *  Template for entry content.
 * 
 *  To be used inside WordPress The loop;
 * 
 *  @package AquilaKili
 */

?>

<div class="entry-content">
    <?php 
        if (is_single()){
            the_content(
                sprintf(
                    wp_kses(
                        __('Continue reading %s <span clas="meta-nav">&rarr;</span>', 'aquilakili'),
                        [
                            'span' => [
                                'class' => []
                            ]
                        ]
                            ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                )
            );
            wp_link_pages(
                [
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'aquilakili'),
                    'after' => '</div>',
                ]
            );
        } else {
            kili_the_excerpt( 200 );
            printf('<br>');
            echo kili_excerpt_more();
        }

    ?>
</div>
