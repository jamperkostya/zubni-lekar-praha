<?$team = get_posts(['post_type' => 'team', 'numberposts' => 4]);?>
<?if(count($team)):?>
<section class="team__block content__block">
	<h2 class="m-l-71"><?pll_e('Our team');?></h2>
	<section class="blocks grid grid-auto-columns gap-60 team">
		<?foreach($team as $post):?>
		<?setup_postdata($post);?>
		<?$crb_languages = carbon_get_the_post_meta('crb_languages');?>
		<?$crb_major = carbon_get_the_post_meta('crb_major');?>
		<div class="blocks__item team__item">
			<?=get_the_post_thumbnail();?>
			<article class="team__item__description">
				<header><?the_title();?></header>
				<?if(isset($crb_major)):?><p><?pll_e('Profession');?>: <?=$crb_major;?></p><?endif;?>
				<?if(isset($crb_languages)):?><p><?pll_e('Languages');?>: <?=$crb_languages;?></p><?endif;?>
			</article>
		</div>
		<?endforeach;?>
		<?wp_reset_postdata();?>
	</section>
</section>
<?endif;?>