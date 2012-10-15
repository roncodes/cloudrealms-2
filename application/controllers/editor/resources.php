<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resources extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($resource = '')
	{
		$this->data['resource'] = $resource;
	}
	
	public function view($resource = '')
	{
		$this->data['resource'] = $resource;
		$this->data['resources'] = glob("resources/".$resource."/*");
	}
}