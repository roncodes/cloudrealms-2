<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Location_model', 'locations');
	}
	
	public function index()
	{
		$this->data['locations'] = $this->locations->get_all();	
		$this->data['location'] = '';
	}
	
	public function view($location = NULL)
	{
		$this->data['sprites'] = glob("resources/sprites/*");
		$this->data['tiles'] = glob("resources/tiles/*");
		$this->data['new_map'] = false;
		if($location!=NULL){
			if($this->_is_new_location($location)){
				$this->data['new_map'] = true;
			}
		}
		$this->data['location'] = $location;
	}
	
	public function delete($name = NULL)
	{
		$this->view = 'editor/map/index';
		$this->data['sprites'] = glob("resources/sprites/*");
		$this->data['tiles'] = glob("resources/tiles/*");
		$location = $this->locations->get_by('name',  urldecode($name));
		$this->data['location'] = urldecode($name);
		cralert('Delete this location', 'Are you sure you wish to delete this location?', 'Confirm Delete', 'editor/map/confirm_delete/'.$location->id);
	}
	
	public function confirm_delete($id = NULL)
	{
		$this->locations->delete($id);
		redirect('editor/map');
	}
	
	private function _location_name_available($location)
	{
		$query = $this->db->query("SELECT * FROM locations");
		foreach ($query->result() as $row){
			if($location==$row->name){
				return false;
			}
		}
		return true;
	}
	
	private function _is_new_location($location)
	{
		$_location = $this->db->query("SELECT * FROM locations")->row();
		if($_location->ground_map!=''){
			return false;
		}
		return true;
	}
	
}