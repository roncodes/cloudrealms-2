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
			}
			die();
		}
	}
	
	public function index()
	{
		$this->_display('editor/dashboard', $this->data);
	}
	
	public function map_editor()
	{
		$this->_display('editor/map_editor', $this->data);
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