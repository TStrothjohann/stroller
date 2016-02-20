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
    if( isset( $_POST['abmeldung'] ) ){ $prefix = 'abmeldung'; }else{ $prefix = 'anmeldung'; }

    $post_information = array(
        'post_title' => $prefix . '-' . wp_get_current_user()->user_firstname . '-' . wp_get_current_user()->user_lastname,
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


<div class="row" id="wann-wo">
  <div class="col-lg-8 col-lg-offset-2">
    <?php 
    $my_query = new WP_Query( 'name=wir-wollen-heiraten' ); 
    if ( have_posts() ) : 
    
      while ( $my_query->have_posts() ) : $my_query->the_post();  ?>

          <div class="jumbotron col-xs-12 featured-area text-xs-center">
            <h1 class="display-1"><?php the_title(); ?></h1>
            <p class="lead"><?php the_content(); ?></p>
            <hr class="m-y-md">
            <?php 
              $anmeldung_id = get_the_author_meta( 'anmeldung_id', wp_get_current_user()->ID );
          if ( $anmeldung_id ) {
            
            echo "Du hast Dich für unsere Hochzeit angemeldet. Willst Du deine <a href='/anmeldung' alt='Anmeldung bearbeiten'>Anmeldung bearbeiten?</a>";

          }else{ ?>
            <div class="col-xs-6 col-xs-offset-3">
              <a href="#hello" id="ja" class="btn btn-secondary-outline btn-block">Ja</a>
              <a href="#hello" id="nein" class="btn btn-secondary-outline btn-block">Leider nein</a>
            </div>
          <?php
          }
          ?>

          </div>
      <?php 
      endwhile; 
    endif; ?>


  </div>

</div>

<div id="anmeldung" class="row">
  <div class="col-xs-12 col-lg-8 col-lg-offset-2">
  <?php 
  if ( $post_id ) {
    if( isset($_POST['abmeldung']) ){
      echo '<div class="alert alert-danger"><p><strong>Schade.</strong> Trotzdem danke für deine Nachricht. Meld dich, falls du es dir anders überlegst.</p></div>';
    }else{
      echo '<div class="alert alert-success"><p><strong>Danke für die Anmeldung, wir freuen uns auf dich!</strong></p><p>Unter <a href="/anmeldung">"Anmeldung"</a> kannst du die Anmeldung ergänzen oder korrigieren.</p></div>';
    }
  }else{
    get_template_part( 'create', 'anmeldung' ); 
  }
  ?>
  </div>
</div>


</div>
<?php } ?>

<?php get_footer(); ?>