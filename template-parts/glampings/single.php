<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="images">
        <div id="single-thumbnail" class="images__gallery thumbnail-gallery">
            <?php glamping_single_thumbnail($post->ID); ?>
        </div>

        <div class="images__right"></div>
    </div>

    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php
// echo '<pre>';
// var_dump(get_attached_media( 'image', $post->ID ));
// echo '<pre>';
