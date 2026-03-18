<?$crb_work_time = carbon_get_the_post_meta('crb_work_time');?>
<?$crb_phone = carbon_get_the_post_meta('crb_phone');?>
<?$crb_mainpage_contacts = carbon_get_the_post_meta('crb_mainpage_contacts');?>
<?$crb_location = carbon_get_the_post_meta('crb_location');?>
<article class="content__block__text flex content clinic__one__item">
	<aside class="clinic__block flex flex-align-center">
		<div class="clinic__block__data__container">
			<a href="<?php the_permalink();?>" class="contact-link"><header class="h1"><?php the_title();?></header></a>
			<div class="text"></div>
			<div class="clinic__block__data">
				<a class="clinic__block__data__phone" href="tel:<?php echo preg_replace('/[^0-9]/', '', $crb_phone);?>"><?php echo $crb_phone;?></a>
				<div class="clinic__block__data__address">
					<div><?php echo wpautop($crb_mainpage_contacts);?></div>
				</div>
				<div class="clinic__block__data__worktime">
					<div><?php echo wpautop($crb_work_time);?></div>
				</div>
			</div>
		</div>
	</aside>
	<aside class="clinic__block__map" id="mapStodulky1">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2562.170547652938!2d14.311725076615977!3d50.04563637151778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470bbe0139e5a85f%3A0xfd182d0a7596044!2sHostinsk%C3%A9ho%201536%2F7%2C%20155%2000%20Praha%2013-Stod%C5%AFlky!5e0!3m2!1sru!2scz!4v1725095297570!5m2!1sru!2scz" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</aside>
</article>
