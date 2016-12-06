<?php
/**
 * The Foto page template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package stroller
 */
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
<?php }  else {

    ?>

    <style type="text/css">
        .grid-item { margin-bottom: 0.5em; }
        .grid-img { width: 100%;}
        .modal-dialog {margin: 0; width: 100%;}
    </style>
    <?php
    while ( have_posts() ) : the_post();
        if ( get_post_gallery() ) :
            
            $gallery = get_post_gallery( get_the_ID(), false );
            $gallery_ids = explode(',', $gallery['ids']);
            
            $full_size_links = array();

            foreach( $gallery_ids  as $id ) {
                $large_image = wp_get_attachment_image_src( $id, 'large' );
                array_push($full_size_links, $large_image[0]);
            }

            echo '<div class="grid row">';
            foreach( $gallery['src'] as $key => $src ) : ?>
                <div class="grid-item col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <img src="<?php echo $src; ?>" class="grid-img" data-large-img="<?php echo $full_size_links[$key]; ?>" alt="Gallery image" />
                </div>
                <?php
            endforeach;
            echo '</div>';
        endif;
    endwhile;
?>


<!-- Modal -->
<div class="modal fade" id="gallery-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

      <div class="row">
        <div class="col-xs-12 col-lg-10 col-lg-offset-1 text-xs-center">
            <img src="">
        </div>
      </div>

  </div>
</div>

    <script type="text/javascript">

        jQuery('document').ready(function(){
            var grid = jQuery('.grid').masonry({});

            grid.imagesLoaded( function() {
              grid.masonry('layout');
            });

            jQuery('.grid img').on('click', function(event){
                var imageClicked = jQuery(event.target);
                var imageClickedLarge = imageClicked.data('large-img');
                var galleryModal = jQuery('#gallery-modal');
                
                galleryModal.find('img').attr('src', imageClickedLarge);
                galleryModal.modal();

            })
        })



    </script>

<?php } ?>
<?php get_footer(); ?>