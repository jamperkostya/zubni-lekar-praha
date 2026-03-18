<?$crb_hero_image = empty(carbon_get_the_post_meta('crb_hero_image')) ? get_template_directory_uri().'/assets/images/hero-default.jpg' : wp_get_attachment_image_src(carbon_get_the_post_meta('crb_hero_image'), 'full')[0];?>
<?$hero_title = !empty(carbon_get_the_post_meta('crb_hero_title')) ? carbon_get_the_post_meta('crb_hero_title') : get_the_title();?><section class="main__hero__block content content__block flex flex-align-center">
	<aside class="content__block__text">
		<header><?php echo $hero_title;?></header>
		<div class="flex">
			<?foreach($GLOBALS['contacts'] as $contact_item):?>
			<div class="content__block__text__contacts">
				<address><?=$contact_item['crb_address'];?></address>
				<a href="tel:<?=preg_replace('/[^0-9]/', '', $contact_item['crb_phone']);?>" class="content__block__text__contacts__tel"><?=$contact_item['crb_phone'];?></a>
				<div class="content__block__text__contacts__worktime"><?=wpautop($contact_item['crb_work_time']);?></div>
			</div>
			<?endforeach;?>
		</div>
	</aside>
	<aside class="content__block__picture">
		<img src="<?=$crb_hero_image;?>" alt="<?=strip_tags($hero_title);?>">
	</aside>
</section>