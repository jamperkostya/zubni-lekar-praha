<section class="content__block content content__block__content" style="margin-top:150px;">
	<h1>Kontakty</h1>
</section>
<section class="content__block contacts-container">
	<?php $contacts = get_posts(['post_type' => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'page-contacts-one.php']);?>
	<?php foreach($contacts as $post):?>
	<?php setup_postdata($post);?>
	<?php get_template_part('templates/section/contact', 'one');?>
	<?php endforeach;?>
	<?php wp_reset_postdata();?>
</section>
<?get_template_part('templates/section/faq');?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkLMQlLFkUPYYHCc0zYz0FLq-F1kSv-tQ&amp;loading=async&amp;callback=initMaps" id="google-maps-api-js" defer async></script>