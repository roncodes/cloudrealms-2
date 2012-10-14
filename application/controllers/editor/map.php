<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->data['locations'] = $this->get_locations();	
		$this->data['location'] = '';
	}
	
	public function view($location = NULL)
	{
		$this->data['sprites'] = glob("resources/sprites/*");
		$this->data['tiles'] = glob("resources/tiles/*");
		$this->data['new_map'] = false;
		if($location!=NULL){
			if($this->is_new_location($location)){
				$this->data['new_map'] = true;
			}
		}
		$this->data['location'] = $location;
	}
	
	public function location_name_available($location)
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM locations");
		foreach ($query->result() as $row){
			if($location==$row->name){
				return false;
			}
		}
		return true;
	}
	
	public function is_new_location($location)
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM locations WHERE name = '$location'");
		if($query->row()->ground_map!=''){
			return false;
		}
		return true;
	}
	
	public function get_locations($locations=array())
	{
		$this->load->database();
		$query = $this->db->query("SELECT * FROM locations");
		foreach ($query->result() as $row){
			$locations[] = $row;
		}
		return $locations;
	}
	
}