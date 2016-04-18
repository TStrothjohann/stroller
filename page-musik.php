<?php
/**
 * The template for displaying the WO pages. (it's public).
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package stroller
 */

get_header(); 
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

        <?php 

        wp_reset_postdata();

        $args = array(
            'post_type' => 'anmeldung' ,
            'post_status' => 'pending',
            'posts_per_page' => -1,
          );
        $my_query = new WP_Query( $args ); 
        if ( have_posts() ) : ?>
          <div class="col-xs-12 col-md-10">
          <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Gast</th>
              <th>Musikwünsche</th>
            </tr>
          </thead>
          <tbody>

          <?php
            $number = 1; 
            while ( $my_query->have_posts() ) : $my_query->the_post();  
          ?>

            <tr>
              <th scope="row"><?php echo $number++; ?></th>
              <td><?php the_author(); ?></td>

              <?php $musikwuensche = implode( ',', get_post_meta( $post->ID, 'anmeldung_musik' )); ?>
              <td><?php echo $musikwuensche; ?></td>
            </tr>
          <?php
          

          endwhile; ?>
          </tbody>
          </table>
          </div>
          <?php
        endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>