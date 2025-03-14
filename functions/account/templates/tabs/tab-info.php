<?php
$current_user = wp_get_current_user();
?>
<div class="dashboard-tab">
    <div class="dashboard-tab__title">
        <?php echo wp_sprintf( 'Добро пожаловать, %s.', $current_user->display_name ); ?>
    </div>

    <div class="dashboard-tab__content">
        <div class="dashboard-tab__content__add-glamp">
            <div class="dashboard-tab__content__add-glamp__application">
                <div class="dashboard-tab__content__title">Заявка на глэмпинг</div>
                <?php glamping_club_post_list_identification(); ?>
                <div class="dashboard-tab__content__message"></div>
            </div>

            <div class="dashboard-tab__content__add-glamp__btn-add">
                <a href="/glc-postedit/?post-type=glampings" class="add-btn">
                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/>
                    </svg>
                    <span>Добавить глэмпинг</span>
                </a>
                <a href="/glc-postedit/?post-type=stocks" class="add-btn mt-10">
                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/>
                    </svg>
                    <span>Добавить акцию</span>
                </a>
            </div>
        </div>
    </div>
</div>
