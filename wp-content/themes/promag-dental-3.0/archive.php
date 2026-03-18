<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

$description = get_the_archive_description();
?>
<div class="container">
	<div class="row">
		<div class="col-md-12 content">
			<?php if ( have_posts() ) : ?>
				<header class="page-header alignwide">
					<?php if ( $description ) : ?>
						<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
					<?php endif; ?>
				</header><!-- .page-header -->
			
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<?php get_template_part( 'templates/content-part/content', 'signle' ); ?>
				<?php endwhile; ?>
			
			<?php else : ?>
				<?php get_template_part( 'template-parts/content/content-none' ); ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
