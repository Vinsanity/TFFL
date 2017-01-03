<?php
/**
 * Theme based admin functions.
 * This will eventually be turned into an MU plugin.
 *
 * @package Rudiments
 */

/**
 * DASHBOARD WIDGETS
 */

if ( ! function_exists( 'disable_default_dashboard_widgets' ) ) {
	/**
	 * Disable default dashboard widgets
	 */
	function disable_default_dashboard_widgets() {
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );
	}

	add_action( 'admin_menu', 'disable_default_dashboard_widgets' );
}


/**
 * 3five Example Widget
 */
function threefive_example_widget() {
	return;
}

/**
 * Adding any custom widgets
 */
function rudiments_custom_dashboard() {
	// wp_add_dashboard_widget('threefive_example_widget', '3five Example Widget', 'threefive_example_widget');
}

//add_action( 'wp_dashboard_setup', 'rudiments_custom_dashboard' );

if ( ! function_exists( 'rudiments_login_css' ) ) {
	/**
	 * Custom login page
	 */
	function rudiments_login_css() {
		$version = rudiments_get_version();
		wp_enqueue_style( 'rudiments_login_css', get_template_directory_uri() . '/css/wp-admin/login.css', array(),  $version, false );
	}

	add_action( 'login_enqueue_scripts', 'rudiments_login_css', 10 );
}

if ( ! function_exists( 'rudiments_login_url' ) ) {
	/**
	 * Changing the logo link from wordpress.org to your site
	 *
	 * @return string|void
	 */
	function rudiments_login_url() {
		return home_url();
	}

	add_filter( 'login_headerurl', 'rudiments_login_url' );
}

if ( ! function_exists( 'rudiments_login_title' ) ) {
	/**
	 * Changing the alt text on the logo to show your site name
	 *
	 * @return mixed|void
	 */
	function rudiments_login_title() {
		return get_option( 'blogname' );
	}

	add_filter( 'login_headertitle', 'rudiments_login_title' );
}

/**
 * CUSTOMIZE ADMIN
 */

if ( ! function_exists( 'rudiments_remove_menu_items' ) ) {
	/**
	 * Custom Admin Menu settings
	 * Remove Menu Items For All Non-Admin Users
	 */
	function rudiments_remove_menu_items() {
		if ( ! current_user_can( 'manage_options' ) ) {
			// Removing Menu Items for all.
			remove_menu_page( 'edit-comments.php' ); // Remove the Tools Menu.
			remove_menu_page( 'theme-global-settings' ); // Remove the Theme Options Menu.
			remove_menu_page( 'tools.php' ); // Remove the Tools Menu.
			remove_menu_page( 'edit.php?post_type=acf-field-group' ); // Remove the ACF Menu.
		}
	}

	add_action( 'admin_menu', 'rudiments_remove_menu_items', 99 );
}

if ( ! function_exists( 'rudiments_edit_admin_menus' ) ) {
	/**
	 * Rename Menu items
	 */
	function rudiments_edit_admin_menus() {
		global $menu;
		global $submenu;
		// Returned Array Keys
		// Array ( [0] => Posts [1] => edit_posts [2] => edit.php [3] => [4] => open-if-no-js menu-top menu-icon-post [5] => menu-posts [6] => none )
		// [0] = Label
		// [1] = Menu Slug
		// [2] = Menu Page (use this to hide a page)
		// [3] = ??
		// [4] = Menu Item Class
		// [5] = Menu Item ID
		// [6] = Custom Icon URL

		// Example Usage:
		// $menu[5][0] = 'Recipes'; // Change Posts to Recipes
		// $submenu['edit.php'][5][0] = 'All Recipes';
	}

	add_action( 'admin_menu', 'rudiments_edit_admin_menus' );
}

if ( ! function_exists( 'rudiments_custom_menu_order' ) ) {
	/**
	 * Reorder Menu items
	 *
	 * @param array $menu_ord An ordered array of menu items.
	 *
	 * @return array|bool
	 */
	function rudiments_custom_menu_order( $menu_ord ) {
		if ( ! $menu_ord ) {
			return true;
		}

		return array(
			// Uncomment these options to rearrange the menu order to your liking.
			// 'index.php', // Dashboard
			// 'separator1', // First separator
			// 'edit.php', // News and Events (posts)
			// 'edit.php?post_type=page', // Pages
			// 'edit.php?post_type=cirrus_aircraft', // Custom Post Type Example
			// 'theme-global-settings', // ACF Options Page Example
			// 'upload.php', // Media
			// 'separator2', // Second separator
		);
	}

	add_filter( 'custom_menu_order', 'rudiments_custom_menu_order' );
	add_filter( 'menu_order', 'rudiments_custom_menu_order' );
}

if ( ! function_exists( 'rudiments_admin_footer' ) ) {
	/**
	 * Customized Footer Message
	 */
	function rudiments_admin_footer() {
		$thankyou_message = sprintf( __( '<span id="footer-thankyou">Developed by <a href="%s" target="%s">3five, Inc</a></span>.' , 'rudiments' ),
			'http://3five.com',
			'_blank'
		);

		echo wp_kses( $thankyou_message, array(
			'span' => array( 'id' => array() ),
			'a' => array( 'href' => array(), 'target' => array() ),
		) );
	}

	add_filter( 'admin_footer_text', 'rudiments_admin_footer' );
}

