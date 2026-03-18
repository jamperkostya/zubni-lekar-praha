<?php
if (!function_exists( 'carbon_get_post_meta')) {
	function carbon_get_post_meta($id, $name, $type = null) {
		return false;
	}
}
if (!function_exists('carbon_get_the_post_meta')) {
	function carbon_get_the_post_meta($name, $type = null) {
		return false;
	}
}
if (!function_exists('carbon_get_theme_option')) {
	function carbon_get_theme_option($name, $type = null) {
		return false;
	}
}
if (!function_exists('carbon_get_term_meta')) {
	function carbon_get_term_meta($id, $name, $type = null) {
		return false;
	}
}
if (!function_exists('carbon_get_user_meta')) {
	function carbon_get_user_meta($id, $name, $type = null) {
		return false;
	}
}
if (!function_exists('carbon_get_comment_meta')) {
	function carbon_get_comment_meta($id, $name, $type = null) {
		return false;
	}
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', __( 'Settings', 'crb' ) )
->add_fields(
    [
        Field::make('text', 'crb_address_1', 'Addres 1')
        ->set_width(30),
        Field::make('text', 'crb_phone_1', 'Phone 1')
        ->set_width(30),
        Field::make('text', 'crb_email_1', 'Email 1')
        ->set_width(30),
        Field::make('text', 'crb_symbols_1', 'Symbols 1')
        ->set_width(10),
        Field::make('Rich_text', 'crb_work_time_1_'.carbon_lang(), 'Work time 1')
        ->set_width(40),
        Field::make('Rich_text', 'crb_full_address_1_'.carbon_lang(), 'Full address 1')
        ->set_width(60),
        Field::make('text', 'crb_address_2', 'Addres 2')
        ->set_width(30),
        Field::make('text', 'crb_phone_2', 'Phone 2')
        ->set_width(30),
        Field::make('text', 'crb_email_2', 'Email 2')
        ->set_width(30),
        Field::make('text', 'crb_symbols_2', 'Symbols 2')
        ->set_width(10),
        Field::make('Rich_text', 'crb_work_time_2_'.carbon_lang(), 'Work time 2')
        ->set_width(40),
        Field::make('Rich_text', 'crb_full_address_2_'.carbon_lang(), 'Full address 2')
        ->set_width(60),
    ]
);
function carbon_lang() {
    $suffix = '';
    if ( ! function_exists( 'pll_current_language' ) ) {
        return $suffix;
    }
    $suffix = '_' . pll_current_language();
    return $suffix;
}
add_filter( 'carbon_fields_map_field_api_key', 'crb_get_gmaps_api_key' );
function crb_get_gmaps_api_key( $current_key ) {
    return 'AIzaSyBkLMQlLFkUPYYHCc0zYz0FLq-F1kSv-tQ';
}
Container::make( 'post_meta', 'Frontpage' )
->where( 'post_id', '=', get_option( 'page_on_front' ) )
->add_fields(
    [
        Field::make('text', 'crb_hero_title', 'Hero title')
        ->set_width(100),
        Field::make('association', 'crb_association_pages')
        ->set_types([
            [
                'type' => 'post',
                'post_type' => 'page',
            ]
        ]),
        Field::make('Rich_text', 'crb_about_text', 'About text')
        ->set_width(50),
        Field::make('File', 'crb_about_image', 'About image')
        ->set_type(['image'])
        ->set_width(50),
    ],
);
Container::make( 'post_meta', 'Contacts' )
->show_on_template('page-contacts-one.php')
->add_fields(
    [
        Field::make('Rich_text', 'crb_mainpage_contacts', 'Contacts on mainpage block')
        ->set_width(50),
        Field::make('Rich_text', 'crb_work_time', 'Work time')
        ->set_width(50),
        Field::make('text', 'crb_address', 'Address')
        ->set_width(40),
        Field::make('text', 'crb_phone', 'Phone')
        ->set_width(30),
        Field::make('text', 'crb_email', 'Email')
        ->set_width(30),
        
        Field::make( 'map', 'crb_location', 'Location' )
        ->set_help_text( 'drag and drop the pin on the map to select location' )
    ]
);
Container::make( 'post_meta', 'Team' )
->where( 'post_type', '=', 'team' )
->add_fields(
    [
        Field::make('text', 'crb_major', 'Major')
        ->set_width(40),
        Field::make('text', 'crb_languages', 'Languages')
        ->set_width(40),
        Field::make('association', 'crb_association_services')
        ->set_types([
            [
                'type' => 'post',
                'post_type' => 'service',
            ]
        ])
    ]
);
Container::make( 'post_meta', 'Service' )
->where( 'post_type', '=', 'service' )
->add_fields(
    [
        Field::make('association', 'crb_association_team')
        ->set_types([
            [
                'type' => 'post',
                'post_type' => 'team',
            ]
        ])
    ]
);
Container::make( 'post_meta', 'Slider' )
->where( 'post_type', 'IN', ['page','service'] )
->add_fields(
    [
        Field::make('File', 'crb_hero_image', 'Hero image')
        ->set_type(['image']),
        Field::make('text', 'crb_seo_text_title', 'SEO Text Title')
        ->set_width(100),
        Field::make('Rich_text', 'crb_seo_text', 'SEO Text')
        ->set_width(100),
        Field::make( 'complex', 'faq', 'FAQ' )
        ->add_fields( 'section', '-', [
            Field::make('Text', 'crb_title', 'Title')
                ->set_width(100),
            Field::make('Rich_text', 'crb_description', 'Description')
                ->set_width(100)
        ]),
    ]
);
Container::make( 'post_meta', 'Testimonal' )
->where( 'post_type', 'IN', ['testimonal'] )
->add_fields(
    [
        Field::make( 'select', 'crb_source', 'Source' )
        ->add_options( array(
            '' => 'None',
            'google' => 'Google',
            'seznam' => 'Seznam',
        ) )
    ]
)
?>
