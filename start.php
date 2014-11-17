<?php
/**
 * popup menu for adding new items from topbar
 * 
 */

elgg_register_event_handler('init', 'system', 'add_item_menu_init');

if (!function_exists('get_valid_types'))
{
    function get_valid_types($invalid_types) { // return object entity types in the system

        $registered_entities = get_registered_entity_types();

        $subtypes = array();
        foreach ($registered_entities['object'] as $subtype) {
            if (!in_array($subtype,$invalid_types))
                $subtypes[$subtype] = $subtype;
        }
        return $subtypes;
    }
}

function add_item_menu_init() {
    if (elgg_is_logged_in())
    {
        // extend css
        elgg_extend_view("css/elgg", "add_items_menu/css");
        // Add hidden popup module to topbar
        elgg_extend_view('page/elements/topbar', 'add_items_menu/popup');
        elgg_require_js('add_items/add_items');
        elgg_register_plugin_hook_handler('register', 'menu:topbar', 'add_items_topbar_menu_setup');
	}
}

/**
 * Add new items menu icon to topbar menu
 *
 * The menu item opens a popup module defined in view add_items_menu/popup
 *
 * @param string         $hook   Hook name
 * @param string         $type   Hook type
 * @param ElggMenuItem[] $return Array of menu items
 * @param array          $params Hook parameters
 * @return ElggMenuItem[] $return
 */
function add_items_topbar_menu_setup ($hook, $type, $return, $params) {

    $tooltip = elgg_echo("add_items_menu:menu_title");
    
    $text = '<span class="elgg-icon elgg-icon-round-plus">' . $text . '</span>';

    $item = ElggMenuItem::factory(array(
        'name' => 'add_items',
        'href' => '#add-items-popup',
        'text' => $text,
        'priority' => 1000,
        'title' => $tooltip,
        'rel' => 'popup',
        'id' => 'add-items-popup-link'
    ));

    $return[] = $item;
    return $return;    
}
