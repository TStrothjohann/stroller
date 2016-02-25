<h3 id="hello" class="yes" style="display:none;" data-name="<?php echo wp_get_current_user()->user_login; ?>">Hallo <?php echo wp_get_current_user()->user_firstname; ?>,</h3>
<div class="yes lead" style="display:none;">Schön, dass Du mit uns feiern willst! Bitte fülle gleich die Anmeldung aus - Du kannst sie später über den Menüpunkt "Anmeldung" noch bearbeiten.</div>
<h3 id="schade" class="no" style="display:none;">Sehr sehr schade, <?php echo wp_get_current_user()->user_firstname; ?>!</h3>
<form action="" id="createPostForm" class="m-t" method="POST">
    <fieldset class="form-group yes" style="display:none;">
        <label for="anmeldungAdresse"><?php _e('Gib uns bitte Deine Adresse:', 'stroller') ?></label>
        <input type="text" name="anmeldungAdresse" id="anmeldungAdresse" class="form-control" placeholder="z.B. Bötzowstraße 38, 10407 Berlin">
    </fieldset>
    <fieldset class="form-group yes" style="display:none;">
      <label for="anmeldungHotel">Hast Du schon eine Hotelreservierung?</label>
      <select class="form-control" id="anmeldungHotel" name="anmeldungHotel">
        <option>Noch keine Reservierung</option>
        <option>Gasthof Ohrnbachtal</option>
        <option>Landgasthof Geiersmühle</option>
        <option>Parkhotel 1970</option>
        <option>Hotel Talblick</option>
        <option>Hotel Weyrich</option>
        <option>Andere Unterbringung</option>
      </select>
      <small class="text-muted">Wir haben unterschiedliche Zimmer in naheliegenden Hotels reserviert - <a href="/hotels">Infos zu den Hotels</a></small>
    </fieldset>

    <fieldset class="form-group yes" style="display:none;">
      <label for="anmeldungAnreise">Wann reist Du an?</label>
      <select class="form-control" id="anmeldungAnreise" name="anmeldungAnreise">
        <option>Am Freitag, 29.07</option>
        <option>Am Samstag, 30.07</option>
      </select>
      <small class="text-muted">Wir Offiziell gehts am Samstag um 14.00 Uhr los, aber einen Umtrunk und vielleicht ein Lagerfeuer gibt's schon am Freitagabend. (<a href="/ablaufplan">Ablaufplan</a>)</small>
    </fieldset>

    <?php
    
    $users_meta = get_user_meta(wp_get_current_user()->ID); 

    if ($users_meta['angehoeriger1']) { ?>
      <label for="checkbox-container" class="yes" style="display:none;">Bringst du deine Lieben mit?</label>
      <div class="form-group yes" id="checkbox-container" style="display:none;">
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
    <fieldset class="form-group yes" style="display:none;">
        <label for="anmeldungMusik"><?php _e('Zu welchem Lied versprichst Du, zu tanzen?', 'stroller') ?></label>
        <input type="text" name="anmeldungMusik" id="anmeldungMusik" class="form-control">
    </fieldset>
    <fieldset class="form-group also-no yes" style="display:none;">
        <label for="postContent"><?php _e('Willst Du uns sonst noch etwas mitteilen?', 'stroller') ?></label>
 
        <textarea name="postContent" id="postContent" class="form-control" value="<?php if ( isset( $_POST['postContent'] ) ) { echo trim($_POST['postContent']); }else{echo '';} ?>"></textarea>
    </fieldset>
 
    <fieldset>
        <input type="hidden" name="submitted" id="submitted" value="true" />
        <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
        <button type="submit" id="submitButton" class="btn yes" style="display:none;"><?php _e('Anmelden', 'stroller') ?></button>
        <button type="submit" id="submitButton" class="btn no" style="display:none;"><?php _e('Absagen', 'stroller') ?></button>
    </fieldset>
</form>

<script type="text/javascript">
  jQuery('#submitButton').on('click', function(){
    var hochzeitEvent = {};
    hochzeitEvent.user = jQuery('h3#hello').data('name');
    hochzeitEvent.action = 'anmeldung';
    trackHochzeitEvent(hochzeitEvent);
  })

  jQuery('#ja').on('click', function(){
    jQuery('.yes').show();
    jQuery('.no').hide();
    jQuery('form#createPostForm').remove('input#abmeldung');
    jQuery('html, body').animate({
        scrollTop: jQuery("#hello").offset().top
    }, 1400);
    if(jQuery('input[name=abmeldung]')){
      jQuery('input[name=abmeldung]').remove();
    }
  })
  jQuery('#nein').on('click', function(){

    jQuery('.yes').hide();
    jQuery('.also-no').show();
    jQuery('.no').show();
    jQuery('form#createPostForm').append('<input type="hidden" name="abmeldung" id="abmeldung" value="abmeldung">')
    jQuery('html, body').animate({
        scrollTop: jQuery("#schade").offset().top
    }, 1400);
  })
</script>