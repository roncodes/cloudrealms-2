<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissions extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		// Load all necessary models
		$this->load->model('group_model', 'group');
	}

	public function index()
	{
        $this->form_validation->set_rules('permissions[]', 'Permissions', 'xss_clean');

		if ($this->form_validation->run() === TRUE)
		{
			$data = $this->input->post('permissions');

			foreach ($data as $group_name => $permissions)
			{
				$group_id = $this->group->get_by('name', $group_name)->id;
				$this->group->update($group_id, array('permissions' => json_encode($permissions)));
			}
		}

		// Get all available user groups and decode the permissions JSON array
		$groups = $this->group->get_all();
        foreach ($groups as $group)
        {
	        $group->permissions = json_decode($group->permissions);
        }

        // Setup all variables for the view
        $this->data['groups'] = $groups;
        $this->data['controllers'] = $this->_get_controllers();
        $this->data['meta_title'] = 'Manage Permissions';
	}

	/**
	 * Gets all of the controllers for the site and returns them in an array
	 */
	private function _get_controllers($controllers = array())
	{
		// Search in the main /controllers/ directory as well as the /admin/ subfolder
		$dirs = array(APPPATH.'/controllers/', APPPATH.'/controllers/editor/', APPPATH.'/controllers/world/');
		foreach ($dirs as $dir)
		{
			// Find all .php files within the directories
			$controller_files = array_filter(scandir($dir), function($filename) {
				return (substr(strrchr($filename, '.'), 1) == 'php') ? TRUE : FALSE;
			});

			// Add each controller to the final array
			foreach ($controller_files as $filename)
	        {
	        	$classname = substr($filename, 0, strrpos($filename, '.'));
	            $controllers[$classname] = array(ucwords(str_replace('_', ' ', $classname)), strtolower(basename($dir)));
	        }
		}

        return $controllers;
	}

}