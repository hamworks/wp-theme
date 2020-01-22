<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hamworks
 */
?>

<?php dynamic_sidebar( 'widget-resource' ); ?>

<footer class="footer">
	<div class="footer__nav">
		<div class="footer__inner">
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'footer',
					'menu_id'         => 'footer-nav',
					'menu_class'      => 'fnav__list',
					'container'       => 'div',
					'container_class' => 'fnav',
				)
			);
			?>
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'sns',
					'menu_id'         => 'sns-nav',
					'menu_class'      => 'sns__list',
					'container'       => 'div',
					'container_class' => 'sns',
				)
			);
			?>
		</div><!-- /.footer__inner -->
	</div><!-- /.footer__nav -->

	<div class="footer__bottom">
		<div class="top-back">
			<a href="#top" class="js-goto-pagetop"></a>
		</div>
		<div class="footer__inner">
			<div class="copyright"><small>© HAMWORKS Co., Ltd.</small></div>
			<div class="footer__hamrobo"><img src="<?php echo esc_attr( get_theme_file_uri( '/assets/images/hamrobo.svg' ) ); ?>" alt=""></div>
		</div><!-- /.footer__inner -->
	</div><!-- /.footer__bottom -->
</footer>

</div><!-- /.footer-area -->
</div><!-- /.wrap -->

<?php wp_footer(); ?>
</body>
</html>
