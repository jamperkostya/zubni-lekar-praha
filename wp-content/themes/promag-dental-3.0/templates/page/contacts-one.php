<?$crb_work_time = carbon_get_the_post_meta('crb_work_time');?>
<?$crb_mainpage_contacts = carbon_get_the_post_meta('crb_mainpage_contacts');?>
<?$crb_phone = carbon_get_the_post_meta('crb_phone');?>
<?$crb_email = carbon_get_the_post_meta('crb_email');?>
<?$crb_location = carbon_get_the_post_meta('crb_location');?>
<section class="contacts-container" style="margin-top:150px;">
	<div class="container contacts-item">
		<div class="row contacts-item-row">
			<article class="col-md-4 text-content">
				<header class="header h2"><?php the_title();?></header>
				<div class="teaser"><?php the_content();?></div>
			</article>
			<aside class="map col-md-8 col-sm-12">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2562.170547652938!2d14.311725076615977!3d50.04563637151778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470bbe0139e5a85f%3A0xfd182d0a7596044!2sHostinsk%C3%A9ho%201536%2F7%2C%20155%2000%20Praha%2013-Stod%C5%AFlky!5e0!3m2!1sru!2scz!4v1725095297570!5m2!1sru!2scz" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</aside>
		</div>
		<section class="contacts-data-list">
			<div class="contacts-data-list-item tel">
				<header class="tel-header"><?pll_e('Get in touch with us');?></header>
				<div>
					<a href="tel:<?=preg_replace('/[^0-9]/', '', $crb_phone);?>"><?=$crb_phone;?></a>
					<a href="mailto:<?=$crb_email;?>"><?=$crb_email;?></a>
				</div>
			</div>
			<div class="contacts-data-list-item work-time">
				<header class="work-time-header"><?pll_e('Opening hours');?></header>
				<div><?=wpautop($crb_work_time);?></div>
			</div>
			<div class="contacts-data-list-item address">
				<header class="address-header"><?pll_e('Visit us');?></header>
				<div><?=wpautop($crb_mainpage_contacts);?></div>
			</div>
		</section>
		
		<article class="content">
			<?the_content();?>
		</article>
	</div>
</section>