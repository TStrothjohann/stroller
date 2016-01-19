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

get_header(); ?>
 

<div class="col-xs-12">
  <h3 class="masthead-brand"><?php bloginfo( 'name' ); ?></h3>
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
<div class="row bg-img">

<div class="hero">
    <span id="cafe" role="img" aria-label="Coffee and croissant.">
            <div class="col-lg-8 col-lg-offset-2">
    <h1 class="text-xs-center" ><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    <p class="lead text-xs-center"><?php bloginfo( 'description' ); ?></p>
    <p class="lead text-xs-center">
      <a href="#" class="btn btn-lg btn-secondary">Zur Anmeldung</a>
    </p>
  </div>
        <span class="inner">
        </span>

    </span>

</div>


</div>


<?php get_footer(); ?>