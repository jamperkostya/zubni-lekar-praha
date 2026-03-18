<section class="content__block clinics__block content content__block__price" style="margin-top:150px;">
	<div class="row">
		<article class="col-md-12">
			<h1><?the_title();?></h1>
			<div><?the_content();?></div>
		</article>
	</div>
</section>
<section class="content__block content">
	<?$crb_price_content = carbon_get_the_post_meta('crb_price_content');?>
	<?=do_shortcode($crb_price_content);?>
	
	<button class="btn button-secondary block-center appointment-button"><?pll_e('Book Appointment');?></button>
</section>
<?php get_template_part('templates/section/services');?>
<?get_template_part('templates/section/faq');?>