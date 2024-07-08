<?php
if ( !empty( $_COOKIE["glcCompar"] ) ) {
?>
<main id="compare" class="compares__main container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
    		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    	</header><!-- .entry-header -->

        <div class="content">
            <?php favorites_render($_COOKIE["glcCompar"], 'compare'); ?>
        </div>
    </article><!-- #post-<?php the_ID(); ?> -->

</main><!-- #main -->
<?php } else { ?>
<main id="compare" class="compares__main container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
    		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    	</header><!-- .entry-header -->

        <div class="content">Нет глэмпингов для сравнения</div>
    </article><!-- #post-<?php the_ID(); ?> -->

</main><!-- #main -->

<?php
}
