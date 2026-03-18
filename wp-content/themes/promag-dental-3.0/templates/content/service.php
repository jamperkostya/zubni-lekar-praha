<section class="content__block content single__doctor__slider grid flex-align-center">
	<?$posts = get_posts([
		'post_type' => 'team', 
		'numberposts' => 1,
		'meta_query' => [
			[
				'key' => 'crb_association_services', // Кастомное поле
				'value' => get_the_ID(),        // Значение (текущий ID страницы)
				'compare' => 'LIKE'                    // Сравнение
			]
		],
		'orderby' => 'rand'
	]);?>
	<?if(isset($posts)):?>
	<aside class="content__block__slider">
		<div class="glider-contain">
			<div class="glider glider-single-doctor">
				<?foreach($posts as $post):?>
				<?setup_postdata($post);?>
				<?$crb_languages = carbon_get_the_post_meta('crb_languages');?>
				<?$crb_major = carbon_get_the_post_meta('crb_major');?>
				<div href="#" class="blocks__item team__item">
					<?=get_the_post_thumbnail();?>
					<article class="team__item__description">
						<header><?the_title();?></header>
						<?if(!empty($crb_major)):?><p><?pll_e('Major');?>: <?=$crb_major;?></p><?endif;?>
						<?if(!empty($crb_languages)):?><p><?pll_e('Languages');?>: <?=$crb_languages;?></p><?endif;?>
					</article>
				</div>
				<?endforeach;?>
				<?wp_reset_postdata();?>
			</div>
		</div>
		<div role="tablist" class="dots-signle"></div>
	</aside>
	<?endif;?>
	<article class="content__block__text">
		<header class="h1"><?the_title();?></header>
		<div class="text"><?the_content();?></div>
	</article>
</section>
<section class="content__block content">
	<?$crb_price_content = carbon_get_the_post_meta('crb_price_content');?>
	<?=do_shortcode($crb_price_content);?>
	
	<button class="btn button-secondary block-center appointment-button"><?pll_e('Book Appointment');?></button>
</section>
<?php get_template_part('templates/section/services');?>