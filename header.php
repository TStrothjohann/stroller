<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package stroller
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link rel="icon" href="<?php echo get_template_directory_uri() . '/images/heart-outline.png'; ?>" type="image/png">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target="#mainnav" data-offset="0" >
<!-- Tracking -->
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-24050314-1', 'auto', 'hochzeitTracker');
  ga('send', 'pageview');


  function trackHochzeitEvent(event) {
    var gaEvent = {};
    var hochzeitTracker;
    
    if(typeof ga !== "undefined"){
      hochzeitTracker  = ga.getByName('hochzeitTracker');
    }
    
    if(!hochzeitTracker){
      ga('create', 'UA-24050314-1', 'auto', 'hochzeitTracker');
    }
    
    gaEvent.hitType = 'event';
    gaEvent.eventCategory = 'hochzeit';
    gaEvent.eventAction = event.action;
    gaEvent.eventLabel = event.user;
    ga('hochzeitTracker.send', gaEvent);
  }

</script>
<!-- End of Tracking -->
<div id="page" class="container-fluid">
  <div class="row">
    <div id="logo" class="text-xs-center">
      <a href="<?php echo get_home_url(); ?>">
        <h3 class="name left">Nadja</h3>
        <span class="and">&amp;</span>
        <h3 class="name right">Thomas</h3>
      </a>
    </div>
  </div>
  <?php if( is_home() ){ ?>
  <div class="row" id="top-img">
      <img width="100%"src="<?php echo get_template_directory_uri() . '/images/150507_nadja-thomas.jpg'; ?>">
  </div>
  <?php } 
  if( is_user_logged_in() ){ ?>
    <div class="row m-b">
    <?php 
        $menu_name = 'primary';
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
          $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
          $menu_items = wp_get_nav_menu_items($menu->term_id);
          $menu_list = '<nav id="mainnav" class="navbar navbar-full nav-inline" role="navigation"><div class="container"><ul>';

          foreach ( (array) $menu_items as $key => $menu_item ) {
              $title = $menu_item->title;
              $url = $menu_item->url;
              $menu_list .= '<li><a class="nav-link" href="' . $url . '">' . $title . '</a></li>';
          }
          $menu_list .= '<li><a class="nav-link" href="' . wp_logout_url( home_url() ) . '">Logout</a></li>';
          $menu_list .= '</ul></div></nav>';
        } else {
          $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
        }

        echo $menu_list;
    ?>
    </div>
  <?php 
  }

  ?>