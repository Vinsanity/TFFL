/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */

(function setupNav() {
	var container, button, menu

	container = document.getElementById('site-navigation')
	if (!container) {
		return
	}

	button = container.getElementsByTagName('button')[0]
	if (typeof button === 'undefined') {
		return
	}

	menu = container.getElementsByTagName('ul')[0]

	// Hide menu toggle button if menu is empty and return early.
	if (typeof menu === 'undefined') {
		button.style.display = 'none'
		return
	}

	if (menu.className.indexOf('nav-menu') === -1) {
		menu.className += ' nav-menu'
	}

	button.onclick = function() {
		if (container.className.indexOf('toggled') > -1) {
			container.className = container.className.replace(' toggled', '')
		} else {
			container.className += ' toggled'
		}
	}
})()