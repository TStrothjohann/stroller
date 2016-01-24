<form action="" id="createPostForm" method="POST">
 
    <fieldset>
        <label for="postTitle"><?php _e('Post Title:', 'framework') ?></label>
        
        <input type="text" name="postTitle" id="postTitle" class="required" value="<?php if ( isset( $_POST['postTitle'] ) ) echo $_POST['postTitle']; ?>"/>
    </fieldset>
 
    <fieldset>
        <label for="postContent"><?php _e('Post Content:', 'framework') ?></label>
 
        <textarea name="postContent" id="postContent" rows="8" cols="30" class="required">
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
        <button type="submit"><?php _e('Add Post', 'framework') ?></button>
    </fieldset>
 
</form>