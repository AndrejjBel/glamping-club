<nav class="mobile-nav">
    <div class="container">
        <div class="mobile-nav__group">
            <a href="/" class="mobile-nav__group__widget">
                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"/>
                </svg>
                <span class="mobile-nav__group__widget__text">Главная</span>
            </a>
            <a href="#" class="mobile-nav__group__widget">
                <span class="mobile-nav__group__widget__icon">
                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
                    </svg>
                    <span class="mobile-nav__group__widget__count">0</span>
                </span>
                <span class="mobile-nav__group__widget__text">Закладки</span>
            </a>
            <?php if ($user_ID) { ?>
                <div class="mobile-nav__group__widget-add">
                    <a href="#" class="mobile-nav__group__widget plus-btn">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/>
                        </svg>
                        <span class="mobile-nav__group__widget-add__text">Добавить</span>
                    </a>
                </div>
            <?php } ?>
            <a href="#" class="mobile-nav__group__widget">
                <span class="mobile-nav__group__widget__icon">
                    <svg class="rotate90" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M448 64c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zm0 256c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zM0 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
                    </svg>
                    <span class="mobile-nav__group__widget__count">0</span>
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
