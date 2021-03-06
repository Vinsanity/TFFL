<?php
/**
 * The template for displaying the footer.
 *
 * @package Rudiments
 */

?>

	<footer class="site-footer" itemscope role="contentinfo">
		<div class="content-wrap">

			<nav class="footer-nav">
				<?php rudiments_footer_nav_menu(); ?>
			</nav>

			<div class="site-colophon">
				<span class="copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <span itemprop="name"><?php bloginfo( 'name' ); ?></span></span>
			</div><!-- .site-info -->

		</div><!-- .content-wrap -->
	</footer>

</div><!-- #site-wrap -->

<?php wp_footer(); ?>

</body>
</html>
