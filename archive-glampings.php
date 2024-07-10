<?php
/**
 * The template for displaying archive glampings
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Glamping_club
 */

get_header();
?>

	<main id="primary" class="archive-glampings container-ag">
		<div class="archive-glampings__left">

			<div class="glampings-filtr glcf-scroll custom-scroll">
				<?php get_template_part( 'template-parts/glampings/archive-filtr' ); ?>
			</div>

			<?php if ( have_posts() ) : ?>

			<div class="glampings-items list">

				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/glampings/archive' );

				endwhile;
				?>

			</div>

				<?php

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div>

		<div class="glampings-map">
			<div id="mapYandex" class="glampings-map__content" style="width:100%; height: 500px;"></div>
		</div>

	</main><!-- #main -->

	<!-- <script>
	ymaps.ready(init);
	function init() {
		var geoJson = JSON.parse(glamping_club_ajax.glAll);
		var zoomNum = (glamping_club_ajax.yand_zoom) ? glamping_club_ajax.yand_zoom : 12;
		map = new ymaps.Map('mapYandexNew', {center:[54.9924, 73.3686], zoom:zoomNum, controls: ['zoomControl',  /*'fullscreenControl'*/]}),
		map.behaviors.disable(['scrollZoom']);
		objectManager = new ymaps.ObjectManager({
			clusterize: true,
			gridSize: 32,
			clusterDisableClickZoom: true
		});
		objectManager.clusters.options.set({preset: 'islands#redClusterIcons'}); // , clusterIconColor: '#00ABAA'
		objectManager.objects.options.set({preset: 'islands#greenMountainIcon'}); // , iconColor: '#00ABAA'
		objectManager.add(geoJson);
		map.geoObjects.add(objectManager);
		map.setBounds(map.geoObjects.getBounds(),{checkZoomRange:true, zoomMargin:9});
		map.geoObjects.events.add('click', function (e) {
			let id = e.get('objectId');
			let geoObject = objectManager.objects.getById(id);
			// console.dir(geoObject.properties.id);
		});
	};

	const glPosts = document.querySelectorAll('article.glampings');
	glPosts.forEach((post) => {
		let postId = post.id.split('-')[1];
		post.addEventListener('mouseenter', function() {
			refreshObjects(Number(postId));
		});
		post.addEventListener('mouseleave', function() {
			backObjects();
		});
	});

	function refreshObjects(elementId) {
		objectManager.objects.each(object => {
			const isActive = object.id === elementId;
			objectManager.objects.setObjectOptions(object.id, {
				preset: isActive ? 'islands#redMountainIcon' : 'islands#greenMountainIcon'
			})
		});
	}

	function backObjects() {
		objectManager.objects.each(object => {
			objectManager.objects.setObjectOptions(object.id, {
				preset: 'islands#greenMountainIcon'
			})
		});
	}
	</script> -->

<?php
get_footer();

// echo '<pre>';
// var_dump(glampings_map_render());
// echo '</pre>';
