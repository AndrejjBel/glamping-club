<div id="post-<?php echo $post->ID; ?>" class="glamping-item" title="<?php echo get_the_title( $post->ID ); ?>">
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="glamping-item__url" rel="bookmark"></a>
	<div class="glamping-item__thumbnail">
		<?php glamping_club_gl_thumbnail('medium'); ?>
	</div>

	<div class="glamping-item__content">
        <div class="glamping-item__content__title">
            <?php echo get_the_title( $post->ID ); ?>
        </div>
	</div><!-- .entry-content -->
</div><!-- #post-<?php echo $post->ID; ?> -->
