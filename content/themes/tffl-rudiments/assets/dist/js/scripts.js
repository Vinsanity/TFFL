/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	
	__webpack_require__(4);
	
	__webpack_require__(5);

/***/ },
/* 1 */,
/* 2 */,
/* 3 */,
/* 4 */
/***/ function(module, exports) {

	'use strict';
	
	/**
	 * navigation.js
	 *
	 * Handles toggling the navigation menu for small screens.
	 */
	
	(function setupNav() {
		var container, button, menu;
	
		container = document.getElementById('site-navigation');
		if (!container) {
			return;
		}
	
		button = container.getElementsByTagName('button')[0];
		if (typeof button === 'undefined') {
			return;
		}
	
		menu = container.getElementsByTagName('ul')[0];
	
		// Hide menu toggle button if menu is empty and return early.
		if (typeof menu === 'undefined') {
			button.style.display = 'none';
			return;
		}
	
		if (menu.className.indexOf('nav-menu') === -1) {
			menu.className += ' nav-menu';
		}
	
		button.onclick = function () {
			if (container.className.indexOf('toggled') > -1) {
				container.className = container.className.replace(' toggled', '');
			} else {
				container.className += ' toggled';
			}
		};
	})();

/***/ },
/* 5 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	
	var _jquery = __webpack_require__(6);
	
	var _jquery2 = _interopRequireDefault(_jquery);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	// Rudiments Script Example
	
	// Start your script here
	(0, _jquery2.default)(document).ready(function () {});

/***/ },
/* 6 */
/***/ function(module, exports) {

	module.exports = jQuery;

/***/ }
/******/ ]);
//# sourceMappingURL=scripts.js.map