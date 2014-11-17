<?php

$title = elgg_echo('add_items_menu');
$header = "<h3 class=\"float\">$title</h3>";

$body = '';

$viewer_guid = elgg_get_logged_in_user_guid();
$add_items_menu_array = get_valid_types(array('thewire','page', 'comment', 'hjcategory', 'hjwall', 'videoconference', 'groupforumtopic', 'image'));
if ($add_items_menu_array)
{
    asort($add_items_menu_array);
        
    //create HTML code out of array
    $body = '<ul class="topbar-elgg-add-items-list elgg-list">';
    foreach ($add_items_menu_array as $entity_type) {
        switch ($entity_type){
            case  'au_set': $entity_type = 'pinboards';  $add_new_url = $entity_type . '/add/'; break;
            case  'event': $entity_type = 'events'; $add_new_url = 'events/event/new/'; break;
            case  'album': $entity_type = 'photos'; $add_new_url = $entity_type . '/add/'; break;
            case  'videolist_item': $entity_type = 'videos'; $add_new_url = $entity_type . '/add/'; break;
            case  'page_top': $entity_type = 'pages';  $add_new_url = $entity_type . '/add/'; break;
            case  'groupforumtopic': $entity_type = 'discussion';  $add_new_url = $entity_type . '/new/'; break;
            default: $add_new_url = $entity_type . '/add/'; break;
        }
        $body .= '<li onClick="window.location.href=\''. $elgg_path . $add_new_url . $viewer_guid .'\';">'.elgg_view('output/url', array(
            'href' => $elgg_path . $add_new_url . $viewer_guid,
            'text' => elgg_echo('add_items_menu:' . $entity_type),
            'is_trusted' => true,)
            ).'</a></li>';
    }   
    $body .= '</ul>';
}    
else {
	$body = elgg_echo('add_items_menu:none');
}
$vars = array(
    'class' => 'elgg-add-items-popup hidden',
    'id' => 'add-items-popup',
    'header' => $header
);

echo elgg_view_module('popup', '', $body, $vars);
