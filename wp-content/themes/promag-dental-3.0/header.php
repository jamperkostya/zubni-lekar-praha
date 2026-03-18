<?php
/**
* The header.
*
* This is the template that displays all of the <head> section and everything up until main.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordPress
* @subpackage Twenty_Twenty_One
* @since Twenty Twenty-One 1.0
*/

?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php if( is_single() && 'post' === get_post_type() ):?>
        <link rel="preload" as="image" href="<?=get_the_post_thumbnail_url();?>" fetchpriority="high">
        <?php endif;?>
        <?php wp_head(); ?>

        <link rel="apple-touch-icon" sizes="57x57" href="<?=get_template_directory_uri();?>/assets/images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?=get_template_directory_uri();?>/assets/images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?=get_template_directory_uri();?>/assets/images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?=get_template_directory_uri();?>/assets/images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?=get_template_directory_uri();?>/assets/images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?=get_template_directory_uri();?>/assets/images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?=get_template_directory_uri();?>/assets/images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?=get_template_directory_uri();?>/assets/images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?=get_template_directory_uri();?>/assets/images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?=get_template_directory_uri();?>/assets/images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?=get_template_directory_uri();?>/assets/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?=get_template_directory_uri();?>/assets/images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?=get_template_directory_uri();?>/assets/images/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?=get_template_directory_uri();?>/assets/images/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?=get_template_directory_uri();?>/assets/images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#fff">
    </head>
    
    <?
    $GLOBALS['contacts'][] = [
        'crb_email' => carbon_get_theme_option('crb_email_1'),
        'crb_address' => carbon_get_theme_option('crb_address_1'),
        'crb_phone' => carbon_get_theme_option('crb_phone_1'),
        'crb_work_time' => carbon_get_theme_option('crb_work_time_1_'.carbon_lang()),
        'crb_symbols' => carbon_get_theme_option('crb_symbols_1'), 
        'crb_full_address' => carbon_get_theme_option('crb_full_address_1_'.carbon_lang()),
    ];
    $GLOBALS['contacts'][] = [
        'crb_email' => carbon_get_theme_option('crb_email_2'),
        'crb_address' => carbon_get_theme_option('crb_address_2'),
        'crb_phone' => carbon_get_theme_option('crb_phone_2'),
        'crb_work_time' => carbon_get_theme_option('crb_work_time_2_'.carbon_lang()),
        'crb_symbols' => carbon_get_theme_option('crb_symbols_2'), 
        'crb_full_address' => carbon_get_theme_option('crb_full_address_2_'.carbon_lang()),
    ];
    ?>
    <body <?php body_class(); ?>>
        <main rel="main" class="main__wrapper container">
            <header class="header row flex flex-space-between">
                <aside class="header__left flex flex-align-center gap-45">
                    <?php echo custom_logo();?>
                    <?php wp_nav_menu([
                        'theme_location' => 'header_menu',
                        'container' => false,
                        'menu_class' => 'menu'
                    ]);?>
                </aside>
                <aside class="header__right flex gap-23 flex-justify-end">
                    <button class="header__appointment-button appointment-button"><?pll_e('Book Appointment');?></button>
                    <button class="header__language-active"><?=pll_current_language('slug');?></button>
                    <ul class="header__language-switcher">
                        <?pll_the_languages(['display_names_as' => 'slug', 'hide_if_empty' => 0]);?>
                    </ul>
                    
                    <div class="mobile-menu-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </aside>
                <button class="header__appointment-button appointment-button-mobile"><?pll_e('Book Appointment');?></button>
            </header>
            <nav class="mobile-menu__container">
                <?php wp_nav_menu([
                    'theme_location' => 'header',
                    'container' => false,
                    'menu_class' => 'menu'
                ]);?>
                
                <div class="mobile-menu__address">
                    <div class="address">
                        <span>Hostinského 1536/7, Praha 15, Stodulky</span>
                        <a href="#">+420 727 933 002</a>
                    </div>
                    <div class="address">
                        <span>Na Hurke 2211/3, Praha 15, Hurka</span>
                        <a href="#">+420 601 070 075</a>
                    </div>
                </div>
                
                <ul class="mobile-menu__language-switcher">
                    <?pll_the_languages(['display_names_as' => 'slug', 'hide_if_empty' => 0]);?>
                </ul>
            </nav>
        