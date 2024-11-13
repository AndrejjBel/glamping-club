<?php
$container = 'container';
if (is_post_type_archive('glampings')) {
    $container = 'container-ag';
}
?>
<nav class="mobile-nav">
    <div class="<?php echo $container; ?>">
        <div class="mobile-nav__group">
            <a href="/" class="mobile-nav__group__widget">
                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"/>
                </svg>
                <span class="mobile-nav__group__widget__text">Главная</span>
            </a>
            <!-- <button class="mobile-nav__group__widget button-filtr-icon">
                <span class="mobile-nav__group__widget__icon">
                    <svg width="16" height="16" class="mobile-nav-filtr-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" class="rotate-90">
                        <path fill-rule="evenodd" d="M3.25 2.75V6h-.086C1.969 6 1 6.97 1 8.167v1.666C1 11.03 1.969 12 3.164 12h.086v1.25a.75.75 0 1 0 1.5 0V12h.086C6.031 12 7 11.03 7 9.833V8.167A2.165 2.165 0 0 0 4.836 6H4.75V2.75a.75.75 0 0 0-1.5 0m2.252 7.083a.666.666 0 0 1-.666.667H3.164a.666.666 0 0 1-.666-.667V8.167c0-.369.298-.667.666-.667h1.672c.368 0 .666.298.666.667zm5.748 3.417V10h-.082A2.165 2.165 0 0 1 9 7.838V6.162C9 4.968 9.97 4 11.168 4h.082V2.75a.75.75 0 0 1 1.5 0V4h.082C14.029 4 15 4.968 15 6.162v1.676C15 9.032 14.03 10 12.832 10h-.082v3.25a.75.75 0 0 1-1.5 0m2.249-5.412a.666.666 0 0 1-.667.665h-1.664a.666.666 0 0 1-.667-.665V6.162c0-.367.299-.665.667-.665h1.664c.368 0 .667.298.667.665z"></path>
                    </svg>
                    <span id="sup-filtr" class="mobile-nav__group__widget__count">0</span>
                </span>
                <span class="mobile-nav__group__widget__text">Фильтр</span>
            </button> -->
            <a href="/favorites/" class="mobile-nav__group__widget">
                <span class="mobile-nav__group__widget__icon">
                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
                    </svg>
                    <span id="sup-favorites" class="mobile-nav__group__widget__count">0</span>
                </span>
                <span class="mobile-nav__group__widget__text">Закладки</span>
            </a>
            <a href="/compare/" class="mobile-nav__group__widget">
                <span class="mobile-nav__group__widget__icon">
                    <svg class="rotate90" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M448 64c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zm0 256c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zM0 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
                    </svg>
                    <span id="sup-comparison" class="mobile-nav__group__widget__count">0</span>
                </span>
                <span class="mobile-nav__group__widget__text">Сравнение</span>
            </a>
            <?php if ($user_ID) { ?>
                <a href="#" class="mobile-nav__group__widget">
                    <span class="mobile-nav__group__widget__icon">
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M256 32V51.2C329 66.03 384 130.6 384 208V226.8C384 273.9 401.3 319.2 432.5 354.4L439.9 362.7C448.3 372.2 450.4 385.6 445.2 397.1C440 408.6 428.6 416 416 416H32C19.4 416 7.971 408.6 2.809 397.1C-2.353 385.6-.2883 372.2 8.084 362.7L15.5 354.4C46.74 319.2 64 273.9 64 226.8V208C64 130.6 118.1 66.03 192 51.2V32C192 14.33 206.3 0 224 0C241.7 0 256 14.33 256 32H256zM224 512C207 512 190.7 505.3 178.7 493.3C166.7 481.3 160 464.1 160 448H288C288 464.1 281.3 481.3 269.3 493.3C257.3 505.3 240.1 512 224 512z"/>
                        </svg>
                        <span class="mobile-nav__group__widget__count">0</span>
                    </span>
                    <span class="mobile-nav__group__widget__text">Уведомления</span>
                </a>
            <?php } ?>
        </div>
    </div>
</nav>
