<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ThemeCom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'themecom' ); ?></a>

	<header id="masthead" class="site-header">
	
			<div class="upper-nav">
				<div class="container">
					<div class="header-social col-lg-6 col-md-6 col-sm-4 col-xs-12">
						<a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-tumblr-square" aria-hidden="true"></i></a>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
						<?php
						wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						) );
						?>
					</div>
				</div><!-- .container -->
			</div><!-- .upper-nav -->
			
			<div class="site-branding">
				<div class="container">
					<div class="logo col-lg-3 col-md-3 col-sm-2 col-xs-12">
						<a href="<?php bloginfo('url') ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg">
						</a>
					</div>
						<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
							<?php	get_product_search_form() ?>
						</div> <!-- .advance-product-search -->
					<div class="site-social col-lg-2 col-md-2 col-sm-3 col-xs-12">
						<a href="#"><i class="fa fa-user-o" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-check" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-key" aria-hidden="true"></i></a>
					</div>
				</div><!-- .container -->
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<i class="fa fa-bars"></i>
				</button>
				
			</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
