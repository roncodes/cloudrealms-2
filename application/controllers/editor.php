<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Editor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->set_data();
	}
	
	public function set_data()
	{
		$this->data['page'] = $this->uri->segment(2);
	}
	
	public function ajax()
	{
		if(isset($_GET['action'])){
			switch($_GET['action']){
				case 'delete_resource':
					$result = unlink($_GET['resource']);
					if($result){
						echo "success";
					}
					break;
				case 'save_map':
					$this->load->database();
					$result = $this->db->query("UPDATE locations SET ground_map = '".substr($_POST['ground_map'], 0, -1)."', environment_map = '".substr($_POST['environment_map'], 0, -1)."' WHERE name = '".$_POST['location']."'");
					if($result){
						echo "success";
					}
					break;
				case 'create_location':
					$this->load->database();
					if($this->location_name_available($_GET['location_name'])){
						$result = $this->db->query("INSERT INTO locations (name) VALUES ('".strtolower($_GET['location_name'])."')");
					} else {
						echo "name_exist";
						die();
					}
					if($result){
						echo "success";
					}
					break;
				case 'set_tile':
					$this->load->database();
					$location_data = $this->db->query("SELECT * FROM locations WHERE name = '$_GET[location]'")->row();
					if($_GET['layer']=='environment'){
						$data = $location_data->environment_map;
					} else {
						$data = $location_data->ground_map;
					}
					$map_tiles = explode(',', $data);
					foreach($map_tiles as $tile){
						$original_tile = $tile;
						$tile = trim($tile, '{}');
						$tile_data = explode('|', $tile);
						if($tile_data[0]==$_GET['id']){
							// {0|x|y|tilesheet|xoff|yoff}
							$updated_tile = '{'.$tile_data[0].'|'.$tile_data[1].'|'.$tile_data[2].'|'.$_GET['tilesheet'].'|'.$_GET['offx'].'|'.$_GET['offy'].'|'.$_GET['size'].'}';
							break;
						}
					}
					$data = str_replace($original_tile, $updated_tile, $data);
					$result = $this->db->query("UPDATE locations SET $_GET[layer]_map = '$data' WHERE name = '$_GET[location]'");
					if($result){
						echo "success";
					}
					break;
				case 'get_ground':
					$this->load->database();
					$location_data = $this->db->query("SELECT * FROM locations WHERE name = '$_GET[location]'")->row();
					echo $location_data->ground_map;
					break;
				case 'get_environment':
					$this->load->database();
					$location_data = $this->db->query("SELECT * FROM locations WHERE name = '$_GET[location]'")->row();
					echo $location_data->environment_map;
					break;
			}
			die();
		}
	}
	
	public function index()
	{
		$this->_display('editor/dashboard', $this->data);
	}
	
	public function test()
	{
		var_dump($this->is_new_location('winterhold'));
		// $this->load->view('wrappers/editor/header', $this->data);
		// $this->load->view('editor/test', $this->data);
	}
	
	public function map_editor()
	{
		$this->data['sprites'] = glob("resources/sprites/*");
		$this->data['tiles'] = glob("resources/tiles/*");
		$this->data['locations'] = $this->get_locations();
		$this->data['location'] = $this->uri->segment(3);
		$this->data['new_map'] = false;
		if($this->data['location']){
			if($this->is_new_location($this->data['location'])){
				$this->data['new_map'] = true;
			}
		}
		$this->_display('editor/map_editor', $this->data);
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
	
	public function resources()
	{
		$this->data['resource'] = $this->uri->segment(3);
		$this->data['resources'] = glob("resources/".$this->uri->segment(3)."/*");
		$this->_display('editor/resources', $this->data);
	}
	
	public function dashboard()
	{
		$this->_display('editor/dashboard', $this->data);
	}
	
	public function _display($view, $data)
	{
		$this->load->view('wrappers/editor/header', $data);
		$this->load->view($view, $data);
		$this->load->view('wrappers/editor/footer', $data);
	}
}