<div id="post-<?php the_ID(); ?>" class="glamping-item" title="<?php the_title(); ?>">
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="glamping-item__url" rel="bookmark"></a>
	<button id="add-favorites" data-postid="<?php the_ID(); ?>" class="glamping-item__btn-add round-sup-red" type="button" name="button" title="Добавить в избранное">
		<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
			<path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
		</svg>
	</button>
	<div class="glamping-item__thumbnail">
		<?php glamping_club_gl_thumbnail_slider($post->ID); //glamping_club_gl_thumbnail('medium'); ?>
	</div>

	<div class="glamping-item__content">
		<div class="glamping-item__content__left">
			<?php the_title( '<div class="glamping-item__content__title">', '</div>' ); ?>

			<div class="glamping-item__content__rating">
				<?php //get_rating_post(2.94, 4); // рейтинг / отзывы ?>
				<?php reviews_stars_items_average( 2.94, 4 ); ?>
			</div>

			<div class="glamping-item__content__bottom">
				<div class="glamping-item__content__bottom__type">
					<svg width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path d="M394.3 3.745C401.1 9.425 401.9 19.52 396.3 26.29L308.9 130.4L532.8 397.2C540 405.8 544 416.7 544 428V464C544 490.5 522.5 512 496 512H80C53.49 512 32 490.5 32 464V428C32 416.7 35.98 405.8 43.23 397.2L267.1 130.4L179.7 26.29C174.1 19.52 174.9 9.425 181.7 3.745C188.5-1.936 198.6-1.054 204.3 5.715L287.1 105.5L371.7 5.715C377.4-1.054 387.5-1.936 394.3 3.745H394.3zM64 428V464C64 472.8 71.16 480 80 480H129.9L275.4 294.1C278.4 290.3 283.1 288 288 288C292.9 288 297.6 290.3 300.6 294.1L446.1 480H496C504.8 480 512 472.8 512 464V428C512 424.2 510.7 420.6 508.3 417.7L288 155.3L67.74 417.7C65.33 420.6 64 424.2 64 428zM170.6 480H405.4L288 329.1L170.6 480z"></path>
                    </svg>
					<?php echo get_glamping_type_content(); ?>
				</div>
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

		<div class="glamping-item__content__right">
			<div class="glamping-item__content__right__price">
				<span class="price-number"><?php echo number_format(round($post->glamping_price, 1), 0, ',', ' '); ?> ₽</span>
				<span class="price-text">за 1 ночь</span>
			</div>
			<div class="glamping-item__content__right__btn">
				<button class="primary ld w100 btnvib" type="button" name="button">выбрать</button>
			</div>
		</div>
	</div><!-- .entry-content -->
</div><!-- #post-<?php the_ID(); ?> -->
