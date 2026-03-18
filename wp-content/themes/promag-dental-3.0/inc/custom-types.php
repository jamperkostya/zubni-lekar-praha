<?
// Register Custom Post Type - insurance
function insurance_post_type() {
	$labels = array(
		'name'                  => __( 'Insurances', 'Post Type General Name', '{domain}' ),
		'singular_name'         => __( 'Insurance', 'Post Type Singular Name', '{domain}' ),
		'menu_name'             => __( 'Insurances', '{domain}' ),
		'name_admin_bar'        => __( 'Insurance', '{domain}' ),
		'parent_item_colon'     => __( 'Parent Item:', '{domain}' ),
		'add_new_item'          => __( 'Add New Item', '{domain}' ),
		'add_new'               => __( 'Add New', '{domain}' ),
		'edit_item'             => __( 'Edit', '{domain}' ),
		'update_item'           => __( 'Update', '{domain}' ),
	);
	$args = array(
		'label'                 => __( 'Insurances', '{domain}' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail'),
		
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'insurance', $args );

}
add_action( 'init', 'insurance_post_type', 0 );
// Register Custom Post Type - Insurance

// Register Custom Post Type - Team
function team_post_type() {
	$labels = array(
		'name'                  => __( 'Team', 'Post Type General Name', '{domain}' ),
		'singular_name'         => __( 'Team', 'Post Type Singular Name', '{domain}' ),
		'menu_name'             => __( 'Team', '{domain}' ),
		'name_admin_bar'        => __( 'Team', '{domain}' ),
		'parent_item_colon'     => __( 'Parent Item:', '{domain}' ),
		'add_new_item'          => __( 'Add New Item', '{domain}' ),
		'add_new'               => __( 'Add New', '{domain}' ),
		'edit_item'             => __( 'Edit', '{domain}' ),
		'update_item'           => __( 'Update', '{domain}' ),
	);
	$args = array(
		'label'                 => __( 'Team', '{domain}' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'editor'),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'team', $args );

}
add_action( 'init', 'team_post_type', 0 );
// Register Custom Post Type - Team

// Register Custom Post Type - Services
function services_post_type() {
	$labels = array(
		'name'                  => __( 'Services', 'Post Type General Name', '{domain}' ),
		'singular_name'         => __( 'Service', 'Post Type Singular Name', '{domain}' ),
		'menu_name'             => __( 'Services', '{domain}' ),
		'name_admin_bar'        => __( 'Services', '{domain}' ),
		'parent_item_colon'     => __( 'Parent Item:', '{domain}' ),
		'add_new_item'          => __( 'Add New Item', '{domain}' ),
		'add_new'               => __( 'Add New', '{domain}' ),
		'edit_item'             => __( 'Edit', '{domain}' ),
		'update_item'           => __( 'Update', '{domain}' ),
	);
	$template = array(
		array( 'core/image', array(
			'align' => 'left',
		) ),
		array( 'core/heading', array(
			'placeholder' => 'Add Author...',
		) ),
		// Allow a Paragraph block to be moved or removed.
		array( 'core/paragraph', array(
			'placeholder' => 'Add Description...',
			'lock' => array(
				'move'   => false,
				'remove' => false,
			),
		) ),
	);

	$args = array(
		'label'                 => __( 'Services', '{domain}' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'editor'),
		'taxonomies'            => array( 'category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'template'				=> $template,
		'show_in_rest'			=> true
	);
	register_post_type( 'service', $args );

}
add_action( 'init', 'services_post_type', 0 );
// Register Custom Post Type - Services

// Register Custom Post Type - Advantages
function advantages_post_type() {
	$labels = array(
		'name'                  => __( 'Advantages', 'Post Type General Name', '{domain}' ),
		'singular_name'         => __( 'Advantage', 'Post Type Singular Name', '{domain}' ),
		'menu_name'             => __( 'Advantages', '{domain}' ),
		'name_admin_bar'        => __( 'Advantages', '{domain}' ),
		'parent_item_colon'     => __( 'Parent Item:', '{domain}' ),
		'add_new_item'          => __( 'Add New Item', '{domain}' ),
		'add_new'               => __( 'Add New', '{domain}' ),
		'edit_item'             => __( 'Edit', '{domain}' ),
		'update_item'           => __( 'Update', '{domain}' ),
	);
	$args = array(
		'label'                 => __( 'Advantages', '{domain}' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'editor'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'advantage', $args );

}
add_action( 'init', 'advantages_post_type', 0 );
// Register Custom Post Type - Advantages

// Register Custom Post Type - testimonals
function testimonals_post_type() {
	$labels = array(
		'name'                  => __( 'testimonals', 'Post Type General Name', '{domain}' ),
		'singular_name'         => __( 'testimonals', 'Post Type Singular Name', '{domain}' ),
		'menu_name'             => __( 'testimonals', '{domain}' ),
		'name_admin_bar'        => __( 'testimonals', '{domain}' ),
		'parent_item_colon'     => __( 'Parent Item:', '{domain}' ),
		'add_new_item'          => __( 'Add New Item', '{domain}' ),
		'add_new'               => __( 'Add New', '{domain}' ),
		'edit_item'             => __( 'Edit', '{domain}' ),
		'update_item'           => __( 'Update', '{domain}' ),
	);
	$args = array(
		'label'                 => __( 'testimonals', '{domain}' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'editor'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'testimonal', $args );

}
add_action( 'init', 'testimonals_post_type', 0 );
// Register Custom Post Type - testimonals
?>