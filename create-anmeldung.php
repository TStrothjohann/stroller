<h3 id="hello" class="col-xs-12 text-xs-center" data-name="<?php echo wp_get_current_user()->user_login; ?>">Hallo <?php echo wp_get_current_user()->user_firstname; ?></h3>
<form action="" id="createPostForm" method="POST" class="col-xs-12 col-lg-8 col-lg-offset-2">
    <fieldset class="form-group">
        <label for="anmeldungAdresse"><?php _e('Adresse:', 'stroller') ?></label>
        <input type="text" name="anmeldungAdresse" id="anmeldungAdresse" class="form-control" placeholder="z.B. Bötzowstraße 38, 10407 Berlin">
    </fieldset>
    <fieldset class="form-group">
      <label for="anmeldungHotel">Hast Du schon eine Hotelreservierung?</label>
      <select class="form-control" id="anmeldungHotel" name="anmeldungHotel">
        <option>Noch keine Reservierung</option>
        <option>Gasthof Ohrnbachtal</option>
        <option>Geiersmühle</option>
        <option>Parkhotel 1970</option>
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
          <input type="checkbox" name="angehoerige[]" value="<?php echo $users_meta['angehoeriger1'][0]; ?>">
          <?php echo $users_meta['angehoeriger1'][0]; ?>
        </label>
      </div>

    <?php
      
      if($users_meta['angehoeriger2'][0]){ ?>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="angehoerige[]" value="<?php echo $users_meta['angehoeriger2'][0]; ?>">
            <?php echo $users_meta['angehoeriger2'][0]; ?>
          </label>
        </div>

      <?php
      }

      if($users_meta['angehoeriger3'][0]){ ?>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="angehoerige[]" value="<?php echo $users_meta['angehoeriger3'][0]; ?>">
            <?php echo $users_meta['angehoeriger3'][0]; ?>
          </label>
        </div>
      <?php
      }

      if($users_meta['angehoeriger4'][0]){ ?>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="angehoerige[]" value="<?php echo $users_meta['angehoeriger4'][0]; ?>">
            <?php echo $users_meta['angehoeriger4'][0]; ?>
          </label>
        </div>
      <?php
      }
      ?> </div>
    <?php
    }
    ?>
 
    <fieldset class="form-group">
        <label for="postContent"><?php _e('Willst Du uns sonst noch etwas mitteilen? Hast Du Fragen?', 'stroller') ?></label>
 
        <textarea name="postContent" id="postContent" class="required form-control" value="
        <?php 
            if ( isset( $_POST['postContent'] ) ) { echo $_POST['postContent']; } 
        ?>">
        </textarea>
    </fieldset>
 
    <fieldset>
        <input type="hidden" name="submitted" id="submitted" value="true" />
        <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
        <button type="submit" id="submitButton" class="btn"><?php _e('Anmelden', 'stroller') ?></button>
    </fieldset>
</form>

<script type="text/javascript">
  jQuery('#submitButton').on('click', function(){
    var hochzeitEvent = {};
    hochzeitEvent.user = jQuery('h3#hello').data('name');
    hochzeitEvent.action = 'anmeldung';
    trackHochzeitEvent(hochzeitEvent);
  })
</script>