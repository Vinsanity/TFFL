<?php
/**
 * The Header for our theme.
 *
 * @package Rudiments
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<div id="site-wrap">

	<header class="site-header" role="banner" itemtype="http://schema.org/WPHeader">
		<div class="content-wrap clearfix">

			<div class="site-branding clearfix">
				<?php // If logo. ?>
				<div id="brand-logo" itemprop="logo"></div>
				<?php // If no logo. ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div> <!-- .site-branding -->

			<nav id="primary-navigation" class="clearfix" aria-label="Primary Menu" itemscope itemtype="http://schema.org/SiteNavigationElement">
				<button class="visuallyhidden menu-toggle"><?php esc_html_e( 'Primary Menu', 'rudiments' ); ?></button>
				<?php rudiments_primary_nav_menu(); ?>
			</nav><!-- #primary-navigation -->

		</div>
	</header><!-- .site-header -->
