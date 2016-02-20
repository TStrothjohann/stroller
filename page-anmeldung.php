<?php
/**
 * Template für die Anmeldungsberarbeitung
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package stroller
 */

get_header(); 
$users_meta = get_user_meta(wp_get_current_user()->ID); 
$anmeldung_user_id = wp_get_current_user()->ID;
$anmeldung_id = get_the_author_meta( 'anmeldung_id', $anmeldung_user_id );
$anmeldung_daten = get_post_meta($anmeldung_id);
$anmeldung = get_post($anmeldung_id);

if($anmeldung_id){
  //Form validation
  if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {

    $post_information = array(
        'ID' => $anmeldung_id,
        'post_content' => $_POST['postContent'],
    );

  wp_update_post( $post_information );
  
  update_post_meta($anmeldung_id, "anmeldung_hotel", wp_strip_all_tags($_POST['anmeldungHotel']) );
  
  if ( is_array($_POST['angehoerige']) ){
    $angehoerige = implode(', ', $_POST['angehoerige']);
  }else{
    $angehoerige = $_POST['angehoerige'];
  }
  
  update_post_meta($anmeldung_id, "angehoerige",  $angehoerige );


  }
//Form

  ?>
<div class="row">
  <div class="col-xs-12 col-lg-8 col-lg-offset-2">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
      </header><!-- .entry-header -->
      <div class="entry-content">
        <?php the_content(); ?>
      </div><!-- .entry-content -->
      <?php endwhile; endif; ?>
      <form action="" id="createPostForm" method="POST">
        <fieldset class="form-group">
          <label for="anmeldungHotel">Hast Du schon eine Hotelreservierung?</label>
          <select class="form-control" id="anmeldungHotel" name="anmeldungHotel">
            <option
              <?php
                if (strpos($anmeldung_daten[anmeldung_hotel][0], 'Noch keine Reservierung') !== false) { echo 'selected'; }
              ?>
            >Noch keine Reservierung</option>
            <option
              <?php
                if (strpos($anmeldung_daten[anmeldung_hotel][0], 'Gasthof Ohrnbachtal') !== false) { echo 'selected'; }
              ?>
            >Gasthof Ohrnbachtal</option>
            <option
              <?php
                if (strpos($anmeldung_daten[anmeldung_hotel][0], 'Geiersmühle') !== false) { echo 'selected'; }
              ?>
            >Geiersmühle</option>
            <option
              <?php
                if (strpos($anmeldung_daten[anmeldung_hotel][0], 'Parkhotel 1970') !== false) { echo 'selected'; }
              ?>
            >Parkhotel 1970</option>
            <option>Andere Unterbringung</option>
          </select>
          <small class="text-muted">Wir haben unterschiedliche Zimmer in naheliegenden Hotels reserviert - <a href="/hotels">Infos zu den Hotels</a></small>
        </fieldset>

        <?php
        
        $users_meta = get_user_meta(wp_get_current_user()->ID); 

        if ($users_meta['angehoeriger1']) { ?>
          <label for="checkbox-container">Bringst du deine Lieben mit?</label>
          <div class="form-group" id="checkbox-container">
          <div class="checkbox">
            <label>
              <input type="checkbox" 
              <?php
                if (strpos($anmeldung_daten[angehoerige][0], $users_meta['angehoeriger1'][0]) !== false) { echo 'checked'; }
              ?>
               name="angehoerige[]" value="<?php echo $users_meta['angehoeriger1'][0]; ?>">
              <?php echo $users_meta['angehoeriger1'][0]; ?>
            </label>
          </div>

        <?php
          
          if($users_meta['angehoeriger2'][0]){ ?>
            <div class="checkbox">
              <label>
                <input type="checkbox" 
                <?php
                  if (strpos($anmeldung_daten[angehoerige][0], $users_meta['angehoeriger2'][0]) !== false) { echo 'checked'; }
                ?>
                name="angehoerige[]" value="<?php echo $users_meta['angehoeriger2'][0]; ?>">
                <?php echo $users_meta['angehoeriger2'][0]; ?>
              </label>
            </div>

          <?php
          }

          if($users_meta['angehoeriger3'][0]){ ?>
            <div class="checkbox">
              <label>
                <input type="checkbox"
                <?php
                  if (strpos($anmeldung_daten[angehoerige][0], $users_meta['angehoeriger3'][0]) !== false) { echo 'checked'; }
                ?>
                name="angehoerige[]" value="<?php echo $users_meta['angehoeriger3'][0]; ?>">
                <?php echo $users_meta['angehoeriger3'][0]; ?>
              </label>
            </div>
          <?php
          }

if(isset($_POST['angehoerige'])){
  $four_checked = in_array($users_meta['angehoeriger4'][0], $_POST['angehoerige']);
}

          if($users_meta['angehoeriger4'][0]){ ?>
            <div class="checkbox">
              <label>
                <input type="checkbox" 
                <?php
                  if (strpos($anmeldung_daten[angehoerige][0], $users_meta['angehoeriger4'][0]) !== false ) { echo 'checked'; }
                  if (isset($_POST['angehoerige']) && in_array($users_meta['angehoeriger4'][0], $_POST['angehoerige'])) { echo 'checked'; }
                ?>
                name="angehoerige[]" value="<?php echo $users_meta['angehoeriger4'][0]; ?>">
                <?php echo $users_meta['angehoeriger4'][0]; ?>
              </label>
            </div>
          <?php
          }
          ?> </div>
        <?php
        }
        echo count($_POST['angehoerige']);
        if ( isset( $_POST['postContent'] ) ){ 
          $post_text = $_POST['postContent']; 
        }else{
          $post_text = $anmeldung->post_content;
        } 

        ?>
        
        <fieldset class="form-group">
            <label for="postContent"><?php _e('Willst Du uns sonst noch etwas mitteilen?', 'stroller') ?></label>
     
            <textarea name="postContent" id="postContent" class="form-control"><?php echo $post_text; ?></textarea>
        </fieldset>

        <?php if( $_POST['submitted'] ) : ?>
          <div class="alert alert-success">Deine Anmeldung wurde aktualisiert. <a href="<?php echo get_home_url(); ?>">Zurück zur Homepage</a></div>
        <?php endif; ?>
     
        <fieldset>
            <input type="hidden" name="submitted" id="submitted" value="true" />
            <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
            <button type="submit" id="submitButton" class="btn"><?php _e('Anmeldung aktualisieren', 'stroller') ?></button>
        </fieldset>
    </form>
    <?php
    }else{
      wp_redirect( home_url() ); exit;
    } ?>
      <footer class="entry-footer">
      </footer><!-- .entry-footer -->
    </article><!-- #post-## -->
  </div>
</div>