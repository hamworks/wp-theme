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
			<p class="bnr-hokkaido-style"><a href="/hokkaido-style/"><span>「新北海道スタイル」安心宣言</span></a></p>
		</div>
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
<script type="text/javascript" id="zsiqchat">var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "fbb38ce02b406584972a76daef8cee7a88840b32fa1fff45d7e8c74afef75595", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>
</body>
</html>
