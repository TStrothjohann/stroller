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
  update_post_meta($anmeldung_id, "anmeldung_anreise", wp_strip_all_tags($_POST['anmeldungAnreise']));
  update_post_meta($anmeldung_id, "anmeldung_musik", wp_strip_all_tags($_POST['anmeldungMusik']));
  }
$anmeldung_daten = get_post_meta($anmeldung_id);
$anmeldung = get_post($anmeldung_id);
//Form
  ?>
<div class="row">
  <div class="col-xs-12 col-lg-8 col-lg-offset-2">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
    <article>
      <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
      </header><!-- .entry-header -->
      <div class="entry-content">
        <?php the_content(); ?>
      </div><!-- .entry-content -->
      <?php endwhile; endif; ?>
      <!-- Formular -->
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
                if (strpos($anmeldung_daten[anmeldung_hotel][0], 'Landgasthof Geiersmühle') !== false) { echo 'selected'; }
              ?>
            >Landgasthof Geiersmühle</option>
            <option
              <?php
                if (strpos($anmeldung_daten[anmeldung_hotel][0], 'Parkhotel 1970') !== false) { echo 'selected'; }
              ?>
            >Parkhotel 1970</option>
            <option
              <?php
                if (strpos($anmeldung_daten[anmeldung_hotel][0], 'Hotel Talblick') !== false) { echo 'selected'; }
              ?>
            >Hotel Talblick</option>
                        <option
              <?php
                if (strpos($anmeldung_daten[anmeldung_hotel][0], 'Hotel Weyrich') !== false) { echo 'selected'; }
              ?>
            >Hotel Weyrich</option>
                        <option
              <?php
                if (strpos($anmeldung_daten[anmeldung_hotel][0], 'Andere Unterbringung') !== false) { echo 'selected'; }
              ?>
            >Andere Unterbringung</option>
          </select>
          <small class="text-muted">Wir haben unterschiedliche Zimmer in naheliegenden Hotels reserviert - <a href="/hotels">Infos zu den Hotels</a></small>
        </fieldset>
        
        <!-- Anmeldungs-Adresse -->

        <fieldset class="form-group">
          <label for="anmeldungAnreise">Wann willst Du anreisen?</label>
          <select class="form-control" id="anmeldungAnreise" name="anmeldungAnreise">
            <option
              <?php
                if (strpos($anmeldung_daten[anmeldung_anreise][0], 'Am Freitag, 29.07') !== false) { echo 'selected'; }
              ?>
            >Am Freitag, 29.07
            </option>
            <option
              <?php
                if (strpos($anmeldung_daten[anmeldung_anreise][0], 'Am Samstag, 30.07') !== false) { echo 'selected'; }
              ?>
            >Am Samstag, 30.07
            </option>
          </select>
        </fieldset>

        <!-- Check for Angehörige -->
        <?php 
        $users_meta = get_user_meta(wp_get_current_user()->ID);
        if (strpos($anmeldung_daten[angehoerige][0], $users_meta['angehoeriger4'][0]) !== false ) {
         $four_checked = 'checked';
        }elseif(isset($_POST['angehoerige']) && in_array($users_meta['angehoeriger4'][0], $_POST['angehoerige'])){
          $four_checked = 'checked';
        }else{
          $four_checked = '';
        }
        if (strpos($anmeldung_daten[angehoerige][0], $users_meta['angehoeriger3'][0]) !== false ) {
         $three_checked = 'checked';
        }elseif(isset($_POST['angehoerige']) && in_array($users_meta['angehoeriger3'][0], $_POST['angehoerige'])){
          $three_checked = 'checked';
        }else{
          $three_checked = '';
        }
        if (strpos($anmeldung_daten[angehoerige][0], $users_meta['angehoeriger2'][0]) !== false ) {
         $two_checked = 'checked';
        }elseif(isset($_POST['angehoerige']) && in_array($users_meta['angehoeriger2'][0], $_POST['angehoerige'])){
          $two_checked = 'checked';
        }else{
          $two_checked = '';
        }
        if (strpos($anmeldung_daten[angehoerige][0], $users_meta['angehoeriger1'][0]) !== false ) {
         $one_checked = 'checked';
        }elseif(isset($_POST['angehoerige']) && in_array($users_meta['angehoeriger1'][0], $_POST['angehoerige'])){
          $one_checked = 'checked';
        }else{
          $one_checked = '';
        } 
        ?>

        <!-- Choose Angehörige -->
        <?php
        if ($users_meta['angehoeriger1']) { ?>
          <label for="checkbox-container">Bringst du deine Lieben mit?</label>
          <div class="form-group" id="checkbox-container">
          <div class="checkbox">
            <label>
              <input type="checkbox" 
              <?php
                echo $one_checked;
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
                  echo $two_checked;
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
                  echo $three_checked;
                ?>
                name="angehoerige[]" value="<?php echo $users_meta['angehoeriger3'][0]; ?>">
                <?php echo $users_meta['angehoeriger3'][0]; ?>
              </label>
            </div>
          <?php 
          }
          if($users_meta['angehoeriger4'][0]){ ?>
            <div class="checkbox">
              <label>
                <input type="checkbox" 
                <?php echo $four_checked; ?>
                name="angehoerige[]" value="<?php echo $users_meta['angehoeriger4'][0]; ?>">
                <?php echo $users_meta['angehoeriger4'][0]; ?>
              </label>
            </div>
          <?php
          }
          ?> </div>
        <?php
        }
        ?>

        <!-- Musikwunsch -->

        <fieldset class="form-group">
            <label for="anmeldungMusik"><?php _e('Zu welchem Lied versprichst Du, zu tanzen?', 'stroller') ?></label>
            <input type="text" name="anmeldungMusik" id="anmeldungMusik" class="form-control">
            <small>Du kannst mehrere und immer wieder weitere Lieder eingeben.</small>
        </fieldset>

        <!-- Zusatz-Text -->        

        <?php
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

        <!-- Infofenster für erfolgreiche Aktualisierung -->
        <?php if( $_POST['submitted'] ) : ?>
          <div class="alert alert-success">Deine Anmeldung wurde aktualisiert. Evtl. musst Du die <a onclick="location.reload();">Seite einmal neu laden</a>. <a href="<?php echo get_home_url(); ?>">Zurück zur Homepage</a>.</div>
        <?php endif; ?>

        <!-- Submit Button -->
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