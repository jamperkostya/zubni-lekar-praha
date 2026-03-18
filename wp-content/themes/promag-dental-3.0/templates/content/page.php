<?php
/**
 * The template part for displaying post page
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<section class="content__block clinics__block content" style="margin-top:150px;">
	<div class="row">
		<article <?php if(has_post_thumbnail()):?>class="col-md-8"<?php endif;?>>
			<h1><?the_title();?></h1>
			<div><?the_content();?></div>
		</article>
		<?php if(has_post_thumbnail()):?>
		<aside class="col-md-4">
			<?the_post_thumbnail();?>
		</aside>
		<?php endif;?>
	</div>
</section>
<?get_template_part('templates/section/services');?>
<?get_template_part('templates/section/team');?>
<?get_template_part('templates/section/faq');?>