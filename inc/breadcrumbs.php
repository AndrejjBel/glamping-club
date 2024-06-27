<?php
function breadcrumbs() {

	/* === ОПЦИИ === */
	$text['home']     = 'Главная'; // текст ссылки "Главная"
	$text['category'] = '%s'; // текст для страницы рубрики
	$text['search']   = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
	$text['tag']      = 'Записи с тегом "%s"'; // текст для страницы тега
	$text['author']   = 'Статьи автора %s'; // текст для страницы автора
	$text['404']      = 'Ошибка 404'; // текст для страницы 404
	$text['page']     = 'Страница %s'; // текст 'Страница N'
	$text['page_status']     = 'Страница ';
	$text['cpage']    = 'Страница комментариев %s'; // текст 'Страница комментариев N'
	$separator        = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M8.99854 11.8577C8.99854 11.0248 9.26181 10.3403 9.78835 9.80418C10.3245 9.26806 11.0329 9 11.9137 9C12.7849 9 13.4933 9.26327 14.039 9.78982C14.5847 10.3068 14.8575 11.0104 14.8575 11.9008V12.4321C14.8575 13.265 14.5943 13.9447 14.0677 14.4713C13.5412 14.9978 12.8279 15.2611 11.928 15.2611C11.0377 15.2611 10.3245 14.9978 9.78835 14.4713C9.26181 13.9352 8.99854 13.2459 8.99854 12.4034V11.8577Z" fill="black"/>
						</svg>';

	$wrap_before    = '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
	$wrap_after     = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
	$sep            = '<span class="breadcrumbs__separator"> ' . $separator . ' </span>'; // разделитель между "крошками"
	$before         = '<span class="breadcrumbs__current" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">'; // тег перед текущей "крошкой"
	$after          = '</span>'; // тег после текущей "крошки"

	$show_on_home   = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
	$show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
	$show_current   = 1; // 1 - показывать название текущей страницы, 0 - не показывать
	$show_last_sep  = 1; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
	/* === КОНЕЦ ОПЦИЙ === */

	global $post;
	$home_url       = home_url('/');
	$link           = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$link          .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span>%2$s</span></a>';
	$link          .= '<meta itemprop="name" content="%3$s" />';
	$link          .= '<meta itemprop="position" content="%4$s" />';
	$link          .= '</span>';
	$parent_id      = ( $post ) ? $post->post_parent : '';
	$home_link      = sprintf( $link, $home_url, $text['home'], $text['home'], 1 );

	$span           = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$span          .= '<span>%1$s</span>';
	$span          .= '<meta itemprop="name" content="%2$s">';
	$span          .= '<meta itemprop="position" content="%3$s" />';
	$span          .= '<meta itemprop="item" content="%4$s" />';
	$span          .= '</span>';

	if ( is_home() || is_front_page() ) {

		if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;

	} else {

		$position = 0;

		echo $wrap_before;

		if ( $show_home_link ) {
			$position += 1;
			echo $home_link;
		}

		if ( is_category() ) {
			$parents = get_ancestors( get_query_var('cat'), 'category' );
			foreach ( array_reverse( $parents ) as $cat ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), get_cat_name( $cat ), $position );
			}
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				$cat = get_query_var('cat');
				echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), get_cat_name( $cat ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_current ) {
					if ( $position >= 1 ) echo $sep;
					echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
				} elseif ( $show_last_sep ) echo $sep;
			}

		} elseif ( is_search() ) {
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				if ( $show_home_link ) echo $sep;
				echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), sprintf( $text['search'], get_search_query() ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_current ) {
					if ( $position >= 1 ) echo $sep;
					echo $before . sprintf( $text['search'], get_search_query() ) . $after;
				} elseif ( $show_last_sep ) echo $sep;
			}

		} elseif ( is_year() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			if ( $show_current ) echo $before . get_the_time('Y') . $after;
			elseif ( $show_home_link && $show_last_sep ) echo $sep;

		} elseif ( is_month() ) {
			if ( $show_home_link ) echo $sep;
			$position += 1;
			echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), get_the_time('Y'), $position );
			if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_day() ) {
			if ( $show_home_link ) echo $sep;
			$position += 1;
			echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), get_the_time('Y'), $position ) . $sep;
			$position += 1;
			echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), get_the_time('F'), $position );
			if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$position += 1;
				$post_type = get_post_type_object( get_post_type() );
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $post_type->labels->name, $position );
				$cur_terms = get_the_terms( get_the_ID(), 'location' );
				if ( $cur_terms ) {
					$position += 1;
					echo $sep;
					foreach( $cur_terms as $cur_term ){
						echo sprintf( $link, get_term_link( $cur_term->term_id, $cur_term->taxonomy ), $cur_term->name, $cur_term->name, $position );
					}
				}

				if ( $show_current ) {
					$position += 1;
					// echo $sep . $before . get_the_title() . $after;
					echo $sep . sprintf( $span, get_the_title(), get_the_title(), $position, get_permalink() );
				}
				elseif ( $show_last_sep ) echo $sep;
			} else {
				$cat = get_the_category(); $catID = $cat[0]->cat_ID;
				$parents = get_ancestors( $catID, 'category' );
				$parents = array_reverse( $parents );
				$parents[] = $catID;
				foreach ( $parents as $cat ) {
					$position += 1;
					if ( $position > 1 ) echo $sep;
					echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), get_cat_name( $cat ), $position );
				}
				if ( get_query_var( 'cpage' ) ) {
					$position += 1;
					echo $sep . sprintf( $link, get_permalink(), get_the_title(), get_the_title(), $position );
					echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
				} else {
					if ( $show_current ) {
						$position += 1;
						// echo $sep . $before . get_the_title() . $after;
						echo $sep . sprintf( $span, get_the_title(), get_the_title(), $position, get_permalink() );
					}
					elseif ( $show_last_sep ) echo $sep;
				}
			}

		} elseif ( is_post_type_archive() ) {
			$post_type = get_post_type_object( get_post_type() );
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $post_type->label, $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				// if ( $show_current ) echo $before . $post_type->label . $after;
				if ( $show_current ) {
					$position += 1;
					echo sprintf( $span, $post_type->label, $post_type->label, $position, get_post_type_archive_link( $post_type->name ) );
				}
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_attachment() ) {
			$parent = get_post( $parent_id );
			$cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
			$parents = get_ancestors( $catID, 'category' );
			$parents = array_reverse( $parents );
			$parents[] = $catID;
			foreach ( $parents as $cat ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), get_cat_name( $cat ), $position );
			}
			$position += 1;
			echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $parent->post_title, $position );
			if ( $show_current ) echo $sep . $before . get_the_title() . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_page() && ! $parent_id ) {
			if ( $show_home_link && $show_current ) echo $sep;
			// if ( $show_current ) echo $before . get_the_title() . $after;
			if ( $show_current ) {
				$position += 1;
				// echo $sep . $before . get_the_title() . $after;
				echo sprintf( $span, get_the_title(), get_the_title(), $position, get_permalink() );
			}
			elseif ( $show_home_link && $show_last_sep ) echo $sep;

		} elseif ( is_page() && $parent_id ) {
			$parents = get_post_ancestors( get_the_ID() );
			foreach ( array_reverse( $parents ) as $pageID ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), get_the_title( $pageID ), $position );
			}
			if ( $show_current ) echo $sep . $before . get_the_title() . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_tag() ) {
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				$tagID = get_query_var( 'tag_id' );
				echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), single_tag_title( '', false ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_author() ) {
			$author = get_userdata( get_query_var( 'author' ) );
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), sprintf( $text['author'], $author->display_name ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_404() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			if ( $show_current ) echo $before . $text['404'] . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( has_post_format() && ! is_singular() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			echo get_post_format_string( get_post_format() );
		} elseif ( is_tax() ) {
			$post_type = get_post_type_object( get_post_type() );
			$term_id = get_queried_object_id();
			$term_link = get_term_link( $term_id );
            $status = 0;
			// $status = search_queries();
		    if( $status ) { // ['status']
				$tagID = get_query_var( 'tax_id' );
				$tag_link = get_tag_link( $tagID );
				if ( get_query_var( 'paged' ) ) {
					$position += 1;
					$url = $_SERVER['QUERY_STRING'];
					echo  $sep . sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $post_type->label, $position );
					$position += 1;
					echo $sep . sprintf( $link, $term_link, single_tag_title( '', false ), single_tag_title( '', false ), $position );
					$position += 1;
					echo $sep . sprintf( $link, $term_link.'?'.$url, $status['br_text'], $status['br_text'], $position );
					// echo $sep . $before . $status['teg_h1'] . $after;
					// echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
					$position += 1;
					$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					echo $sep . sprintf( $span, $text['page_status'] . get_query_var( 'paged' ), $text['page_status'] . get_query_var( 'paged' ), $position, $url );
				} else {
					$position += 1;
					$tagID = get_query_var( 'tax_id' );
					echo  $sep . sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $post_type->label, $position );
					$position += 1;
					echo $sep . sprintf( $link, $term_link, single_tag_title( '', false ), single_tag_title( '', false ), $position );
					$position += 1;
					// echo $sep . $before . $status['br_text'] . $after;
					$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					echo $sep . sprintf( $span, $status['br_text'], $status['br_text'], $position, $url );
				}
			} else {
				if ( get_query_var( 'paged' ) ) {
					$position += 1;
					$tagID = get_query_var( 'tax_id' );
					echo  $sep . sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $post_type->label, $position );
					$position += 1;
					echo $sep . sprintf( $link, $term_link, single_tag_title( '', false ), single_tag_title( '', false ), $position );
					echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
				} else {
					if ( $show_home_link && $show_current ) echo $sep;
					if ( $show_current ) {
						$position += 1;
						echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $post_type->label, $position ) . $sep;
						$position += 1;
						// echo $before . sprintf( single_tag_title( '', false ) ) . $after;
						echo sprintf( $span, sprintf( single_tag_title( '', false ) ), sprintf( single_tag_title( '', false ) ), $position, $term_link );
					}
					elseif ( $show_home_link && $show_last_sep ) echo $sep;
				}
			}
		}

		echo $wrap_after;

	}
}
