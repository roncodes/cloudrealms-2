<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout = false;
	}
	
	public function index()
	{
		$this->view = false;
		if(isset($_GET['action'])){
			switch($_GET['action']){
				case 'delete_resource':
					$result = unlink($_GET['resource']);
					if($result){
						echo "success";
					}
					break;
				case 'save_map':
					$result = $this->db->query("UPDATE locations SET ground_map = '".substr($_POST['ground_map'], 0, -1)."', environment_map = '".substr($_POST['environment_map'], 0, -1)."' WHERE name = '".$_POST['location']."'");
					if($result){
						echo "success";
					}
					break;
				case 'create_location':
					extract($_GET);
					if($this->_location_name_available($location_name)){
						if (preg_match('/[^a-zA-Z]+/', $location_name, $matches))
						{
							echo 'fail';
							return;
						}
						$result = $this->db->query("INSERT INTO locations (name) VALUES ('".strtolower($location_name)."')");
					} else {
						echo "name_exist";
						return;
					}
					if($result){
						echo "success";
					}
					break;
				case 'set_tile':
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
					$location_data = $this->db->query("SELECT * FROM locations WHERE name = '$_GET[location]'")->row();
					echo $location_data->ground_map;
					break;
				case 'get_environment':
					$location_data = $this->db->query("SELECT * FROM locations WHERE name = '$_GET[location]'")->row();
					echo $location_data->environment_map;
					break;
			}
			die();
		}
	}
	
	private function _location_name_available($location)
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
	
}