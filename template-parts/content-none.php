<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Glamping_club
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Ничего не найдено', 'glamping-club' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'glamping-club' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Извините, но ничего не соответствует вашим поисковым запросам. Попробуйте еще раз с другими ключевыми словами.', 'glamping-club' ); ?></p>

			<form role="search" method="get" class="header-generale__form search-page" action="<?php echo home_url( '/' ); ?>">
                <div class="header-generale__form__search">
                    <button type="submit" name="button" class="header-generale__form__search__search-btn">
                        <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M504.1 471l-134-134C399.1 301.5 415.1 256.8 415.1 208c0-114.9-93.13-208-208-208S-.0002 93.13-.0002 208S93.12 416 207.1 416c48.79 0 93.55-16.91 129-45.04l134 134C475.7 509.7 481.9 512 488 512s12.28-2.344 16.97-7.031C514.3 495.6 514.3 480.4 504.1 471zM48 208c0-88.22 71.78-160 160-160s160 71.78 160 160s-71.78 160-160 160S48 296.2 48 208z"/>
                        </svg>
                    </button>
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Поиск …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Поиск', 'label' ) ?>" />
                    <input type="hidden" value="glampings" name="post_type" />
                </div>
                <div class="header-generale__form__options"></div>
            </form>

			<?php
			// get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'Кажется, мы не можем найти то, что вы ищете. Возможно, поиск поможет.', 'glamping-club' ); ?></p>

			<form role="search" method="get" class="header-generale__form" action="<?php echo home_url( '/' ); ?>">
                <div class="header-generale__form__search">
                    <button type="submit" name="button" class="header-generale__form__search__search-btn">
                        <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M504.1 471l-134-134C399.1 301.5 415.1 256.8 415.1 208c0-114.9-93.13-208-208-208S-.0002 93.13-.0002 208S93.12 416 207.1 416c48.79 0 93.55-16.91 129-45.04l134 134C475.7 509.7 481.9 512 488 512s12.28-2.344 16.97-7.031C514.3 495.6 514.3 480.4 504.1 471zM48 208c0-88.22 71.78-160 160-160s160 71.78 160 160s-71.78 160-160 160S48 296.2 48 208z"/>
                        </svg>
                    </button>
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Поиск …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Поиск', 'label' ) ?>" />
                    <input type="hidden" value="glampings" name="post_type" />
                </div>
                <div class="header-generale__form__options"></div>
            </form>

			<?php
			// get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
