<main id="favorites" class="favorites__main container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
    		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    	</header><!-- .entry-header -->
    </article><!-- #post-<?php the_ID(); ?> -->

</main><!-- #main -->

<?php
// echo $_COOKIE["glcFav"];
