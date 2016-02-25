<?php
/**
 * medium magazin beta functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package stroller
 */
define( 'WP_DEBUG', true );

if ( ! function_exists( 'stroller_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function stroller_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on medium magazin beta, use a find and replace
	 * to change 'stroller' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'stroller', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'stroller' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

}
endif; // stroller_setup
add_action( 'after_setup_theme', 'stroller_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function stroller_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'stroller' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'stroller_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function stroller_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'stroller-style', get_stylesheet_uri() );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '20151106', true );
	
	// custom jquery
	wp_register_script( 'custom_js', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery' ), '1.0', TRUE );
	wp_enqueue_script( 'custom_js' );

	//Google map
	if($_SERVER['HTTP_HOST'] !== "localhost:8080"){
		wp_register_script( 'gmap-api_js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCHwAjG5waPEdLt4qM7NTvWsckOZR6A4EY', array( 'jquery' ), '1.0', FALSE );
		wp_enqueue_script( 'gmap-api_js' );

		wp_register_script( 'gmap_js', get_template_directory_uri() . '/js/gmap.js', array( 'jquery' ), '1.0', TRUE );
		wp_enqueue_script( 'gmap_js' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'stroller_scripts' );


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

// Register Custom Post Type
function register_anmeldung() {

	$labels = array(
		'name'                  => _x( 'Anmeldungen', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Anmeldung', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Anmeldung', 'text_domain' ),
		'name_admin_bar'        => __( 'Anmeldungen', 'text_domain' ),
		'archives'              => __( 'Anmeldungen', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Anmeldung anlegen', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Anmeldung', 'text_domain' ),
		'description'           => __( 'Anmeldungen für die Hochzeit.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'author', 'custom-fields', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
	);
	register_post_type( 'anmeldung', $args );

}
add_action( 'init', 'register_anmeldung', 0 );

//Add Fields for Angehörige
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Angehörige</h3>
	<table class="form-table">
		<tr>
			<th><label for="angehoeriger1">1. Angehöriger</label></th>
			<td>
				<input type="text" name="angehoeriger1" id="angehoeriger1" value="<?php echo esc_attr( get_the_author_meta( 'angehoeriger1', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Erste/r Angehörige/r.</span>
			</td>
		</tr>
		<tr>
			<th><label for="angehoeriger2">2. Angehöriger</label></th>
			<td>
				<input type="text" name="angehoeriger2" id="angehoeriger1" value="<?php echo esc_attr( get_the_author_meta( 'angehoeriger2', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Zweite/r Angehörige/r.</span>
			</td>
		</tr>
		<tr>
			<th><label for="angehoeriger3">3. Angehöriger</label></th>
			<td>
				<input type="text" name="angehoeriger3" id="angehoeriger3" value="<?php echo esc_attr( get_the_author_meta( 'angehoeriger3', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Dritte/r Angehörige/r.</span>
			</td>
		</tr>
		<tr>
			<th><label for="angehoeriger4">4. Angehöriger</label></th>
			<td>
				<input type="text" name="angehoeriger4" id="angehoeriger4" value="<?php echo esc_attr( get_the_author_meta( 'angehoeriger4', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Vierte/r Angehörige/r.</span>
			</td>
		</tr>
	</table>
	<h3>Anmeldung</h3>
	<table class="form-table">
		<tr>
			<th><label for="anmeldung_id">ID der Anmeldung:</label></th>
			<td>
				<span name="anmeldung_id" id="anmeldung_id">
					<?php 
					$anmeldung_id = get_the_author_meta( 'anmeldung_id', $user->ID );
					if ( $anmeldung_id ) {
						
						edit_post_link( $anmeldung_id, '', '', $anmeldung_id );
					}else{
						echo 'noch nicht angemeldet';
					}
					?>
				</span>
			</td>
		</tr>
	</table>
<?php }

add_action( 'personal_options_update', 'save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );

function save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_usermeta( $user_id, 'angehoeriger1', $_POST['angehoeriger1'] );
	update_usermeta( $user_id, 'angehoeriger2', $_POST['angehoeriger2'] );
	update_usermeta( $user_id, 'angehoeriger3', $_POST['angehoeriger3'] );
	update_usermeta( $user_id, 'angehoeriger4', $_POST['angehoeriger4'] );
}

// Hide admin bar
add_filter('show_admin_bar', '__return_false');

add_action( 'init', 'blockusers_init' );
function blockusers_init() {
	if ( is_admin() && ! current_user_can( 'administrator' ) && !( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_redirect( home_url() );
		exit;
	}
}
