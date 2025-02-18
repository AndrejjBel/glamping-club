<?php
$glemps = explode(',', $_COOKIE["glcCompar"]);
if ($glemps) {
    $post_left = get_post($glemps[0]);
    $stat_left = glampings_reviews_statistic($glemps[0]);
    $cr_left = $stat_left['count'];
    $ar_left = $stat_left['average_rating'];
    if (count($glemps) > 1) {
        $post_right = get_post($glemps[1]);
        $stat_right = glampings_reviews_statistic($glemps[1]);
        $cr_right = $stat_right['count'];
        $ar_right = $stat_right['average_rating'];
    }
}
?>
<div class="compare-wrap-mobile__top">
    <?php if (count($glemps) > 2) { ?>
        <div class="compare-wrap-mobile__nav">
            <div class="compare-wrap-mobile__nav__item nav-item-left">
                <button id="step-prev-left" class="step-prev" type="button" name="button" data-step-all="<?php echo count($glemps);?>">
                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 1L1.5 6L6.5 11" stroke="#8F8F8F" stroke-width="1.5"/>
                    </svg>
                </button>
                <div class="compare-wrap-mobile__nav__item__step">
                    <div class="compare-wrap-mobile__nav__item__step__item step-current-left">1</div>
                    <div class="compare-wrap-mobile__nav__item__step__item">/</div>
                    <div class="compare-wrap-mobile__nav__item__step__item step-all"><?php echo count($glemps); ?></div>
                </div>
                <button id="step-next-left" class="step-next" type="button" name="button" data-step-all="<?php echo count($glemps);?>">
                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 1L1.5 6L6.5 11" stroke="#8F8F8F" stroke-width="1.5"/>
                    </svg>
                </button>
            </div>

            <div class="compare-wrap-mobile__nav__item nav-item-right">
                <button id="step-prev-right" class="step-prev" type="button" name="button" data-step-all="<?php echo count($glemps);?>">
                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 1L1.5 6L6.5 11" stroke="#8F8F8F" stroke-width="1.5"/>
                    </svg>
                </button>
                <div class="compare-wrap-mobile__nav__item__step">
                    <div class="compare-wrap-mobile__nav__item__step__item step-current-right">2</div>
                    <div class="compare-wrap-mobile__nav__item__step__item">/</div>
                    <div class="compare-wrap-mobile__nav__item__step__item step-all"><?php echo count($glemps); ?></div>
                </div>
                <button id="step-next-right" class="step-next" type="button" name="button" data-step-all="<?php echo count($glemps);?>">
                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 1L1.5 6L6.5 11" stroke="#8F8F8F" stroke-width="1.5"/>
                    </svg>
                </button>
            </div>
        </div>
    <?php } ?>

    <div class="compare-wrap-mobile__glemps">
        <div class="compare-wrap-mobile__glemps__item glemps-item-left" data-info="<?php echo $glemps[0]; ?>">
            <?php compare_render($glemps[0]);?>
        </div>
        <div class="compare-wrap-mobile__glemps__item glemps-item-right" data-info="<?php echo (count($glemps) > 1)? $glemps[1] : ''; ?>">
            <?php
            if (count($glemps) > 1) {
                compare_render($glemps[1]);
            }
            ?>
        </div>
    </div>
</div>

<div class="compare-wrap-mobile__bottom bottom-items">
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Рейтинг</div>
                <div class="bottom-item__info rating-left"><?php reviews_stars_items_average( $ar_left, $cr_left ); ?></div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Рейтинг</div>
                <div class="bottom-item__info rating-right"><?php if (count($glemps) > 1) {reviews_stars_items_average( $ar_right, $cr_right );} ?></div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Рекомендуем</div>
                <div class="bottom-item__info recommended-left">
                    <?php echo ($post_left->glamping_recommended == 'yes')? '+' : '&mdash;'; ?>
                </div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Рекомендуем</div>
                <div class="bottom-item__info recommended-right">
                    <?php if (count($glemps) > 1) {echo ($post_right->glamping_recommended == 'yes')? '+' : '&mdash;';} ?>
                    </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Акции</div>
                <div class="bottom-item__info stocks-left">
                    <?php echo (stocks_title($post_left->stocks, 1))? stocks_title($post_left->stocks, 1) : '&mdash;';?>
                </div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Акции</div>
                <div class="bottom-item__info stocks-right">
                    <?php if (count($glemps) > 1) {echo (stocks_title($post_right->stocks, 1))? stocks_title($post_right->stocks, 1) : '&mdash;';} ?>
                    </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Локация</div>
                <div class="bottom-item__info address-left">
                    <?php echo get_additionally_meta('address', $glemps[0]); ?>
                </div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Локация</div>
                <div class="bottom-item__info address-right">
                    <?php if (count($glemps) > 1) {echo get_additionally_meta('address', $glemps[1]);} ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Тип места</div>
                <div class="bottom-item__info type-left">
                    <?php echo ($post_left->glamping_type)? implode(', ', $post_left->glamping_type) : '&mdash;'; ?>
                </div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Тип места</div>
                <div class="bottom-item__info type-right">
                    <?php if (count($glemps) > 1) {
                        echo ($post_right->glamping_type)? implode(', ', $post_right->glamping_type) : '&mdash;';
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Тип размещения</div>
                <div class="bottom-item__info allocation-left">
                    <?php echo ($post_left->glamping_allocation)? implode(', ', $post_left->glamping_allocation) : '&mdash;'; ?>
                </div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Тип размещения</div>
                <div class="bottom-item__info allocation-right">
                    <?php if (count($glemps) > 1) {
                        echo ($post_right->glamping_allocation)? implode(', ', $post_right->glamping_allocation) : '&mdash;';
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Окружение</div>
                <div class="bottom-item__info nature-left">
                    <?php echo ($post_left->glamping_nature_around)? implode(', ', $post_left->glamping_nature_around) : '&mdash;'; ?>
                </div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Окружение</div>
                <div class="bottom-item__info nature-right">
                    <?php if (count($glemps) > 1) {
                        echo ($post_right->glamping_nature_around)? implode(', ', $post_right->glamping_nature_around) : '&mdash;';
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Wi-Fi</div>
                <div class="bottom-item__info wifi-left">
                    <?php
                    if ($post_left->glamping_facilities_general) {
                        echo (in_array('Wi-Fi', $post_left->glamping_facilities_general))? '+': '&mdash;';
                    } else {
                        echo '&mdash;';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Wi-Fi</div>
                <div class="bottom-item__info wifi-right">
                    <?php
                    if (count($glemps) > 1) {
                        if ($post_right->glamping_facilities_general) {
                            echo (in_array('Wi-Fi', $post_right->glamping_facilities_general))? '+': '&mdash;';
                        } else {
                            echo '&mdash;';
                        }
                    }
                    ?>
                    </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Парковка</div>
                <div class="bottom-item__info parking-left">
                <?php
                if ($post_left->glamping_facilities_general) {
                    if (in_array('Парковка - бесплатно', $post_left->glamping_facilities_general)) {
            			echo '<span class="compare-item__section__info__text-green">Бесплатно</span>';
            		} elseif (in_array('Парковка - платно', $post_left->glamping_facilities_general)) {
            			echo '<span class="compare-item__section__info__text-red">Платно</span>';
            		} else {
            			echo '&mdash;';
            		}
                } else {
                    echo '&mdash;';
                }
                ?>
                </div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Парковка</div>
                <div class="bottom-item__info parking-right">
                    <?php
                    if ($post_right->glamping_facilities_general) {
                        if (count($glemps) > 1) {
                            if (in_array('Парковка - бесплатно', $post_right->glamping_facilities_general)) {
                    			echo '<span class="compare-item__section__info__text-green">Бесплатно</span>';
                    		} elseif (in_array('Парковка - платно', $post_right->glamping_facilities_general)) {
                    			echo '<span class="compare-item__section__info__text-red">Платно</span>';
                    		} else {
                    			echo '&mdash;';
                    		}
                        }
                    } else {
                        echo '&mdash;';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Можно с животными</div>
                <div class="bottom-item__info animals-left">
                <?php
                if ($post_left->glamping_facilities_general) {
                    if (in_array('Можно с животными - бесплатно', $post_left->glamping_facilities_general)) {
            			echo '<span class="compare-item__section__info__text-green">Бесплатно</span>';
            		} elseif (in_array('Можно с животными - платно', $post_left->glamping_facilities_general)) {
            			echo '<span class="compare-item__section__info__text-red">Платно</span>';
            		} else {
            			echo '&mdash;';
            		}
                } else {
                    echo '&mdash;';
                }
                ?>
                </div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Можно с животными</div>
                <div class="bottom-item__info animals-right">
                    <?php
                    if (count($glemps) > 1) {
                        if ($post_right->glamping_facilities_general) {
                            if (in_array('Можно с животными - бесплатно', $post_right->glamping_facilities_general)) {
                    			echo '<span class="compare-item__section__info__text-green">Бесплатно</span>';
                    		} elseif (in_array('Можно с животными - платно', $post_right->glamping_facilities_general)) {
                    			echo '<span class="compare-item__section__info__text-red">Платно</span>';
                    		} else {
                    			echo '&mdash;';
                    		}
                        } else {
                            echo '&mdash;';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Кухня</div>
                <div class="bottom-item__info kitchen-left">
                    <?php echo ($post_left->facilities_general_kitchen)? implode(", ", $post_left->facilities_general_kitchen) : '&mdash;'; ?>
                </div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Кухня</div>
                <div class="bottom-item__info kitchen-right">
                    <?php if (count($glemps) > 1) {echo ($post_right->facilities_general_kitchen)? implode(", ", $post_right->facilities_general_kitchen) : '&mdash;';} ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Ванная комната</div>
                <div class="bottom-item__info bathroom-left"><?php echo ($post_left->facilities_general_bathroom)? implode(", ", $post_left->facilities_general_bathroom) : '&mdash;'; ?></div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Ванная комната</div>
                <div class="bottom-item__info bathroom-right">
                    <?php if (count($glemps) > 1) {echo ($post_right->facilities_general_bathroom)? implode(", ", $post_right->facilities_general_bathroom) : '&mdash;';} ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Питание</div>
                <div class="bottom-item__info nutrition-left"><?php echo ($post_left->glamping_nutrition)? implode(", ", $post_left->glamping_nutrition) : '&mdash;'; ?></div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Питание</div>
                <div class="bottom-item__info nutrition-right">
                    <?php if (count($glemps) > 1) {echo ($post_right->glamping_nutrition)? implode(", ", $post_right->glamping_nutrition) : '&mdash;';} ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Для детей</div>
                <div class="bottom-item__info children-left"><?php echo ($post_left->facilities_options_children)? implode(", ", $post_left->facilities_options_children) : '&mdash;'; ?></div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Для детей</div>
                <div class="bottom-item__info children-right">
                    <?php if (count($glemps) > 1) {echo ($post_right->facilities_options_children)? implode(", ", $post_right->facilities_options_children) : '&mdash;';} ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Территория</div>
                <div class="bottom-item__info territory-left"><?php echo ($post_left->glamping_territory)? implode(", ", $post_left->glamping_territory) : '&mdash;'; ?></div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Территория</div>
                <div class="bottom-item__info territory-right">
                    <?php if (count($glemps) > 1) {echo ($post_right->glamping_territory)? implode(", ", $post_right->glamping_territory) : '&mdash;';} ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Безопасность</div>
                <div class="bottom-item__info safety-left"><?php echo ($post_left->facilities_options_safety)? implode(", ", $post_left->facilities_options_safety) : '&mdash;'; ?></div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Безопасность</div>
                <div class="bottom-item__info safety-right">
                    <?php if (count($glemps) > 1) {echo ($post_right->facilities_options_safety)? implode(", ", $post_right->facilities_options_safety) : '&mdash;';} ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-items__item">
        <div class="bottom-items__item__left">
            <div class="bottom-item">
                <div class="bottom-item__title">Развлечения</div>
                <div class="bottom-item__info entertainment-left"><?php echo ($post_left->glamping_entertainment)? implode(", ", $post_left->glamping_entertainment) : '&mdash;'; ?></div>
            </div>
        </div>
        <div class="bottom-items__item__right">
            <div class="bottom-item">
                <div class="bottom-item__title">Развлечения</div>
                <div class="bottom-item__info entertainment-right">
                    <?php if (count($glemps) > 1) {echo ($post_right->glamping_entertainment)? implode(", ", $post_right->glamping_entertainment) : '&mdash;';} ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

// $post = get_post( 7 );
// $posts = explode(',', $_COOKIE["glcCompar"]);
//
//
// var_dump($posts);
