<?php
function glamping_club_result_render($location=0) {
    $args = array(
        'post_type' => 'glampings',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        // 'nopaging'  => true,
        'orderby' => 'meta_value date', //meta_value_num, title
        'meta_key' => 'glamping_recommended',
        'order' => 'DESC',
    );

    if( $location ) {
        $terms = explode(",", $location);
        $args[ 'tax_query' ] = [
            [
                'taxonomy' => 'location',
                'field'    => 'id',
                'terms'    => $terms
            ]
        ];
    }

    $gl_posts = get_posts( $args );

    global $post;
    $glampings = [];
    foreach ($gl_posts as $post) {
        setup_postdata( $post );
        $cur_terms = get_the_terms( $post->ID, 'location' );
        $post_url = get_permalink($post->ID);
        $post_title = get_the_title( $post->ID );
        $thumbnail_url = get_the_post_thumbnail_url( $post->ID, 'full' );
        // $statistic = glamping_club_reviews_statistic($post->ID);
        $address = get_additionally_meta('address');
        $coord = get_additionally_meta('coordinates');
        $phone = get_additionally_meta('phone_glamping');
        $whatsup = get_additionally_meta('whatsup_glamping');
        $post_date = get_the_date('U', $post->ID);
        $media = array_unique(glamping_all_img($post->ID));
        $media_urls = [];
        foreach ( $media as $img ) {
    		$url = wp_get_attachment_image_url( $img, 'glamping-club-thumb' );
            $media_urls[] = $url;
    	}
        $working_mode_seasons = $post->working_mode_seasons;
        if ($post->working_mode == 'whole_year') {
            // $working_mode_seasons = 'whole_year';
            $working_mode_seasons = ['Весь год', 'январь','февраль','март','апрель','май','июнь','июль','август','сентябрь','октябрь','ноябрь','декабрь'];
        }
        $glampings[] = [
            'id' => $post->ID,
            'post_date' => $post_date,
            'title' => $post_title,
            'type' => $post->glamping_type,
            'allocation' => $post->glamping_allocation,
            'working_mode' => $post->working_mode,
            'working_mode_seasons' => $working_mode_seasons,
            'recommended' => $post->glamping_recommended,
            'price' => $post->glamping_price,
            'nature_around' => $post->glamping_nature_around,
            'facilities_general' => $post->glamping_facilities_general,
            'facilities_children' => $post->facilities_options_children,
            'entertainment' => $post->glamping_entertainment,
            'territory' => $post->glamping_territory,
            'safety' => $post->facilities_options_safety,
            'adress' => $address,
            'coordinates' => $coord,
            'url' => $post_url,
            'thumbnail_url' => $thumbnail_url,
            'location' => $cur_terms[0]->name,
            'location_id' => $cur_terms[0]->term_id,
            'location_slug' => $cur_terms[0]->slug,
            'media' => $media,
            'media_urls' => $media_urls,
            'phone' => $phone,
            'whatsup' => $whatsup
        ];
    }
    wp_reset_postdata();
    $glampings_fin = json_encode($glampings, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    // if ($location) {
    //     $key = 'glampings_obj_' . $location;
    //     update_option( $key, $glampings_fin );
    // } else {
    //     update_option( 'glampings_obj', $glampings_fin );
    // }
    update_option( 'glampings_obj', $glampings_fin, false );
    return $glampings_fin;
}
// glamping_club_result_render();
