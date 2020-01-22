<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hamworks
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-102150206-5"></script>
	<script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-102150206-5');</script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrap">
	<header class="header">
		<div class="header__inner">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="header__logo"><?php the_custom_logo(); ?></h1>
			<?php else : ?>
				<div class="header__logo"><?php the_custom_logo(); ?></div>
			<?php endif; ?>

			<div class="sp-button">
				<a href="#" class="sp-button__link js-menu">
					<span class="sp-button__button">
						<span class="sp-button__icon"></span>
					</span>
				</a>
			</div><!-- /.sp-button -->

			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'header',
					'menu_id'         => 'header-nav',
					'menu_class'      => 'nav__list',
					'container'       => 'nav',
					'container_class' => 'nav',
					'fallback_cb'     => false,
				)
			);
			?>
		</div><!-- /.header__inner -->
	</header>
