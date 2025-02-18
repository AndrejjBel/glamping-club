<div id="post-<?php echo $post->ID; ?>" class="glamping-item compare" title="<?php echo get_the_title( $post->ID ); ?>" data-info="<?php echo $post->ID; ?>">
    <a href="<?php echo esc_url( get_permalink() ); ?>" class="glamping-item__url" rel="bookmark"></a>
    <div class="glamping-item__sr">
        <?php if ($post->glamping_recommended == 'yes') { ?>
            <div class="glamping-item__sr__item recommended">Рекомендуем</div>
        <?php } ?>
        <?php if ($post->stocks) { ?>
            <div class="glamping-item__sr__item stocks"><?php echo stocks_title($post->stocks, 1);?></div>
        <?php } ?>
    </div>
    <div class="glamping-item__btns-fav-comp">
        <button id="add-favorites" data-postid="<?php the_ID(); ?>" class="round-sup-red" type="button" name="button" title="Добавить в избранное">
            <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
            </svg>
        </button>
        <button id="delete-comparison" class="round-sup-red compare" type="button" name="button" title="Удалить из избранного" data-postid="<?php echo $post->ID; ?>">
            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
            </svg>
        </button>
    </div>
    <div class="glamping-item__thumbnail compare">
        <?php glamping_club_gl_thumbnail_slider($post->ID); ?>
    </div>

    <div class="glamping-item__content compare">
        <div class="glamping-item__content__left">
            <div class="glamping-item__content__title compare">
                <?php echo get_the_title( $post->ID ); ?>
            </div>
        </div>

        <div class="glamping-item__content__right compare">
            <div class="glamping-item__content__right__price">
                <span class="price-number compare">От <?php echo number_format(round($post->glamping_price, 1), 0, ',', ' '); ?> ₽</span>
                <span class="price-text">за 1 ночь</span>
            </div>
        </div>
    </div>
</div>
