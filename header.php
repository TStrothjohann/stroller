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

<body <?php body_class(); ?> >
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
  <div class="row">
      <img width="100%"src="<?php echo get_template_directory_uri() . '/images/150507_nadja-thomas.jpg'; ?>">
  </div>
	<div id="content" class="site-content">