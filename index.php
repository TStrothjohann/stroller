<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package stroller
 */


// Form Validation
 
if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {

    $post_information = array(
        'post_title' => 'anmeldung' . '-' . wp_get_current_user()->user_firstname . '-' . wp_get_current_user()->user_lastname,
        'post_content' => $_POST['postContent'],
        'post_type' => 'anmeldung',
        'post_status' => 'pending'
    );

  $anmeldung_id = wp_insert_post( $post_information );
  $anmeldung_user_id = wp_get_current_user()->ID;
  
  // save anmeldung into user-profile
  
    if ( current_user_can( 'edit_user', $anmeldung_user_id ) ){
      update_usermeta( $anmeldung_user_id, 'anmeldung_id', $anmeldung_id );
    }
  

  add_post_meta($anmeldung_id, "anmeldung_adresse", wp_strip_all_tags($_POST['anmeldungAdresse']) );
  add_post_meta($anmeldung_id, "anmeldung_hotel", wp_strip_all_tags($_POST['anmeldungHotel']) );
  
  if ( is_array($_POST['angehoerige']) ){
    $angehoerige = implode(', ', $_POST['angehoerige']);
  }else{
    $angehoerige = $_POST['angehoerige'];
  }
  
  update_post_meta($anmeldung_id, "angehoerige",  $angehoerige );

  $post_id = $anmeldung_id;

}
 


// End experiment


get_header(); 

if ( ! is_user_logged_in() ) { ?>
  <div class="row m-t m-b">
    <div class="col-lg-4 col-lg-offset-4">

    <?php $args = array(
        'redirect' => home_url(), 
        'form_id' => 'loginform-index',
        'label_username' => __( 'Anmeldename aus der Einladung' ),
        'label_password' => __( 'Passwort aus der Einladung' ),
        'label_log_in' => __( 'Anmelden' ),
        'remember' => false
    );
    wp_login_form( $args );
    ?>
    </div>
  </div> 
<?php } else { ?>

<div class="col-xs-12">
  
  <?php 
      $menu_name = 'primary';
		  if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
				$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
				$menu_items = wp_get_nav_menu_items($menu->term_id);
				$menu_list = '<nav class="nav nav-masthead">';

				foreach ( (array) $menu_items as $key => $menu_item ) {
				    $title = $menu_item->title;
				    $url = $menu_item->url;
				    $menu_list .= '<a class="nav-link" href="' . $url . '">' . $title . '</a>';
				}
				$menu_list .= '</nav>';
		  } else {
				$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
		  }

		  echo $menu_list;
  ?>
</div>

<div class="row">
  <div class="col-lg-8 col-lg-offset-2">
    <?php 
    $my_query = new WP_Query( 'name=wir-wollen-heiraten' ); 
    if ( have_posts() ) : 
    
      while ( $my_query->have_posts() ) : $my_query->the_post();  ?>

          <div class="jumbotron col-xs-12 featured-area">
            <h1 class="display-1"><?php the_title(); ?></h1>
            <p class="lead"><?php the_content(); ?></p>
            <hr class="m-y-md">
            <p class="lead">
              <a href="#" class="btn btn-lg btn-success text-xs-left">Ja</a>
              <a href="#" class="btn btn-lg btn-danger  text-xs-right">Nein</a>
            </p>
          </div>
      <?php 
      endwhile; 
    endif; ?>


  </div>

</div>

<div>
  <?php 
  if ( $post_id ) {
    echo '<p>Danke für die Anmeldung</p>';
  }else{
    get_template_part( 'create', 'anmeldung' ); 
  }
  ?>
</div>


</div>
<?php } ?>

<?php get_footer(); ?>