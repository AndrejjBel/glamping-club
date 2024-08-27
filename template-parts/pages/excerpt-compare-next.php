<div id="post-info-<?php echo $post->ID; ?>" class="compare-item item-options" title="<?php echo get_the_title( $post->ID ); ?>">
	<div class="compare-item__section section1">
		<div class="compare-item__section__info">
			<?php echo implode(', ', $post->glamping_type); ?>
		</div>
	</div>
	<div class="compare-item__section section2">
		<div class="compare-item__section__info">
			<span><?php echo get_glamping_allocation_content(); ?></span>
		</div>
	</div>
	<div class="compare-item__section section3">
		<?php
		$nature_around = $post->glamping_nature_around;
		if ($nature_around) {
			echo '<div class="compare-item__section__info">
	            <span class="compare-item__section__info__text">' . implode(", ", $nature_around) . '</span>
				</div>';
		} else {
			echo '<div class="compare-item__section__info">
	            <span class="compare-item__section__info__no">&mdash;</span>
				</div>';
		}
		?>
	</div>

	<?php
	$facilities_general = $post->glamping_facilities_general;
	if ($facilities_general) {
		if (in_array('Wi-Fi', $facilities_general)) {
			echo '<div class="compare-item__section section4">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__yes">+</span>
				</div>
			</div>';
		} else {
			echo '<div class="compare-item__section section4">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__no">&mdash;</span>
				</div>
			</div>';
		}
		if (in_array('Парковка - бесплатно', $facilities_general)) {
			echo '<div class="compare-item__section section5">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__text-green">Бесплатно</span>
				</div>
			</div>';
		} elseif (in_array('Парковка - платно', $facilities_general)) {
			echo '<div class="compare-item__section section5">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__text-red">Платно</span>
				</div>
			</div>';
		} else {
			echo '<div class="compare-item__section section5">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__no">&mdash;</span>
				</div>
			</div>';
		}
		if (in_array('Можно с животными - бесплатно', $facilities_general)) {
			echo '<div class="compare-item__section section6">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__text-green">Бесплатно</span>
				</div>
			</div>';
		} elseif (in_array('Можно с животными - платно', $facilities_general)) {
			echo '<div class="compare-item__section section6">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__text-red">Платно</span>
				</div>
			</div>';
		} else {
			echo '<div class="compare-item__section section6">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__no">&mdash;</span>
				</div>
			</div>';
		}
	} else {
		echo '<div class="compare-item__section section4">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
		echo '<div class="compare-item__section section5">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
		echo '<div class="compare-item__section section6">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$facilities_general_kitchen = $post->facilities_general_kitchen;
	if ($facilities_general_kitchen) {
		echo '<div class="compare-item__section section7">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $facilities_general_kitchen) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section7">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$facilities_general_bathroom = $post->facilities_general_bathroom;
	if ($facilities_general_bathroom) {
		echo '<div class="compare-item__section section8">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $facilities_general_bathroom) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section8">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$glamping_nutrition = $post->glamping_nutrition;
	if ($glamping_nutrition) {
		echo '<div class="compare-item__section section9">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $glamping_nutrition) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section9">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$facilities_options_children = $post->facilities_options_children;
	if ($facilities_options_children) {
		echo '<div class="compare-item__section section10">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $facilities_options_children) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section10">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$glamping_territory = $post->glamping_territory;
	if ($glamping_territory) {
		echo '<div class="compare-item__section section11">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $glamping_territory) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section11">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$facilities_options_safety = $post->facilities_options_safety;
	if ($facilities_options_safety) {
		echo '<div class="compare-item__section section12">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $facilities_options_safety) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section12">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$glamping_entertainment = $post->glamping_entertainment;
	if ($glamping_entertainment) {
		echo '<div class="compare-item__section section13">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $glamping_entertainment) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section13">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}
	?>

</div>
