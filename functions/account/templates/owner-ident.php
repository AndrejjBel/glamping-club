<?php
if (glamping_club_owner_identif_action($_GET["key"], $_GET["owner"], $_GET["glamp"])) {
    echo 'Автор глэмпинга "' . get_the_title( $_GET["glamp"] ) . '" изменен. <a href="/dashboard/">Перейти в Личный кабинет</a>';
} else {
    echo 'Ошибка, свяжитесь с админом сайта';
}
