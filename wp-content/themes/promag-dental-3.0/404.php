<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>
<section class="container content content-404">
    <div class="row">
        <h1><?pll_e('404: No such page');?></h1>
        <p><?pll_e('Try to go to the menu item you need and find the information there.');?></p>
        <a href="<?=pll_home_url();?>" class="btn btn-pink"><?pll_e('Mainpage');?></a>
    </div>
</section>

<?php
get_footer();
