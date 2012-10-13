<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	protected $data;
	protected $defaults;
	protected $view;
	protected $layout;

	function __construct()
	{
		parent::__construct();
		
		// Before anything else, check user permissions for this request
		$this->_check_permissions();
		
		// Load all site settings
		$settings = $this->settings->get_settings();
		if (array_key_exists('site_name', $settings) === FALSE OR empty($settings['site_name']))
		{
			$settings['site_name'] = SYSTEM_NAME;
		}
		
		// Wrapper and view data
		$this->data = array(
			'folder_name' => $this->router->class,
			'meta_title' => $settings['site_name'],
			'meta_desc' => '',
			'meta_keywords' => '',
			'meta_robot' => 'index, follow',
			'settings' => $settings
		);
		
		// Set the error delimiters for bootstrap
		$this->form_validation->set_error_delimiters('<p class="help-block">', '</p>');
	}

	/**
	 * Remap the CI request, running the method
	 * and loading the view
	 */
	public function _remap($method, $arguments)
	{
		if (method_exists($this, $method))
		{
			call_user_func_array(array($this, $method), array_slice($this->uri->rsegments, 2));
		}
		else
		{
			show_404(strtolower(get_class($this)).'/'.$method);
		}

		$this->_load_view();
	}

	/**
	 * Load a view into a layout based on
	 * controller and method name
	 */
	private function _load_view()
	{
		// Back out if we've explicitly set the view to FALSE
		if ($this->view === FALSE) return;

		// Get or automatically set the view and layout name
		$view = ($this->view !== null) ? $this->view . '.php' : $this->router->directory . $this->router->class . '/' . $this->router->method . '.php';

		if ($this->uri->segment(1) == 'editor')
		{
			 $layout = ($this->layout !== null) ? $this->layout . '.php' : 'layouts/editor.php';
		}
		else
		{
			 $layout = ($this->layout !== null) ? $this->layout . '.php' : 'layouts/application.php';
		}

		if (is_admin())
		{
			 $this->output->enable_profiler(TRUE);
		}

		// Load the view into the data
		$this->data['yield'] = $this->load->view($view, $this->data, TRUE);

		// Display the layout with the view
		$this->load->view($layout, $this->data);
	}

	/**
	 * Check the group of the current user and make sure
	 * they have access to the controller being requested
	 */
	private function _check_permissions()
	{
		$this->load->library('user_agent');
		$this->load->model('group_model', 'group');
		
		if (logged_in())
		{
			$user = $this->ion_auth->get_user();
			$user_group = $user->group;
		}
		else
		{
			$user_group = 'guest';
		}
		
		$permissions = json_decode($this->group->get_by('name', $user_group)->permissions);
		
		if ( ! isset($permissions->{$this->router->class}))
		{
			flashmsg('You do not have the correct permissions to view that.', 'error');
			if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
   				redirect(base_url());
			}
		}
	}

	/**
	 * Generate a CSRF nonce key and value to verify deletion requests
	 * for security purposes
	 */
	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	/**
	 * Check to make sure the CSRF nonce given was valid
	 */
	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}