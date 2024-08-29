<?php
/**
 * The template for displaying all single glampings
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Glamping_club
 */
global $post;
get_header();
?>

	<main id="primary" class="site-main single-glampings-main container">

		<?php get_template_part( 'template-parts/glampings/single'); ?>

	</main><!-- #main -->

	<div class="related-wrap">
		<div class="glampings-items card related-list container">
			<div class="related-list__title">
	            <h3>Вам также может понравиться:</h3>
	        </div>
			<?php glampings_related_list($post->ID); ?>
		</div>
	</div>

	<div class="contacts-mobail-btn">
		<div class="contacts-mobail-btn__content">
			<div class="contacts-mobail-btn__content__icons">
				<div class="contacts-mobail-btn__content__icons__item icon-phone">
					<svg width="20" height="20" class="phone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					    <path d="M484.6 330.6C484.6 330.6 484.6 330.6 484.6 330.6l-101.8-43.66c-18.5-7.688-40.2-2.375-52.75 13.08l-33.14 40.47C244.2 311.8 200.3 267.9 171.6 215.2l40.52-33.19c15.67-12.92 20.83-34.16 12.84-52.84L181.4 27.37C172.7 7.279 150.8-3.737 129.6 1.154L35.17 23.06C14.47 27.78 0 45.9 0 67.12C0 312.4 199.6 512 444.9 512c21.23 0 39.41-14.44 44.17-35.13l21.8-94.47C515.7 361.1 504.7 339.3 484.6 330.6zM457.9 469.7c-1.375 5.969-6.844 10.31-12.98 10.31c-227.7 0-412.9-185.2-412.9-412.9c0-6.188 4.234-11.48 10.34-12.88l94.41-21.91c1-.2344 2-.3438 2.984-.3438c5.234 0 10.11 3.094 12.25 8.031l43.58 101.7C197.9 147.2 196.4 153.5 191.8 157.3L141.3 198.7C135.6 203.4 133.8 211.4 137.1 218.1c33.38 67.81 89.11 123.5 156.9 156.9c6.641 3.313 14.73 1.531 19.44-4.219l41.39-50.5c3.703-4.563 10.16-6.063 15.5-3.844l101.6 43.56c5.906 2.563 9.156 8.969 7.719 15.22L457.9 469.7z"/>
					</svg>
				</div>
				<div class="contacts-mobail-btn__content__icons__item icon-message">
					<svg width="20" height="20" class="message" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					    <path d="M256 31.1c-141.4 0-255.1 93.13-255.1 208c0 47.62 19.91 91.25 52.91 126.3c-14.87 39.5-45.87 72.88-46.37 73.25c-6.623 7-8.374 17.25-4.624 26C5.816 474.3 14.38 480 24 480c61.49 0 109.1-25.75 139.1-46.25c28.1 9 60.16 14.25 92.9 14.25c141.4 0 255.1-93.13 255.1-207.1S397.4 31.1 256 31.1zM256 416c-28.25 0-56.24-4.25-83.24-12.75c-9.516-3.068-19.92-1.461-28.07 4.338c-22.1 16.25-58.54 35.29-102.7 39.66c11.1-15.12 29.75-40.5 40.74-69.63l.1289-.3398c4.283-11.27 1.791-23.1-6.43-32.82C47.51 313.1 32.06 277.6 32.06 240c0-97 100.5-176 223.1-176c123.5 0 223.1 79 223.1 176S379.5 416 256 416zM256 216c-13.25 0-24 10.74-24 24c0 13.25 10.75 24 24 24s24-10.75 24-24C280 226.7 269.3 216 256 216zM384 216c-13.25 0-24 10.74-24 24c0 13.25 10.75 24 24 24s24-10.75 24-24C408 226.7 397.3 216 384 216zM128 216c-13.25 0-24 10.74-24 24c0 13.25 10.75 24 24 24S152 253.3 152 240C152 226.7 141.3 216 128 216z"/>
					</svg>
				</div>
				<svg class="close" width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
				    <path d="M315.3 411.3c-6.253 6.253-16.37 6.253-22.63 0L160 278.6l-132.7 132.7c-6.253 6.253-16.37 6.253-22.63 0c-6.253-6.253-6.253-16.37 0-22.63L137.4 256L4.69 123.3c-6.253-6.253-6.253-16.37 0-22.63c6.253-6.253 16.37-6.253 22.63 0L160 233.4l132.7-132.7c6.253-6.253 16.37-6.253 22.63 0c6.253 6.253 6.253 16.37 0 22.63L182.6 256l132.7 132.7C321.6 394.9 321.6 405.1 315.3 411.3z" fill="#FFFFFF"/>
				</svg>
			</div>
			<button id="contacts-mobail-btn" type="button" name="button"></button>
		</div>
	</div>

<?php
get_footer();
