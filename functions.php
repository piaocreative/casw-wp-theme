<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package casw
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );

	// wp_enqueue_style( 'child-understrap-gfonts', "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap", array(), $css_version );

	wp_enqueue_script( 'jquery' );

	$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_scripts );

	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Magnific Popup
	wp_enqueue_style( 'magnific', get_stylesheet_directory_uri() . '/css/magnific-popup.min.css', array(), false );
	wp_enqueue_script( 'magnific', get_stylesheet_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), false, true );

	// Slick slider
	if ( is_front_page() ) {
		wp_enqueue_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array(), false );
		wp_enqueue_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array( 'jquery' ), false, true );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
	remove_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );

/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

/**
 * Add Site Settings ACF options
 */
if (function_exists('acf_add_options_page')):
	acf_add_options_page(
		array(
			'page_title' => 'Site Settings',
			'menu_slug' => 'site-settings',
			'menu_title' => 'Site Settings',
			'capability' => 'edit_posts',
			'position' => '',
			'parent_slug' => '',
			'icon_url' => '',
			'redirect' => true,
			'post_id' => 'options',
			'autoload' => false,
			'update_button' => 'Update',
			'updated_message' => 'Options Updated',
		)
	);
endif;

function custom_search_placeholder( $form )
{
	$form = str_replace('placeholder="Search &hellip;"', 'placeholder="Search our site"', $form);
	return $form;
}
add_filter('get_search_form', 'custom_search_placeholder');

/**
 * Resources CPT
 * Events CPT
 * Newsletters CPT
 * @package casw
 */
function create_custom_post_type()
{
	$resources_labels = array(
		'name' 					=> _x( 'Resources', 'Post Type General Name', 'casw' ),
		'singular_name' 		=> _x( 'Resource', 'Post Type Singular Name', 'casw' ),
		'menu_name' 			=> __( 'Resources', 'casw' ),
		'name_admin_bar' 		=> __( 'Resources', 'casw' ),
		'archives' 				=> __( 'Resource Archives', 'casw' ),
		'attributes' 			=> __( 'Resource Attributes', 'casw' ),
		'parent_item_colon' 	=> __( 'Parent Resource:', 'casw' ),
		'all_items' 			=> __( 'All Resources', 'casw' ),
		'add_new_item' 			=> __( 'Add New Resource', 'casw' ),
		'add_new' 				=> __( 'Add New Resource', 'casw' ),
		'new_item' 				=> __( 'New Resource', 'casw' ),
		'edit_item' 			=> __( 'Edit Resource', 'casw' ),
		'update_item' 			=> __( 'Update Resource', 'casw' ),
		'view_item' 			=> __( 'View Resource', 'casw' ),
		'view_items' 			=> __( 'View Resources', 'casw' ),
		'search_items' 			=> __( 'Search Resource', 'casw' ),
		'not_found' 			=> __( 'Not found', 'casw' ),
		'not_found_in_trash' 	=> __( 'Not found in Trash', 'casw' ),
		'featured_image' 		=> __( 'Featured Image', 'casw' ),
		'set_featured_image' 	=> __( 'Set featured image', 'casw' ),
		'remove_featured_image' => __( 'Remove featured image', 'casw' ),
		'use_featured_image' 	=> __( 'Use as featured image', 'casw' ),
		'insert_into_item' 		=> __( 'Insert into item', 'casw' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'casw' ),
		'items_list' 			=> __( 'Items list', 'casw' ),
		'items_list_navigation' => __( 'Items list navigation', 'casw' ),
		'filter_items_list' 	=> __( 'Filter items list', 'casw' ),
	);

	// Resources Post Type
	$resources = array(
		'label' 				=> __( 'Resource', 'casw' ),
		'description' 			=> __( 'Resources', 'casw' ),
		'labels' 				=> $resources_labels,
		'supports' 				=> array( 'title', 'editor', 'thumbnail' ),
		'taxonomies' 			=> array(),
		'hierarchical' 			=> false,
		'public' 				=> true,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'menu_position' 		=> 25,
		'menu_icon' 			=> 'dashicons-admin-post',
		'show_in_admin_bar' 	=> true,
		'show_in_nav_menus' 	=> false,
		'can_export' 			=> true,
		'has_archive' 			=> false,
		'exclude_from_search' 	=> false,
		'publicly_queryable' 	=> true,
		'capability_type' 		=> 'page',
		'rewrite' 				=> array( 'slug' => '/resources', 'with_front' => false )
	);
	register_post_type( 'post-resource', $resources );

	// Resources Post type taxonomy
	register_taxonomy( 'resource-category', 'post-resource', array(
		'hierarchical' 			=> false,
		'labels' 				=> array(
			'name' 					=> __( 'Resource Category', 'casw' ),
			'singular_name' 		=> __( 'Resource Category', 'casw' ),
			'search_items' 			=> __( 'Search Resource Categories', 'casw' ),
			'all_items' 			=> __( 'All Resource Categories', 'casw' ),
			'parent_item' 			=> __( 'Parent Resource Category', 'casw' ),
			'parent_item_colon' 	=> __( 'Parent Resource Category:', 'casw' ),
			'edit_item' 			=> __( 'Edit Resource Category', 'casw' ),
			'update_item' 			=> __( 'Update Resource Category', 'casw' ),
			'add_new_item' 			=> __( 'Add New Resource Category', 'casw' ),
			'new_item_name' 		=> __( 'New Resource Category Name', 'casw' )
		),
		'show_admin_column' 	=> true,
		'show_ui' 				=> true,
		'query_var' 			=> true,
	) );

	// Resources Post type taxonomy
	register_taxonomy( 'resource-type', 'post-resource', array(
		'hierarchical' 			=> true,
		'labels' 				=> array(
			'name' 					=> __( 'Resource Type', 'casw' ),
			'singular_name' 		=> __( 'Resource Type', 'casw' ),
			'search_items' 			=> __( 'Search Resource Types', 'casw' ),
			'all_items' 			=> __( 'All Resource Types', 'casw' ),
			'parent_item' 			=> __( 'Parent Resource Type', 'casw' ),
			'parent_item_colon' 	=> __( 'Parent Resource Type:', 'casw' ),
			'edit_item' 			=> __( 'Edit Resource Type', 'casw' ),
			'update_item' 			=> __( 'Update Resource Type', 'casw' ),
			'add_new_item' 			=> __( 'Add New Resource Type', 'casw' ),
			'new_item_name' 		=> __( 'New Resource Type Name', 'casw' )
		),
		'show_admin_column' 	=> true,
		'show_ui' 				=> true,
		'query_var' 			=> true,
	) );

	// Resources Audience taxonomy
	register_taxonomy( 'resource-audience', 'post-resource', array(
		'hierarchical' 			=> false,
		'labels' 				=> array(
			'name' 					=> __( 'Resource Audience', 'casw' ),
			'singular_name' 		=> __( 'Resource Audience', 'casw' ),
			'search_items' 			=> __( 'Search Resource Audiences', 'casw' ),
			'all_items' 			=> __( 'All Resource Audiences', 'casw' ),
			'parent_item' 			=> __( 'Parent Resource Audience', 'casw' ),
			'parent_item_colon' 	=> __( 'Parent Resource Audience:', 'casw' ),
			'edit_item' 			=> __( 'Edit Resource Audience', 'casw' ),
			'update_item' 			=> __( 'Update Resource Audience', 'casw' ),
			'add_new_item' 			=> __( 'Add New Resource Audience', 'casw' ),
			'new_item_name' 		=> __( 'New Resource Audience Name', 'casw' )
		),
		'show_admin_column' 	=> true,
		'show_ui' 				=> true,
		'query_var' 			=> true,
	) );

	$events_labels = array(
		'name' 					=> _x( 'Events', 'Post Type General Name', 'casw' ),
		'singular_name' 		=> _x( 'Event', 'Post Type Singular Name', 'casw' ),
		'menu_name' 			=> __( 'Events', 'casw' ),
		'name_admin_bar' 		=> __( 'Events', 'casw' ),
		'archives' 				=> __( 'Event Archives', 'casw' ),
		'attributes' 			=> __( 'Event Attributes', 'casw' ),
		'parent_item_colon' 	=> __( 'Parent Event:', 'casw' ),
		'all_items' 			=> __( 'All Events', 'casw' ),
		'add_new_item' 			=> __( 'Add New Event', 'casw' ),
		'add_new' 				=> __( 'Add New Event', 'casw' ),
		'new_item' 				=> __( 'New Event', 'casw' ),
		'edit_item' 			=> __( 'Edit Event', 'casw' ),
		'update_item' 			=> __( 'Update Event', 'casw' ),
		'view_item' 			=> __( 'View Event', 'casw' ),
		'view_items' 			=> __( 'View Events', 'casw' ),
		'search_items' 			=> __( 'Search Event', 'casw' ),
		'not_found' 			=> __( 'Not found', 'casw' ),
		'not_found_in_trash' 	=> __( 'Not found in Trash', 'casw' ),
		'featured_image' 		=> __( 'Featured Image', 'casw' ),
		'set_featured_image' 	=> __( 'Set featured image', 'casw' ),
		'remove_featured_image' => __( 'Remove featured image', 'casw' ),
		'use_featured_image' 	=> __( 'Use as featured image', 'casw' ),
		'insert_into_item' 		=> __( 'Insert into item', 'casw' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'casw' ),
		'items_list' 			=> __( 'Items list', 'casw' ),
		'items_list_navigation' => __( 'Items list navigation', 'casw' ),
		'filter_items_list' 	=> __( 'Filter items list', 'casw' ),
	);

	// Event Post Type
	$events = array(
		'label' 				=> __( 'Event', 'casw' ),
		'description' 			=> __( 'Events', 'casw' ),
		'labels' 				=> $events_labels,
		'supports' 				=> array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies' 			=> array(),
		'hierarchical' 			=> false,
		'public' 				=> true,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'menu_position' 		=> 25,
		'menu_icon' 			=> 'dashicons-calendar',
		'show_in_admin_bar' 	=> true,
		'show_in_nav_menus' 	=> false,
		'can_export' 			=> true,
		'has_archive' 			=> false,
		'exclude_from_search' 	=> false,
		'publicly_queryable' 	=> true,
		'capability_type' 		=> 'page',
		'rewrite' 				=> array( 'slug' => '/events', 'with_front' => false )
	);
	register_post_type( 'post-event', $events );

	$newsletters_labels = array(
		'name' 					=> _x( 'Newsletters', 'Post Type General Name', 'casw' ),
		'singular_name' 		=> _x( 'Newsletter', 'Post Type Singular Name', 'casw' ),
		'menu_name' 			=> __( 'Newsletters', 'casw' ),
		'name_admin_bar' 		=> __( 'Newsletters', 'casw' ),
		'archives' 				=> __( 'Newsletter Archives', 'casw' ),
		'attributes' 			=> __( 'Newsletter Attributes', 'casw' ),
		'parent_item_colon' 	=> __( 'Parent Newsletter:', 'casw' ),
		'all_items' 			=> __( 'All Newsletters', 'casw' ),
		'add_new_item' 			=> __( 'Add New Newsletter', 'casw' ),
		'add_new' 				=> __( 'Add New Newsletter', 'casw' ),
		'new_item' 				=> __( 'New Newsletter', 'casw' ),
		'edit_item' 			=> __( 'Edit Newsletter', 'casw' ),
		'update_item' 			=> __( 'Update Newsletter', 'casw' ),
		'view_item' 			=> __( 'View Newsletter', 'casw' ),
		'view_items' 			=> __( 'View Newsletters', 'casw' ),
		'search_items' 			=> __( 'Search Newsletter', 'casw' ),
		'not_found' 			=> __( 'Not found', 'casw' ),
		'not_found_in_trash' 	=> __( 'Not found in Trash', 'casw' ),
		'featured_image' 		=> __( 'Featured Image', 'casw' ),
		'set_featured_image' 	=> __( 'Set featured image', 'casw' ),
		'remove_featured_image' => __( 'Remove featured image', 'casw' ),
		'use_featured_image' 	=> __( 'Use as featured image', 'casw' ),
		'insert_into_item' 		=> __( 'Insert into item', 'casw' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'casw' ),
		'items_list' 			=> __( 'Items list', 'casw' ),
		'items_list_navigation' => __( 'Items list navigation', 'casw' ),
		'filter_items_list' 	=> __( 'Filter items list', 'casw' ),
	);

	// Newsletter Post Type
	$newsletters = array(
		'label' 				=> __( 'Newsletter', 'casw' ),
		'description' 			=> __( 'Newsletters', 'casw' ),
		'labels' 				=> $newsletters_labels,
		'supports' 				=> array( 'title', 'editor', 'thumbnail' ),
		'taxonomies' 			=> array(),
		'hierarchical' 			=> false,
		'public' 				=> true,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'menu_position' 		=> 25,
		'menu_icon' 			=> 'dashicons-admin-post',
		'show_in_admin_bar' 	=> true,
		'show_in_nav_menus' 	=> false,
		'can_export' 			=> true,
		'has_archive' 			=> false,
		'exclude_from_search' 	=> false,
		'publicly_queryable' 	=> true,
		'capability_type' 		=> 'page',
		'rewrite' 				=> array( 'slug' => '/newsletters', 'with_front' => false )
	);
	register_post_type( 'post-newsletter', $newsletters );

}
add_action('init', 'create_custom_post_type', 0);

// Register Custom Taxonomy
function engineering_taxonomy()
{
	$labels = array(
		'name' => _x('Categories', 'Taxonomy General Name', 'casw'),
		'singular_name' => _x('Category', 'Taxonomy Singular Name', 'casw'),
		'menu_name' => __('Categories', 'casw'),
		'all_items' => __('All Categories', 'casw'),
		'parent_item' => __('Parent Category', 'casw'),
		'parent_item_colon' => __('Parent Category:', 'casw'),
		'new_item_name' => __('New Category Name', 'casw'),
		'add_new_item' => __('Add New Category', 'casw'),
		'edit_item' => __('Edit Category', 'casw'),
		'update_item' => __('Update Category', 'casw'),
		'view_item' => __('View Category', 'casw'),
		'separate_items_with_commas' => __('Separate categories with commas', 'casw'),
		'add_or_remove_items' => __('Add or remove categories', 'casw'),
		'choose_from_most_used' => __('Choose from the most used', 'casw'),
		'popular_items' => __('Popular categories', 'casw'),
		'search_items' => __('Search Categories', 'casw'),
		'not_found' => __('Not Found', 'casw'),
		'no_terms' => __('No categories', 'casw'),
		'items_list' => __('Categories list', 'casw'),
		'items_list_navigation' => __('Categories list navigation', 'casw'),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_rest' => true,
		'rewrite' => array(
			'with_front' => false,
			'slug' => 'engineering-blog-category',
		),
	);
	register_taxonomy('engineering_taxonomy', array('engineering'), $args);
}

function acf_load_taxonomy_field_choices( $field ) {
	// Reset choices
    $field['choices'] = array();

    $taxonomy = 'resource-type';

    // Get terms of the specified taxonomy
    $terms = get_terms($taxonomy, array(
        'hide_empty' => false,
    ));

    // Check for a WP_Error object (in case the taxonomy doesn't exist)
    if ( !is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            $field['choices'][ $term->slug ] = $term->name;
        }
    }

	$field['default_value'] = $terms[0]->slug;

    // Return the field
    return $field;
}
add_filter('acf/load_field/name=resource_type', 'acf_load_taxonomy_field_choices');

if ( ! function_exists( 'casw_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function casw_widgets_init() {
		
		register_sidebar(
			array(
				'name'          => __( 'Footer Widget 1', 'casw' ),
				'id'            => 'footer-widget-1',
				'description'   => __( 'Footer widget 1', 'casw' ),
				'before_widget' => '<div id="%1$s" class="footer-widget">',
				'after_widget'  => '</div><!-- .footer-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		
		register_sidebar(
			array(
				'name'          => __( 'Footer Widget 2', 'casw' ),
				'id'            => 'footer-widget-2',
				'description'   => __( 'Footer widget 2', 'casw' ),
				'before_widget' => '<div id="%1$s" class="footer-widget">',
				'after_widget'  => '</div><!-- .footer-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		
		register_sidebar(
			array(
				'name'          => __( 'Footer Widget 3', 'casw' ),
				'id'            => 'footer-widget-3',
				'description'   => __( 'Footer widget 3', 'casw' ),
				'before_widget' => '<div id="%1$s" class="footer-widget">',
				'after_widget'  => '</div><!-- .footer-widget -->',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

	}
}
add_action( 'widgets_init', 'casw_widgets_init' );

/**
 * Adds a custom read more link to all excerpts, manually or automatically generated
 *
 * @param string $post_excerpt Posts's excerpt.
 *
 * @return string
 */
if ( ! function_exists( 'casw_all_excerpts_get_more_link' ) ) {
	
	function casw_all_excerpts_get_more_link( $post_excerpt ) {
		if ( is_admin() || ! get_the_ID() ) {
			return $post_excerpt;
		}

		$permalink = esc_url( get_permalink( (int) get_the_ID() ) ); // @phpstan-ignore-line -- post exists

		return $post_excerpt . '<p><a class="btn btn-secondary" href="' . $permalink . '">' . __(
			'View',
			'casw'
		) . '<span class="screen-reader-text"> from ' . get_the_title( get_the_ID() ) . '</span></a></p>';

	}
}
add_filter( 'wp_trim_excerpt', 'casw_all_excerpts_get_more_link' );

// Allow the Gravity form to stay on the page when confirmation displays.
function casw_show_confirmation_and_form( $form ) {

    // Inserts a shortcode for the form without title or description
    $shortcode = '[gravityform id="' . $form['id'] . '" title="false" description="false"]';

    // Ensures that new lines are not added to HTML Markup
    ob_start();
    echo do_shortcode( $shortcode );
    $html = str_replace( array( "\r","\n" ), '', trim( ob_get_clean() ) );

    // Inserts the form before the confirmation message
    if ( array_key_exists( 'confirmations', $form ) ) {
        foreach ( $form['confirmations'] as $key => $confirmation ) {
            $form['confirmations'][ $key ]['message'] = $html . '<div class="confirmation-message">' . $form['confirmations'][ $key ]['message'] . '</div>';
        }
    }

    return $form;
}
add_filter( 'gform_pre_submission_filter', 'casw_show_confirmation_and_form' );

// Load resources via Ajax
// function resource_load_more() {
// 	$args = array(
// 		'post_type' => 'post-resource',
// 	  	'posts_per_page' => 12,
// 	  	'paged' => $_POST['paged'],
// 		'orderby' => 'date',
// 		'order' => 'DESC',
// 	);

// 	$query = new WP_Query( $args );

// 	$response = '';
// 	$max_pages = $query->max_num_pages;

// 	if ( $query->have_posts() ) {
// 		ob_start();
// 	  	while( $query->have_posts() ) {
// 			$query->the_post();
// 			echo '<div class="col-lg-4 col-md-6">';
// 			echo get_template_part( 'loop-templates/content', 'resource' );
// 			echo '</div>';
// 		}
// 		$output = ob_get_contents();
//     	ob_end_clean();
// 	}

// 	$result = [
// 		'max' => $max_pages,
// 		'html' => $output
// 	];

// 	echo json_encode($result);
// 	exit;
// }
// add_action( 'wp_ajax_resource_load_more', 'resource_load_more' );
// add_action( 'wp_ajax_nopriv_resource_load_more', 'resource_load_more' );