<div id="post-<?php the_ID(); ?>" class="glamping-item" title="<?php the_title(); ?>">
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="glamping-item__url" rel="bookmark"></a>
	<div class="glamping-item__thumbnail">
		<?php glamping_club_gl_thumbnail('medium'); ?>
	</div>

	<div class="glamping-item__content">
		<?php the_title( '<div class="glamping-item__content__title">', '</div>' ); ?>

	</div><!-- .entry-content -->
</div><!-- #post-<?php the_ID(); ?> -->
