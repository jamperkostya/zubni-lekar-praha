<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();?>
<?php /* Start the Loop */
while ( have_posts() ) :
the_post();?>

<?php get_template_part( 'templates/content/'. get_post_type() );

// if ( is_attachment() ) {
// 	// Parent post navigation.
// 	the_post_navigation(
// 		array(
// 			/* translators: %s: Parent post link. */
// 			'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentytwentyone' ), '%title' ),
// 		)
// 	);
// }

// If comments are open or there is at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) {
// 		comments_template();
}?>
<?php endwhile; // End of the loop.?>

<?php get_footer();?>
