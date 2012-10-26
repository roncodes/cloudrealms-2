<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UI extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->data['meta_title'] = 'Game Interface Options';
	}
	
}