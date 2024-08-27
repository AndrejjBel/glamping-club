<div id="post-info-<?php echo $post->ID; ?>" class="compare-item item-options" title="<?php echo get_the_title( $post->ID ); ?>">
	<div class="compare-item__section section1">
		<div class="compare-item__section__info">
			<div class="glamping-item__content__rating">
				<?php reviews_stars_items_average( 2.94, 4 ); ?>
			</div>
		</div>
	</div>
	<div class="compare-item__section section2">
		<div class="compare-item__section__info">
			<div class="glamping-item__content__bottom">
				<div class="glamping-item__content__bottom__address">
		            <a href="#map-container" title="На карте">
		                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C9.87827 2 7.84344 2.84285 6.34315 4.34315C4.84285 5.84344 4 7.87827 4 10C4 13.0981 6.01574 16.1042 8.22595 18.4373C9.31061 19.5822 10.3987 20.5195 11.2167 21.1708C11.5211 21.4133 11.787 21.6152 12 21.7726C12.213 21.6152 12.4789 21.4133 12.7833 21.1708C13.6013 20.5195 14.6894 19.5822 15.774 18.4373C17.9843 16.1042 20 13.0981 20 10C20 7.87827 19.1571 5.84344 17.6569 4.34315C16.1566 2.84285 14.1217 2 12 2ZM12 23C11.4453 23.8321 11.445 23.8319 11.4448 23.8317L11.4419 23.8298L11.4352 23.8253L11.4123 23.8098C11.3928 23.7966 11.3651 23.7776 11.3296 23.753C11.2585 23.7038 11.1565 23.6321 11.0278 23.5392C10.7705 23.3534 10.4064 23.0822 9.97082 22.7354C9.10133 22.043 7.93939 21.0428 6.77405 19.8127C4.48426 17.3958 2 13.9019 2 10C2 7.34784 3.05357 4.8043 4.92893 2.92893C6.8043 1.05357 9.34784 0 12 0C14.6522 0 17.1957 1.05357 19.0711 2.92893C20.9464 4.8043 22 7.34784 22 10C22 13.9019 19.5157 17.3958 17.226 19.8127C16.0606 21.0428 14.8987 22.043 14.0292 22.7354C13.5936 23.0822 13.2295 23.3534 12.9722 23.5392C12.8435 23.6321 12.7415 23.7038 12.6704 23.753C12.6349 23.7776 12.6072 23.7966 12.5877 23.8098L12.5648 23.8253L12.5581 23.8298L12.556 23.8312C12.5557 23.8314 12.5547 23.8321 12 23ZM12 23L12.5547 23.8321C12.2188 24.056 11.7807 24.0556 11.4448 23.8317L12 23Z" fill="black"></path>
		                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8ZM8 10C8 7.79086 9.79086 6 12 6C14.2091 6 16 7.79086 16 10C16 12.2091 14.2091 14 12 14C9.79086 14 8 12.2091 8 10Z" fill="black"></path>
		                </svg>
		                <?php echo get_additionally_meta('address'); ?>
		            </a>
		        </div>
			</div>
		</div>
	</div>

	<div class="compare-item__section section3">
		<div class="compare-item__section__info">
			<?php echo implode(', ', $post->glamping_type); ?>
		</div>
	</div>
	<div class="compare-item__section section4">
		<div class="compare-item__section__info">
			<span><?php echo get_glamping_allocation_content(); ?></span>
		</div>
	</div>
	<div class="compare-item__section section5">
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
			echo '<div class="compare-item__section section6">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__yes">+</span>
				</div>
			</div>';
		} else {
			echo '<div class="compare-item__section section6">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__no">&mdash;</span>
				</div>
			</div>';
		}
		if (in_array('Парковка - бесплатно', $facilities_general)) {
			echo '<div class="compare-item__section section7">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__text-green">Бесплатно</span>
				</div>
			</div>';
		} elseif (in_array('Парковка - платно', $facilities_general)) {
			echo '<div class="compare-item__section section7">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__text-red">Платно</span>
				</div>
			</div>';
		} else {
			echo '<div class="compare-item__section section7">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__no">&mdash;</span>
				</div>
			</div>';
		}
		if (in_array('Можно с животными - бесплатно', $facilities_general)) {
			echo '<div class="compare-item__section section8">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__text-green">Бесплатно</span>
				</div>
			</div>';
		} elseif (in_array('Можно с животными - платно', $facilities_general)) {
			echo '<div class="compare-item__section section8">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__text-red">Платно</span>
				</div>
			</div>';
		} else {
			echo '<div class="compare-item__section section8">
				<div class="compare-item__section__info">
				<span class="compare-item__section__info__no">&mdash;</span>
				</div>
			</div>';
		}
	} else {
		echo '<div class="compare-item__section section6">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
		echo '<div class="compare-item__section section7">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
		echo '<div class="compare-item__section section8">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$facilities_general_kitchen = $post->facilities_general_kitchen;
	if ($facilities_general_kitchen) {
		echo '<div class="compare-item__section section9">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $facilities_general_kitchen) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section9">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$facilities_general_bathroom = $post->facilities_general_bathroom;
	if ($facilities_general_bathroom) {
		echo '<div class="compare-item__section section10">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $facilities_general_bathroom) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section10">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$glamping_nutrition = $post->glamping_nutrition;
	if ($glamping_nutrition) {
		echo '<div class="compare-item__section section11">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $glamping_nutrition) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section11">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$facilities_options_children = $post->facilities_options_children;
	if ($facilities_options_children) {
		echo '<div class="compare-item__section section12">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $facilities_options_children) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section12">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$glamping_territory = $post->glamping_territory;
	if ($glamping_territory) {
		echo '<div class="compare-item__section section13">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $glamping_territory) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section13">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$facilities_options_safety = $post->facilities_options_safety;
	if ($facilities_options_safety) {
		echo '<div class="compare-item__section section14">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $facilities_options_safety) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section14">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}

	$glamping_entertainment = $post->glamping_entertainment;
	if ($glamping_entertainment) {
		echo '<div class="compare-item__section section15">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__text">' . implode(", ", $glamping_entertainment) . '</span>
			</div>
		</div>';
	} else {
		echo '<div class="compare-item__section section15">
			<div class="compare-item__section__info">
			<span class="compare-item__section__info__no">&mdash;</span>
			</div>
		</div>';
	}
	?>

</div>
