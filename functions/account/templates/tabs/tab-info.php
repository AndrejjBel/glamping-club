<?php
$current_user = wp_get_current_user();
?>
<div class="dashboard-tab">
    <div class="dashboard-tab__title">
        <?php echo wp_sprintf( 'Добро пожаловать, %s.', $current_user->display_name ); ?>
    </div>
</div>
