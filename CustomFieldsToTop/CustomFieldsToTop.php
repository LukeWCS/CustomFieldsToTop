<?php
/**
*
* MantisBT Plugin: CustomFieldsToTop - Moves selected custom fields to the top of the Report Issue form and the Update Issue form.
*
* @copyright (c) 2021, LukeWCS
*
*/

class CustomFieldsToTopPlugin extends MantisPlugin
{
	private $form_name = '';

	function register()
	{
		$this->name = plugin_lang_get('title');
		$this->description = plugin_lang_get('description');
		$this->page = 'config';

		$this->version = '1.0.2';
		$this->requires = array(
			'MantisCore' => '2.25.0',
		);

		$this->author = 'LukeWCS';
		$this->contact = '';
		$this->url = '';
	}

	function hooks()
	{
		return array(
			'EVENT_LAYOUT_RESOURCES'	=> 'add_css',
			'EVENT_REPORT_BUG_FORM_TOP'	=> 'set_report_flag',
			'EVENT_UPDATE_BUG_FORM_TOP'	=> 'set_update_flag',
			'EVENT_LAYOUT_BODY_END'		=> 'add_script',
		);
	}

	function config()
	{
		return array(
			'custom_fields_report'	=> '',
			'custom_fields_update'	=> '',
			'show_after_move'		=> ON,
		);
	}

	function add_css()
	{
		if (plugin_config_get('show_after_move'))
		{
			$ver_key = $this->get_file_hash('CustomFieldsToTop.css', 'CustomFieldsToTop');
			echo '	<link rel="stylesheet" type="text/css" href="' . plugin_file('CustomFieldsToTop.css') . '&' . $ver_key . '" />' . "\n";
		}
	}

	function set_report_flag()
	{
		$this->form_name = 'report';
	}

	function set_update_flag()
	{
		$this->form_name = 'update';
	}

	function add_script()
	{
		if ($this->form_name == '')
		{
			return;
		}
		$params = $this->build_script_params('CustomFieldsToTop_js', array(
			'FormName'		=> $this->form_name,
			'CustomFields'	=> plugin_config_get('custom_fields_' . $this->form_name),
			'ShowAfterMove'	=> plugin_config_get('show_after_move'),
		));
		$ver_key = $this->get_file_hash('CustomFieldsToTop.js', 'CustomFieldsToTop');
		echo '	<script type="text/javascript" src="' . plugin_file('CustomFieldsToTop.js') . '&' . $ver_key . '" ' . $params . '></script>' . "\n";
		$this->form_name = '';
	}

	function build_script_params($id, $parameter_array)
	{
		$parameters = '';
		foreach ($parameter_array as $key => $value)
		{
			$parameters .= 'data-' . $key . '="' . $value . '" ';
		}
		return 'id="' . $id . '" ' . rtrim($parameters);
	}

	function get_file_hash($file_name, $base_name)
	{
		return 'ver_key=' . md5_file(plugin_file_path($file_name, $base_name));
	}
}
