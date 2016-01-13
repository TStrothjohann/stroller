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

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<div id="page" class="container">

	<header  class="row" role="banner">

		<div class="col-xs-12">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>

		<nav class="navbar navbar-dark bg-primary col-xs-12" role="navigation">
		  <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#stroller-menu">
		    &#9776;
		  </button>
		  <a class="navbar-brand" href="#">stroller</a>
		  <div id="stroller-menu">
		  	<?php wp_nav_menu( array( 
		  														'theme_location' => 'primary', 
		  														'menu_id' => 'primary-menu',
		  														'container_class' => 'nav navbar-nav' 

		  													) ); ?>
		  </div>
		</nav>
	</header>

	<div id="content" class="site-content">
