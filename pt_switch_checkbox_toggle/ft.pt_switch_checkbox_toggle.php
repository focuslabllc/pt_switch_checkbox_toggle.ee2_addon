<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * P&T Switch: Checkbox Toggle
 * 
 * This fieldtype uses Pixel & Tonic's P&T Switch fieldtype
 * as a base and extends it to allow the same UI for toggling
 * a given checkbox in a Publish/Edit form. You just need to
 * know the input name of the checkbox and setup the field settings
 * accordingly.
 * 
 * @package    P&T Switch: Checkbox Toggle
 * @author     Pixel & Tonic (P&T Switch Author)
 * @author     Focus Lab, LLC <dev@focuslabllc.com>
 * @copyright  Copyright (c) 2011 Focus Lab, LLC
 * @link       https://github.com/eirkreagan/pt_switch_checkbox_toggle.ee2_addon
 */


// Load the fieldtype file if it isn't already on the page load
if ( ! class_exists('Pt_switch_ft'))
{
	require_once PATH_THIRD . 'pt_switch/ft.pt_switch.php';
}

class Pt_switch_checkbox_toggle_ft extends Pt_switch_ft {
	
	
	/**
	 * @var   array   Fieldtype info
	 */
	var $info = array(
		'name'    => 'P&T Switch: Checkbox Toggle',
		'version' => '1.0.0'
	);
	
	
	
	/**
	 * Class constructor
	 * 
	 * @access     public
	 * @author     Erik Reagan <erik@focuslabllc.com>
	 * @return     void
	 */
	public function __construct()
	{
		parent::__construct();
	}
	// End function __construct()
	
	
	
	
	/**
	 * Display Field on publish form
	 * 
	 * @access     public
	 * @param      mixed
	 * @param      bool
	 * @author     Pixel & Tonic (P&T Switch Author)
	 * @author     Erik Reagan <erik@focuslabllc.com>
	 * @return     string
	 */
	public function display_field($data, $cell = FALSE)
	{
		
		$field_name = $cell ? $this->cell_name : $this->field_name;
		$view_data['field_id'] = str_replace(array('[', ']', 'id_'), array('_', '', ''), $field_name);
		$view_data['input'] = $this->settings['ptct_input_name'];
		
		$this->EE->cp->add_to_foot($this->EE->load->view('checkbox_toggle', $view_data, TRUE));
		
		return parent::display_field($data, $cell);
		
	}
	// End function display_field()
	
	
	
	
	/**
	 * Display Field Settings
	 * 
	 * @access     public
	 * @param      mixed
	 * @author     Pixel & Tonic (P&T Switch Author)
	 * @return     void
	 */
	public function display_settings($data)
	{
		$rows = $this->_field_settings($data);

		foreach ($rows as $row)
		{
			$this->EE->table->add_row($row[0], $row[1]);
		}
	}
	// End function display_settings
	
	
	
	
	/**
	 * Save fieldtype settings
	 * 
	 * @access     public
	 * @param      mixed
	 * @author     Pixel & Tonic (P&T Switch Author)
	 * @return     array
	 */
	public function save_settings($settings)
	{
		$settings = $this->EE->input->post('pt_switch');
		
		$settings['field_fmt'] = 'none';
		$settings['field_show_fmt'] = 'n';
		$settings['field_type'] = 'pt_switch_checkbox_toggle';
		
		return $settings;
	}
	// End function save_settings()
	
	
	
	
	/**
	 * Save cell settings for when within a matrix
	 * 
	 * @access     public
	 * @param      mixed
	 * @author     Pixel & Tonic (P&T Switch Author)
	 * @return     array
	 */
	public function save_cell_settings($settings)
	{
		return $settings['pt_switch_comments'];
	}
	// End function save_cell_settings()
	
	
	
	
	/**
	 * Field Settings
	 */
	private function _field_settings($data, $attr = '')
	{
		// load the language file
		$this->EE->lang->loadfile('pt_switch_checkbox_toggle');

		// merge in default field settings
		$data = array_merge(
			array(
				'off_label'  => 'NO',
				'off_val'    => '',
				'on_label'   => 'YES',
				'on_val'     => 'y',
				'default'    => 'off',
				'ptct_input_name' => ''
			),
			$data
		);

		return array(
			// OFF Label
			array(
				lang('pt_switch_off_label', 'pt_switch_off_label'),
				form_input('pt_switch[off_label]', $data['off_label'], $attr)
			),

			// OFF Value
			array(
				lang('pt_switch_off_val', 'pt_switch_off_val'),
				form_input('pt_switch[off_val]', $data['off_val'], $attr)
			),

			// ON Label
			array(
				lang('pt_switch_on_label', 'pt_switch_on_label'),
				form_input('pt_switch[on_label]', $data['on_label'], $attr)
			),

			// ON Value
			array(
				lang('pt_switch_on_val', 'pt_switch_on_val'),
				form_input('pt_switch[on_val]', $data['on_val'], $attr)
			),

			// Default
			array(
				lang('pt_switch_default', 'pt_switch_default'),
				form_dropdown('pt_switch[default]', array('off' => 'OFF', 'on' => 'ON'), $data['default'])
			),
			
			// Input name
			array(
				lang('ptct_input_name', 'ptct_input_name'),
				form_input('pt_switch[ptct_input_name]', $data['ptct_input_name'], $attr)
			),
		);
	}
	// End function _field_settings()
	
}
// End class Pt_switch_checkbox_toggle_ft

/* End of file ft.pt_switch_checkbox_toggle.php */
/* Location: ./system/expressionengine/third_party/pt_switch_checkbox_toggle/ft.pt_switch_checkbox_toggle.php */