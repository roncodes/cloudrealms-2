<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class World_map extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Location_model', 'locations');
	}
	
	public function index()
	{
		$this->data['locations'] = $locations = $this->locations->get_all();
	}
	
}