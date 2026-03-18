<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
        <section class="bottom__form__block flex full-width-mobile-991">
            <aside class="bottom__form__block__left text-center">
                <img src="<?=get_template_directory_uri();?>/assets/images/form-title-image.jpg" alt="device" width="162">
                <div>
                    <h4><?pll_e('We accept new');?></h4>
                    <h3><?pll_e('Patients!');?></h3>
                </div>
                <p><?pll_e('Your personal data will be used solely for the purpose of handling your inquiry.');?></p>
            </aside>
            <article class="bottom__form__block__right">
                <h3><?pll_e('Order today!');?></h3>
                <?php echo do_shortcode('[contact-form-7 id="08b278f" title="Napište nám (Footer)"]');?>
            </article>
        </section>
        <?$crb_seo_text = carbon_get_the_post_meta('crb_seo_text')?>
        <?$crb_seo_text_title = carbon_get_the_post_meta('crb_seo_text_title')?>
        <?if($crb_seo_text):?>
        <article class="content__block seo__block content">
            <h2><?=$crb_seo_text_title;?></h2>
            <div class="content__block__text seo-block">
                <?=$crb_seo_text;?>
            </div>
            <button class="show-more" aria-expanded="false" aria-controls="additionalInfo" data-open="<?pll_e('Show less');?>" data-close="<?pll_e('Show more');?>" data-close-line-clamp="4"><?pll_e('Show more');?></button>
        </article>
        <?endif;?>
        <footer class="footer row full-width-mobile-991">
            <section class="footer__top flex grid-mobile-991 flex-space-between flex-align-center gap-50 m-b-50">
                <?php echo custom_logo();?>
                <?$insurances = get_posts(['post_type' => 'insurance']);?>
                <?if(count($insurances)):?>
                    <?foreach ( $insurances as $post ):?>
                    <?setup_postdata( $post );?>
                    <?=get_the_post_thumbnail();?>
                    <?endforeach;?>
                    <?wp_reset_postdata();?>
                <?endif;?>
            </section>
            <section class="footer__bottom flex flex-space-between gap-41">
                <aside class="menu__container">
                    <div class="menu__container__title m-b-11"><?pll_e('Promag-Dental');?></div>
                    <?php wp_nav_menu([
                        'theme_location' => 'footer_menu',
                        'container' => false,
                        'menu_class' => 'menu'
                    ]);?>
                </aside>
                <?if(is_array($GLOBALS['contacts'])):?>
                <?foreach($GLOBALS['contacts'] as $contacts_item):?>
                <aside class="footer__contact flex">
                    <div class="footer__contact__title"><?=$contacts_item['crb_symbols'];?></div>
                    <div class="footer__contact__text">
                        <?=wpautop($contacts_item['crb_work_time']);?>
                        <a href="tel:<?=preg_replace('/[^0-9]/', '', $contacts_item['crb_phone']);?>"><?=$contacts_item['crb_phone'];?></a>
                        <a href="mailto:<?=$contacts_item['crb_email'];?>"><?=$contacts_item['crb_email'];?></a>
                    </div>
                </aside>
                <?endforeach;?>
                <?endif;?>
            </section>
        </footer>
    </main>
    <!-- Модальное окно with form 'order form'-->
    <div class="modal" id="appointmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <section class="bottom__form__block flex">
                <aside class="bottom__form__block__left text-center">
                    <img src="<?=get_template_directory_uri();?>/assets/images/form-title-image.jpg" alt="device" width="162">
                    <h4><?pll_e('We accept new');?></h4>
                    <h3><?pll_e('Patients!');?></h3>
                    <p><?pll_e('Your personal data will be used solely for the purpose of handling your inquiry.');?></p>
                </aside>
                <article class="bottom__form__block__right">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h3><?pll_e('Order today!');?></h3>
                    <?php echo do_shortcode('[contact-form-7 id="fd0ca6b" title="Napište nám (Popup)"]');?>
                </article>
            </section>
        </div>
    </div>
    <!-- Модальное окно with form 'thank you'-->
    <div class="modal" id="thankyouModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <section class="bottom__form__block">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                <div class="flex bottom__form__block__text">
                    <h3><?pll_e('Thank you!');?></h3>
                    <p><?pll_e('We will contact you soon and arrange a time for your visit.');?></p>
                </div>
            </section>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
