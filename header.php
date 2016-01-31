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
  <div class="row" id="top-img">
      <img width="100%"src="<?php echo get_template_directory_uri() . '/images/150507_nadja-thomas.jpg'; ?>">
  </div>