<form action="" id="createPostForm" method="POST" class="col-lg-8 col-lg-offset-2">
    <fieldset class="form-group">
        <label for="postTitle"><?php _e('Post Title:', 'framework') ?></label> 
        <input type="text" name="postTitle" id="postTitle" class="required form-control" placeholder="Post Title" value="<?php if ( isset( $_POST['postTitle'] ) ) echo $_POST['postTitle']; ?>"/>
    </fieldset>
    <fieldset>
        <label for="anmeldungAdresse"><?php _e('Adresse:', 'stroller') ?></label>
        <input type="text" name="anmeldungAdresse" id="anmeldungAdresse" class="form-control" placeholder="Bötzowstraße 38, 10407 Berlin">
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
 
    <fieldset class="form-group">
        <label for="postContent"><?php _e('Post Content:', 'framework') ?></label>
 
        <textarea name="postContent" id="postContent" rows="8" cols="30" class="required form-control">
        <?php 
            if ( isset( $_POST['postContent'] ) ) { 
                if ( function_exists( 'stripslashes' ) ) { 
                    echo stripslashes( $_POST['postContent'] ); 
                } else { 
                    echo $_POST['postContent']; 
                } 
            }
        ?>
        </textarea>
    </fieldset>
 
    <fieldset>
        <input type="hidden" name="submitted" id="submitted" value="true" />
        <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
        <button type="submit" class="btn"><?php _e('Add Post', 'framework') ?></button>
    </fieldset>
</form>