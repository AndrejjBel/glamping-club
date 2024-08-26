<div id="post-info-<?php echo $post->ID; ?>" class="compare-item item-options" title="<?php echo get_the_title( $post->ID ); ?>">
	<div class="compare-item__section">
		<div class="compare-item__section__info">
			<?php echo implode(', ', $post->glamping_type); ?>
		</div>
	</div>
	<div class="compare-item__section">
		<div class="compare-item__section__info">
			<span><?php echo get_glamping_allocation_content(); ?></span>
		</div>
	</div>
	<div class="compare-item__section">
		<div class="compare-item__section__info">
			<?php
			$nature_around = $post->glamping_nature_around;
			if ($nature_around) {
				echo '<div class="compare-item__section">
					<div class="compare-item__section__info">
		            <span>' . implode(", ", $nature_around) . '</span>
					</div>
				</div>';
			} else {
				echo '<div class="compare-item__section">
					<div class="compare-item__section__info">
		            <span>&mdash;</span>
					</div>
				</div>';
			}
			?>
		</div>
	</div>

	<?php
	$facilities_general = $post->glamping_facilities_general;
	if ($facilities_general) {
		if (in_array('Wi-Fi', $facilities_general)) {
			echo '<div class="compare-item__section">
				<div class="compare-item__section__info">
				<span>Wi-Fi</span>
				</div>
			</div>';
		} else {
			echo '<div class="compare-item__section">
				<div class="compare-item__section__info">
				<span>&mdash;</span>
				</div>
			</div>';
		}
		if (in_array('Парковка - бесплатно', $facilities_general)) {
			echo '<div class="compare-item__section">
				<div class="compare-item__section__info">
				<span>Парковка-бесплатно</span>
				</div>
			</div>';
		} else {
			echo '<div class="compare-item__section">
				<div class="compare-item__section__info">
				<span>&mdash;</span>
				</div>
			</div>';
		}if (in_array('Можно с животными', $facilities_general)) {
			echo '<div class="compare-item__section">
				<div class="compare-item__section__info">
				<span>Можно с животными</span>
				</div>
			</div>';
		} else {
			echo '<div class="compare-item__section">
				<div class="compare-item__section__info">
				<span>&mdash;</span>
				</div>
			</div>';
		}
	} else {
		echo '<div class="compare-item__section">
			<div class="compare-item__section__info">
			<span>&mdash;</span>
			</div>
		</div>';
		echo '<div class="compare-item__section">
			<div class="compare-item__section__info">
			<span>&mdash;</span>
			</div>
		</div>';
		echo '<div class="compare-item__section">
			<div class="compare-item__section__info">
			<span>&mdash;</span>
			</div>
		</div>';
	}
	?>

</div>
