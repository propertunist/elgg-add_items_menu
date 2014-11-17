// <script>

/**
 * Javascript for the add_items_menu plugin
 */
define(function(require) {
	var $ = require('jquery');
	var elgg = require('elgg');

	/**
	 * Repositions the add items menu popup
	 *
	 * @param {String} hook    'getOptions'
	 * @param {String} type    'ui.popup'
	 * @param {Object} params  An array of info about the target and source.
	 * @param {Object} options Options to pass to
	 *
	 * @return {Object}
	 */
	var popupAddItemsMenuHandler = function(hook, type, params, options) {
		if (params.target.hasClass('elgg-add-items-popup')) {
			options.my = 'left top';
			options.at = 'left bottom';
			options.collision = 'fit none';
			return options;
		}
		return;
	};

	elgg.register_hook_handler('getOptions', 'ui.popup', popupAddItemsMenuHandler);
});
