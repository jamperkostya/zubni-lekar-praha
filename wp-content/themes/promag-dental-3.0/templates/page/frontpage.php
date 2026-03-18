<?get_template_part('templates/section/hero', 'main');?>

<?$crb_association_pages = carbon_get_the_post_meta('crb_association_pages');?>
<?if(is_array($crb_association_pages)):?>
<section class="content__block clinics__block content">
	<article class="content__block__text">
		<h2><?pll_e('Our Clinics');?></h2>
		<?foreach($crb_association_pages as $clinic):?>
		<?$post = get_post($clinic['id']);?>
		<?$crb_mainpage_contacts = carbon_get_the_post_meta('crb_mainpage_contacts');?>
		<?$crb_work_time = carbon_get_the_post_meta('crb_work_time');?>
		<?$crb_phone = carbon_get_the_post_meta('crb_phone');?>
		<?setup_postdata($clinic);?>
		<aside class="clinic__block flex flex-align-center mobile-flex-wrap">
			<img src="<?=get_the_post_thumbnail_url($post, 'large');?>" alt="">
			<div class="clinic__block__data__container">
				<header><?the_title();?></header>
				<div class="clinic__block__data">
					<a class="clinic__block__data__phone" href="tel:<?=preg_replace('/[^0-9]/', '', $crb_phone);?>"><?=$crb_phone;?></a>
					<div class="clinic__block__data__address">
						<div><?=wpautop($crb_mainpage_contacts);?></div>
					</div>
					<div class="clinic__block__data__worktime">
						<div><?=wpautop($crb_work_time);?></div>
					</div>
				</div>
			</div>
		</aside>
		<?endforeach;?>
		<?wp_reset_postdata();?>
	</article>
</section>
<?endif;?>

<?get_template_part('templates/section/services');?>
<section class="content__block flex gap-48 flex-align-center content mobile-flex-wrap">
	<article class="content__block__text width-50">
		<h2 class="h1"><?php the_title();?></h2>
		<div class="text"><?php the_content();?></div>
		<button class="button button-secondary appointment-button"><?pll_e('Book Appointment');?></button>
	</article>
	<aside class="content__block__picture width-50 text-right">
		<?php the_post_thumbnail();?>
	</aside>
</section>

<?get_template_part('templates/section/team');?>
<?get_template_part('templates/section/advantages');?>

<?$crb_about_text = carbon_get_the_post_meta('crb_about_text');?>
<?if(!empty($crb_about_text)):?>
<section class="content__block flex gap-48 flex-align-center content">
	<article class="content__block__text width-50">
		<h2 class="h1"><?pll_e('About us');?></h2>
		<div class="text"><?=$crb_about_text;?></div>
		<button class="button button-secondary"><?pll_e('Book Appointment');?></button>
	</article>
	<?$crb_about_image = wp_get_attachment_image_src(carbon_get_the_post_meta('crb_about_image'), 'full')[0];?>
	<?if(!empty($crb_about_image)):?>
	<aside class="content__block__picture width-50 text-right">
		<img src="<?=$crb_about_image;?>" alt="<?pll_e('About us');?>" width="481">
	</aside>
	<?endif;?>
</section>
<?endif;?>
<?get_template_part('templates/section/testimonials');?>
<?get_template_part('templates/section/faq');?>