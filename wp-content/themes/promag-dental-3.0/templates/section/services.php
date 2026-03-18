<?$services = get_posts(['post_type' => 'service', 'numberposts' => -1]);?>
<?if(count($posts)):?>
<section class="services__block content__block">
	<h2 class="text-center"><?pll_e('Our services');?></h2>
	<section class="blocks grid grid-auto-columns gap-40">
		<?foreach($services as $post):?>
		<?setup_postdata($post);?>
		<a href="<?the_permalink();?>" class="blocks__item">
			<figure>
				<img src="<?=get_the_post_thumbnail_url();?>" alt="<?the_title();?>">
				<figcaption><?the_title();?></figcaption>
			</figure>
		</a>
		<?endforeach;?>
		<?wp_reset_postdata();?>
	</section>
</section>
<?endif;?>