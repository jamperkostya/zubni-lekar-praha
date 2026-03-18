<?php
add_filter('wpcf7_form_elements', function ($content) {
  // Добавляем inputmode всем полям с классом phone-input
  return preg_replace(
	'/(<input[^>]+class="[^"]*phone-input[^"]*"[^>]*)(>)/',
	'$1 inputmode="numeric"$2',
	$content
  );
});
// фукция для того, чтобы сделать аватарку текстовую из первых букв слов (по примеру мессенджеров)
function get_first_letters($text, $symbols_counter = 2)
{
	$words = explode(' ', $text);
	foreach($words as $word)
	{
		$initials .= mb_substr($word, 0, 1);
	}
	return mb_strtoupper(mb_substr($initials, 0, $symbols_counter));
}
// фукция для того, чтобы сделать аватарку текстовую из первых букв слов (по примеру мессенджеров)
add_filter( 'tablepress_table_render_data', function( $render_data, $table ) {
	// Если почему-то нет названия таблицы или шаблон не страницы прайса — ничего не делаем
	if ( get_page_template_slug()!='page-price.php' || empty($table['id']) || empty($render_data['name']) ) {
		return $render_data;
	}
	$table_id = $table['id'];
	$shortcode = '[table id=' . $table_id;
	// Ищем пост service у которого в carbon поле указан этот ID таблицы
	$service = get_posts([
		'post_type'  => 'service',
		'meta_query' => [
			[
				'key'     => 'crb_price_content',
				'value'   => $shortcode,
				'compare' => 'LIKE'
			]
		],
		'numberposts' => 1,
	]);

	if ( ! empty($service) ) {
		$service_link = get_permalink( $service[0]->ID );
		$service_title = get_the_title( $service[0]->ID );

		// Модифицируем заголовок таблицы
		$render_data['name'] .= '<a href="'. $service_link .'">Kompletní ceník za službu</a>';
	}
	return $render_data;
}, 10, 2 );
// =========================
//  Для CF7 форм - после заполнения показываем модалки thank you
// =========================
add_action( 'wp_footer', 'artit_wp_footer' );
function artit_wp_footer() {?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
	jQuery('#appointmentModal').modal('hide');
	jQuery('#thankyouModal').modal('show'); //this is the bootstrap modal popup id
}, false );
</script>
<?php }