<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package Rudiments
 */

?>

<section class="no-results">
	<div class="content-wrap">
		
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'rudiments' ); ?></h1>

		<div class="page-content">
			
			<?php if ( is_search() ) : ?>

				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'rudiments' ); ?></p>

			<?php else : ?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'rudiments' ); ?></p>

			<?php endif; ?>
		</div><!-- .page-content -->

	</div><!-- .content-wrap -->
</section><!-- .no-results -->
