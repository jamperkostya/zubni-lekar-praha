<?$advantages = get_posts(['post_type' => 'advantage', 'numberposts' => 6]);?>
<?if(count($advantages)):?>
<section class="advantages__block content__block">
	<h2 class="text-center"><?pll_e('Why Promag-Dental?');?></h2>
	
	<section class="blocks grid grid-auto-columns gap-40">
		<?$counter = 1;?>
		<?foreach($advantages as $post):?>
		<?setup_postdata($post);?>
		<article class="blocks__item">
			<svg class="icon" viewBox="0 0 92 92" width="92">
			  <use href="<?=get_theme_file_uri('assets/images/icons.svg#icon-why-'.$counter++);?>" x="0" y="0"></use>
			</svg>
			<header class="title"><?the_title();?></header>
			<div><?the_content();?></div>
		</article>
		<?endforeach;?>
		<?wp_reset_postdata();?>
	</section>
</section>
<?endif;?>