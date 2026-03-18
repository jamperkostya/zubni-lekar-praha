<?php
// =========================
//  Переводы для polylang
// =========================
if (function_exists('pll_register_string')) {
	add_action('init', function () {
		pll_register_string('buttons', 'Book Appointment');
		
		pll_register_string('404', '404: No such page');
		pll_register_string('404', 'Try to go to the menu item you need and find the information there.');
		
		pll_register_string('pages', 'Mainpage');
		pll_register_string('pages', 'About us');
		pll_register_string('pages', 'Our team');
		pll_register_string('pages', 'Profession');
		pll_register_string('pages', 'Languages');
		pll_register_string('pages', 'Why Promag-Dental?');
		pll_register_string('pages', 'FAQ');
		pll_register_string('pages', 'Testimonials');
		
		pll_register_string('settings', 'Promag-Dental');
		pll_register_string('settings', 'We accept new');
		pll_register_string('settings', 'Patients!');
		pll_register_string('settings', 'Your personal data will be used solely for the purpose of handling your inquiry.');
		pll_register_string('settings', 'Order today!');
		pll_register_string('settings', 'We will contact you soon and arrange a time for your visit.');
		pll_register_string('settings', 'Show more');
		pll_register_string('settings', 'Show less');
		pll_register_string('settings', 'Our services');
		
		pll_register_string('team', 'Major');
		pll_register_string('team', 'Languages');
		// pll_register_string('buttons', 'Book');
		// pll_register_string('buttons', 'Book');
		// pll_register_string('buttons', 'Book');
		// pll_register_string('buttons', 'Book');
		// pll_register_string('buttons', 'Book');
		// pll_register_string('buttons', 'Book');
		// pll_register_string('buttons', 'Book');
	});
};
if ( ! function_exists( 'pll_e' ) ) {
	add_action('init', function () {
		function pll_e($value)
		{
			return $value;
		}
	});
}
?>