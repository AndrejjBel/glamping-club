<?php
global $post;
?>
<nav class="mobile-nav">
    <div class="mobile-nav__wrap">
        <div class="mobile-nav__left">
            <a href="<?php echo get_post_meta($post->ID, 'additionally_field')[0][0]['site_glamping']?>"
				class="primary golden nxl ntext w-200 btnvib"
				target="_blank"
				rel="nofollow">Забронировать</a>
            <!-- <button class="primary golden nxl ntext" type="button" name="button">Забронировать</button> -->
            <div class="mobile-nav__left__icons">
                <?php get_messages_icons();?>
            </div>
        </div>

        <div class="mobile-nav__right">
            <button id="contacts-mobail-btn" type="button" name="button">
                <svg width="35.000000" height="35.000000" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path id="Vector" d="M20 17C20 15.9 19 14.8 18 14.8C17 14.8 16 15.9 16 17C16 18.1 17 19.19 18 19.19C19 19.19 20 18.1 20 17ZM20 25.8C20 24.7 19 23.6 18 23.6C17 23.6 16 24.7 16 25.8C16 26.9 17 28 18 28C19 28 20 26.9 20 25.8ZM20 8.2C20 7.1 19 6 18 6C17 6 16 7.1 16 8.2C16 9.3 17 10.39 18 10.39C19 10.39 20 9.3 20 8.2Z" fill="#5E6D77" fill-opacity="1.000000" fill-rule="evenodd"/>
                    <rect id="Frame 100" rx="0.000000" width="34.000000" height="34.000000" transform="translate(0.500000 35.500000) rotate(-90.000000)" stroke="#000000" stroke-opacity="0" stroke-width="1.000000"/>
                </svg>
            </button>
        </div>
    </div>
</nav>
