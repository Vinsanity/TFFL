<?php
/**
 * Rudiments theme setup.
 *
 * @package Rudiments
 */

if ( ! function_exists( 'rudiments_count_it_off' ) ) {
	/**
	 * "Can I count it off?
	 * 1, 2, 3, 4. Get on Up!"
	 *
	 * Set up theme defaults and add support for WordPress features.
	 */
	function rudiments_count_it_off() {

		// Clean out the HEAD.
		add_action( 'init', 'rudiments_clear_head' );

		// Enqueue base scripts and styles.
		add_action( 'wp_enqueue_scripts', 'rudiments_styles_and_scripts', 999 );

		// Adding theme support.
		rudiments_theme_support();

		// Rudiments sidebars.
		add_action( 'widgets_init', 'rudiments_register_sidebars' );

		// Rudiments Nav Menus (uses wp_nav_menu).
		rudiments_register_nav_menus();

		// adding the rudiments search form (created in functions.php)
		// add_filter( 'get_search_form', 'rudiments_search' );

		// Destroy <p> tags around images in the the_content().
		add_filter( 'the_content', 'rudiments_destroy_ptags_on_images' );

		// Custom excerpt_more.
		add_filter( 'excerpt_more', 'rudiments_excerpt_more' );

	}

	add_action( 'after_setup_theme', 'rudiments_count_it_off' );
}


if ( ! function_exists( 'rudiments_clear_head' ) ) {
	/**
	 * The best maid service in the biz. Bones head cleanup.
	 */
	function rudiments_clear_head() {
		// Category feeds.
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		// Post and comment feeds.
		remove_action( 'wp_head', 'feed_links', 2 );
		// EditURI link.
		remove_action( 'wp_head', 'rsd_link' );
		// Windows live writer.
		remove_action( 'wp_head', 'wlwmanifest_link' );
		// Index link.
		remove_action( 'wp_head', 'index_rel_link' );
		// Previous link.
		remove_action( 'wp_head', 'parent_post_rel_link', 10 );
		// Start link.
		remove_action( 'wp_head', 'start_post_rel_link', 10 );
		// Links for adjacent posts.
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
		// WP version.
		remove_action( 'wp_head', 'wp_generator' );
	}
}


if ( ! function_exists( 'rudiments_styles_and_scripts' ) ) {
	/**
	 * Register and Enqueue Rudiments Stylesheets and Scripts
	 */
	function rudiments_styles_and_scripts() {
		if ( ! is_admin() ) {

			$css_dir = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/dist/css/';
			$js_dir = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/dist/js/';
			$version = rudiments_get_version();

			/**
			 * Styles
			 */
			// Rudiments master stylesheet.
			wp_register_style( 'rudiments-stylesheet', $css_dir . 'master.css', array(), $version, 'all' );

			/**
			 * Scripts
			 */
			// Modernizr (without media query polyfill and printshiv).
			wp_register_script( 'rudiments-polyfills', $js_dir . 'polyfills.js', array(), $version, false );
			// Rudiments custom scripts.
			wp_register_script( 'rudiments-js', $js_dir . 'scripts.js', array( 'jquery' ), $version, true );
			// Comment reply script.
			if ( is_singular() && comments_open() && ( get_option( 'thread_comments' ) === 1 ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			/**
			 * Enqueue styles and scripts.
			 */
			// Header styles and scripts.
			wp_enqueue_script( 'rudiments-polyfills' );
			wp_enqueue_style( 'rudiments-stylesheet' );

			// Footer Scripts (the lat parameter in wp_register_script needs to be set to true).
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'rudiments-js' );

		}
	}
}

if ( ! function_exists( 'rudiments_theme_support' ) ) {
	/**
	 * Theme support
	 */
	function rudiments_theme_support() {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /assets/dist/lang/ directory.
		 */
		load_theme_textdomain( 'rudiments', get_template_directory() . '/assets/dist/lang' );

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable support for Post Formats.
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
		 * Enable support for HTML5 markup.
		 */
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

		/**
		 * Enable title tag.
		 */
		add_theme_support( 'title-tag' );
	}
}

if ( ! function_exists( 'rudiments_pingback_header' ) ) {
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function rudiments_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}

	add_action( 'wp_head', 'rudiments_pingback_header' );
}

if ( ! function_exists( 'rudiments_register_sidebars' ) ) {
	/**
	 * Register Rudiments sidebar(s).
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	function rudiments_register_sidebars() {

		register_sidebar( array(
			'id' => 'primary-sidebar',
			'name' => __( 'Primary Sidebar', 'rudiments' ),
			'description' => __( 'Primary Sidebar', 'rudiments' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

	}
}


if ( ! function_exists( 'rudiments_register_nav_menus' ) ) {
	/**
	 * Register Rudiments Nav Menus.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
	 */
	function rudiments_register_nav_menus() {

		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'rudiments' ),
			'footer' => __( 'Footer Menu', 'rudiments' ),
		) );

	}
}

/**
 * Build Rudiments Nav Menus
 */

if ( ! function_exists( 'rudiments_primary_nav_menu' ) ) {
	/**
	 * Primary Nav Menu
	 */
	function rudiments_primary_nav_menu() {
		wp_nav_menu(array(
			'container' => false,
			'container_class' => 'menu clearfix',
			'menu' => __( 'Primary Menu', 'rudiments' ),
			'menu_class' => 'nav primary-nav clearfix',
			'theme_location' => 'primary',
			'before' => '',
			'after' => '',
			'link_before' => '',
			'link_after' => '',
			'depth' => 0,
			'fallback_cb' => 'rudiments_primary_nav_fallback',
		));
	}
}

if ( ! function_exists( 'rudiments_footer_nav_menu' ) ) {
	/**
	 * Footer Nav Menu
	 */
	function rudiments_footer_nav_menu() {
		wp_nav_menu(array(
			'container' => '',
			'container_class' => 'menu clearfix',
			'menu' => __( 'Footer Menu', 'rudiments' ),
			'menu_class' => 'nav footer-nav clearfix',
			'theme_location' => 'footer',
			'before' => '',
			'after' => '',
			'link_before' => '',
			'link_after' => '',
			'depth' => 0,
		));
	}
}

if ( ! function_exists( 'rudiments_primary_nav_fallback' ) ) {
	/**
	 * Fallback for Primary Nav Menu
	 */
	function rudiments_primary_nav_fallback() {
		wp_page_menu( array(
			'show_home'  => true,
			'menu_class' => 'nav primary-nav clearfix',
			'echo'       => true,
		) );
	}
}


// /**
//  * Rudiments Search From
//  */
// if ( ! function_exists( 'rudiments_search' ) ) {
// 	function rudiments_search($searchform) {
// 		global $searchform;
// 		get_template_part( '/content/search/searchform' );
// 		return $searchform;
// 	}
// }

/**
 * Additional Cleanup Items
 */

if ( ! function_exists( 'rudiments_destroy_ptags_on_images' ) ) {
	/**
	 * Remove the <p> tags from around images in the_content()
	 * http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
	 *
	 * @param string $content Content of the current post.
	 *
	 * @return mixed
	 */
	function rudiments_destroy_ptags_on_images( $content ) {
		return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	}
}

if ( ! function_exists( 'rudiments_excerpt_more' ) ) {
	/**
	 * Custom More Excerpt
	 *
	 * @param string $more Default Read More excerpt link.
	 *
	 * @return string
	 */
	function rudiments_excerpt_more( $more ) {
		global $post;
		return '&hellip;  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read', 'rudiments' ) . get_the_title( $post->ID ).'">'. __( 'Read more &raquo;', 'rudiments' ) .'</a>';
	}
}

if ( ! function_exists( 'rudiments_author_posts_link' ) ) {
	/**
	 * This is a modified the_author_posts_link() which just returns the link.
	 * This is necessary to allow usage of the usual l10n process with printf().
	 *
	 * @return bool|string
	 */
	function rudiments_author_posts_link() {
		global $authordata;

		if ( ! is_object( $authordata ) ) {
			return false;
		}

		$link = sprintf(
			'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
			get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
			esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one.
			get_the_author()
		);

		return $link;
	}
}


if ( ! function_exists( 'rudiments_get_version' ) ) {
	/**
	 * Gets the current site version.
	 *
	 * This grabs the latest Git hash and turns it into the version number.
	 * If not, it uses the give default.
	 *
	 * @return string
	 */
	function rudiments_get_version() {

		$version = wp_cache_get( 'rudiments_version' );

		if ( empty( $version ) ) {
			$git = new QuickGit();
			$version = $git->version();
			wp_cache_set( 'rudiments_version', $version );
		}

		if ( empty( $version ) || ! isset( $version ) ) {
			$version = '0.1';
		}

		return $version;
	}
}


if ( ! function_exists( 'console_log' ) ) {
	/**
	 * Helper function to output data or objects into the browser.
	 *
	 * @param  object $data data object to diaplay.
	 * @return void
	 */
	function console_log( $data ) {
		if ( is_array( $data ) ) {
			$output = "<script>console.log( 'PHP: " . implode( ',', $data ) . "' );</script>";
		} else {
			$output = "<script>console.log( 'PHP: " . $data . "' );</script>";
		}

		echo $output;
	}
}


/**
 * Class to get the current git hash commit number.
 */
class QuickGit {
	/**
	 * Version
	 *
	 * @var integer Version
	 */
	private $version;

	/**
	 * QuickGit constructor.
	 */
	function __construct() {
	    $to = WP_CONTENT_DIR . '/../../../repo';
	    $cwd = ENVIRONMENT === 'PRODUCTION' ? ('cd ' . $to . ' && ') : '';
		exec( $cwd . 'git describe --always', $version_mini_hash );
		exec( $cwd . 'git rev-list HEAD | wc -l', $version_number );
		exec( $cwd . 'git log -1', $line );
		$this->version['short'] = 'v1.' . trim( $version_number[0] ) . '.' . $version_mini_hash[0];
		$this->version['full'] = 'v1.' . trim( $version_number[0] ) . ".$version_mini_hash[0] (".str_replace( 'commit ','',$line[0] ) . ')';
	}

	/**
	 * Return version.
	 *
	 * @return int
	 */
	public function output() {
		return $this->version;
	}

	/**
	 * Return short version number.
	 *
	 * @return mixed
	 */
	public function version() {
		return $this->version['short'];
	}

	/**
	 * Output version.
	 */
	public function show() {
		echo esc_html( $this->version );
	}
}
