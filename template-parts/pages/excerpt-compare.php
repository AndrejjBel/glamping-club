<div id="post-<?php echo $post->ID; ?>" class="compare-item item-top" title="<?php echo get_the_title( $post->ID ); ?>">
	<div class="compare-item__section">
		<div class="compare-item__section__thumbnail">
			<?php
			$media = array_unique(glamping_all_img($post->ID), SORT_REGULAR);
			if( $media ) {
				echo wp_get_attachment_image( $media[0], 'glamping-club-thumb' );
			} else {
				$glc_options = get_option( 'glc_options' );
				$no_foto_id = '';
				if (array_key_exists('glamping_no_photo_id', $glc_options)) {
					$no_foto_id = $glc_options['glamping_no_photo_id'];
					echo wp_get_attachment_image( $no_foto_id, 'glamping-club-thumb' );
				}
			}
			?>
		</div>
	</div>
	<div class="compare-item__section section-bottom-item-top">
		<div class="compare-item__section__info">
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="compare-item__section__url-glemp" rel="bookmark">
				<?php echo the_title(); ?>
			</a>
		</div>
		<div class="compare-item__section__info">
			<span class="price-number"><?php echo number_format(round($post->glamping_price, 1), 0, ',', ' '); ?> ₽</span>
		</div>
	</div>
</div>
