<?php
global $porto_settings, $porto_layout;

$search_size = $porto_settings['search-size'];
?>
<header id="header" class="header-corporate header-12 <?php echo $search_size ?>">
    <?php if ($porto_settings['show-header-top']) : ?>
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <?php
                    // show currency and view switcher
                    $currency_switcher = porto_currency_switcher();
                    $view_switcher = porto_view_switcher();

                    if ($currency_switcher || $view_switcher)
                        echo '<div class="switcher-wrap">';

                    echo $currency_switcher;

                    if ($currency_switcher && $view_switcher)
                        echo '<span class="gap switcher-gap">|</span>';

                    echo $view_switcher;

                    if ($currency_switcher || $view_switcher)
                        echo '</div>';
                    ?>
                    <?php
                    // show contact info and top navigation
                    $contact_info = $porto_settings['header-contact-info'];

                    if ($contact_info)
                        echo '<div class="block-inline"><div class="header-contact">' . do_shortcode($contact_info) . '</div></div>';
                    ?>
                </div>
                <div class="header-right">
                    <?php
                    // show welcome message and top navigation
                    $top_nav = porto_top_navigation();

                    if ($porto_settings['welcome-msg'])
                        echo '<span class="welcome-msg">' . do_shortcode($porto_settings['welcome-msg']) . '</span>';

                    if ($porto_settings['welcome-msg'] && $top_nav)
                        echo '<span class="gap">|</span>';

                    echo $top_nav;
                    ?>
                    <?php
                    $minicart = porto_minicart();
                    $searchform = porto_search_form();
                    $header_social = porto_header_socials();

                    if ($minicart || $searchform || $header_social)
                        echo '<div class="block-inline">';

                    // show search form
                    echo $searchform;

                    // show social links
                    echo $header_social;

                    // show minicart
                    echo $minicart;

                    if ($minicart || $searchform || $header_social)
                        echo '</div>';
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="header-main">
        <div class="container">
            <div class="header-left">
                <?php
                // show logo
                $logo = porto_logo();
                echo $logo;
                ?>
            </div>

            <div class="header-right">
                <?php
                if ($porto_settings['show-header-top']) {
                    // show search form
                    echo porto_search_form();
                }
                // show mobile toggle
                ?>
                <a class="mobile-toggle"><i class="fa fa-reorder"></i></a>
                <div id="main-menu">
                    <?php
                    // show main menu
                    echo porto_main_menu();
                    ?>
                </div>
                <?php
                if ($porto_settings['show-header-top']) {
                    // show minicart
                    $minicart = porto_minicart();

                    echo $minicart;
                } else {
                    // show social links
                    $header_social = porto_header_socials();

                    echo $header_social;
                }
                ?>

                <?php
                get_template_part('header/header_tooltip');
                ?>

            </div>
        </div>
    </div>
</header>