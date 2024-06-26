<?php global $current_user; ?>
<div class="dashboard-tab">
    <div class="dashboard-tab__title">
        <?php echo __( 'Settings', 'glamping-club' ); ?>
    </div>

    <div class="dashboard-tab__content form-settings">
        <form id="user-settings" class="glamping-club-form">
            <div class="form-group">
                <label for="user_name"><?php _e( 'Имя', 'glamping-club' );?></label>
                <input type="text" id="user_name" name="user_name" value="<?php echo $current_user->display_name; ?>" disabled>
                <button id="user-name-change-btn" class="button-link" type="button" name="user-name-change-btn" data-hystmodal="#nameChange">
                    <?php _e( 'Изменить имя', 'glamping-club' );?>
                </button>
            </div>

            <div class="form-group">
                <label for="user_email"><?php _e( 'E-mail', 'glamping-club' );?></label>
                <input type="text" id="user_email" name="user_email" value="<?php echo $current_user->user_email; ?>" disabled>
                <button id="user-email-change-btn" class="button-link" type="button" name="user-email-change-btn" data-hystmodal="#usermailChange">
                    <?php _e( 'Изменить E-mail', 'glamping-club' );?>
                </button>
            </div>

            <div class="form-group">
                <label for="user_pass_last"><?php _e( 'Пароль', 'glamping-club' );?></label>
                <input type="password" name="user_pass_last" id="user_pass_last" class="input-password" placeholder="********" disabled>
                <button id="user-pass-change-btn" class="button-link" type="button" name="user-pass-change-btn" data-hystmodal="#passChange">
                    <?php _e( 'Изменить пароль', 'glamping-club' );?>
                </button>
            </div>

            <!-- <span class="color-red">*</span> -->
        </form>
    </div>
</div>

<?php
get_template_part( 'template-parts/popups/dshb-settings/pass-change' );
get_template_part( 'template-parts/popups/dshb-settings/pass-change-end' );
get_template_part( 'template-parts/popups/dshb-settings/name-change' );
get_template_part( 'template-parts/popups/dshb-settings/usermail-change' );
?>
