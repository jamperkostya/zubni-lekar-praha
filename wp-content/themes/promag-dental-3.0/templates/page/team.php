<?php
/**
 * The template part for displaying post page
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?get_template_part('templates/section/team');?>
<section class="content__block clinics__block content">
	<div class="row">
		<article class="col-md-8">
			<div><?the_content();?></div>
		</article>
		<aside class="col-md-4">
			<?the_post_thumbnail();?>
		</aside>
	</div>
</section>
<?get_template_part('templates/section/services');?>
<?get_template_part('templates/section/faq');?>