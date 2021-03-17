<?php
/**
*
* MantisBT Plugin: CustomFieldsToTop - Moves selected custom fields to the top of the Report Issue form and the Update Issue form.
*
* @copyright (c) 2021, LukeWCS
*
*/

form_security_validate('plugin_CustomFieldsToTop_config_update');

$custom_fields_report = gpc_get_string('custom_fields_report');
$custom_fields_update = gpc_get_string('custom_fields_update');
$show_after_move = gpc_get_int('show_after_move', 0);

$custom_fields_report = cleanup_custom_fields($custom_fields_report);
$custom_fields_update = cleanup_custom_fields($custom_fields_update);

if (plugin_config_get('custom_fields_report') !== $custom_fields_report)
{
	plugin_config_set('custom_fields_report', $custom_fields_report);
}
if (plugin_config_get('custom_fields_update') !== $custom_fields_update)
{
	plugin_config_set('custom_fields_update', $custom_fields_update);
}
if (plugin_config_get('show_after_move') !== $show_after_move )
{
	plugin_config_set('show_after_move', $show_after_move);
}

form_security_purge('plugin_CustomFieldsToTop_config_update');

print_successful_redirect(plugin_page('config', true));

function cleanup_custom_fields($fields)
{
	$fields_array = explode(',', $fields);
	$fields_array = array_filter($fields_array, function($value) {
		return (($value == 0) ? false : true);
	});
	$fields_array = array_unique($fields_array);
	return implode(',', $fields_array);
};
