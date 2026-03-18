<?$testimonals = get_posts(['post_type' => 'testimonal', 'numberposts' => 6]);?>
<?if(count($testimonals)):?>
<section class="testimonials__block">
	<div class="content__block testimonials__block__header">
		<div role="tablist" class="dots"></div>
		<h2 class="text-right"><?pll_e('Testimonials');?></h2>
	</div>
	<div class="glider-contain">
		<div class="glider glider-testimonals">
			<?foreach($testimonals as $post):?>
			<?setup_postdata($post);?>
			<?$crb_source = carbon_get_the_post_meta('crb_source');?>
			<div>
				<article class="testimonial <?=$crb_source;?>">
					<div class="testimonial__text">
						<?the_content();?>
					</div>
					<aside class="testimonial__author flex">
						<?if(has_post_thumbnail()):?>
						<?the_post_thumbnail();?>
						<?else:?>
						<div class="testimonial__author__shortname"><?=get_first_letters(get_the_title());?>
						</div>
						<?endif;?>
						<header><?the_title();?></header>
					</aside>
				</article>
			</div>
			<?endforeach;?>
			<?wp_reset_postdata();?>
		</div>
	</div>
</section>
<?endif;?>