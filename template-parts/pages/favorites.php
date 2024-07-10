<?php
if ( !empty( $_COOKIE["glcFav"] ) ) {
?>
<main id="favorites" class="favorites-main container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
    		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    	</header><!-- .entry-header -->

        <div class="glampings-items card">
            <?php favorites_render($_COOKIE["glcFav"], 'favorites'); ?>
        </div>
        <?php //echo $_COOKIE["glcFav"]; ?>
    </article><!-- #post-<?php the_ID(); ?> -->

</main><!-- #main -->
<?php } else { ?>
<main id="favorites" class="favorites__main container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
    		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    	</header><!-- .entry-header -->

        <div class="content">Нет избранного</div>
    </article><!-- #post-<?php the_ID(); ?> -->

</main><!-- #main -->

<?php
}
