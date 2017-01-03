<?php
/**
 * The template for displaying Archive pages.
 *
 * @package Rudiments
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">
		<div class="content-wrap">
		
		<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title">
					<?php
					if ( is_category() ) :
						single_cat_title();

					elseif ( is_tag() ) :
						single_tag_title();

					elseif ( is_author() ) :
						$author = sprintf( __( 'Author: %s', 'rudiments' ),'<span class="vcard">' . get_the_author() . '</span>' );
						echo wp_kses( $author, array( 'span' => array( 'class' => array() ) ) );

					elseif ( is_day() ) :
						$day = sprintf( __( 'Day: %s', 'rudiments' ), '<span>' . get_the_date() . '</span>' );
						echo wp_kses( $day, array( 'span' => array() ) );

					elseif ( is_month() ) :
						$month = sprintf( __( 'Month: %s', 'rudiments' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'rudiments' ) ) . '</span>' );
						echo wp_kses( $month, array( 'span' => array() ) );

					elseif ( is_year() ) :
						$year = sprintf( __( 'Year: %s', 'rudiments' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'rudiments' ) ) . '</span>' );
						echo wp_kses( $year, array( 'span' => array() ) );

					elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
						esc_html_e( 'Asides', 'rudiments' );

					elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
						esc_html_e( 'Galleries', 'rudiments' );

					elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
						esc_html_e( 'Images', 'rudiments' );

					elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
						esc_html_e( 'Videos', 'rudiments' );

					elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
						esc_html_e( 'Quotes', 'rudiments' );

					elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
						esc_html_e( 'Links', 'rudiments' );

					elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
						esc_html_e( 'Statuses', 'rudiments' );

					elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
						esc_html_e( 'Audios', 'rudiments' );

					elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
						esc_html_e( 'Chats', 'rudiments' );

					else :
						esc_html_e( 'Archives', 'rudiments' );
					endif;
				?>
				</h1>
				
			</header><!-- .archive-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( '/content/loop/results' ); ?>

			<?php endwhile; ?>

			<?php rudiments_num_page_navi(); ?>

		<?php else : ?>

			<?php get_template_part( '/content/no-results' ); ?>

		<?php endif; ?>
		
		</div><!-- .content-wrap -->
	</main><!-- #main -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
