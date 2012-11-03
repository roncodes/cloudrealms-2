<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		// Load all necessary models
		$this->load->model('group_model', 'group');
	}
	
	public function index()
	{
		$this->data['groups'] = $this->group->get_all();
		$this->data['meta_title'] = 'All Users';
	}
	
	public function create()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'required|trim|xss_clean');
		
		if ($this->form_validation->run() === TRUE)
		{
			$data = $this->input->post();
			
			if ($this->group->insert($data))
			{
				// Creating the user was successful, redirect them back to the editor page
				flashmsg('Group created successfully.', 'success');
				redirect('editor/groups');	
			}
			else
			{
				flashmsg('There was an error while trying to edit the group.', 'error');
			}
		}
		
		$this->data['meta_title'] = 'Create Group';
	}
	
	public function edit($id = NULL)
	{
		$group = $this->data['group'] = $this->group->get($id);
		if (empty($id) || empty($group))
		{
			flashmsg('You must specify a group to edit.', 'error');
			redirect('editor/groups');
		}
		
		$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'required|trim|xss_clean');
		
		if ($this->form_validation->run() === TRUE)
		{
			$data = $this->input->post();
			
			if ($this->group->update($id, $data))
			{
				flashmsg('Group edited successfully.', 'success');
				redirect('editor/groups');
			}
			else
			{
				flashmsg('There was an error while trying to edit the group.', 'error');
			}
		}
		
		$this->data['meta_title'] = 'Edit Group';
	}

	public function delete($id = NULL)
	{
		$group = $this->data['group'] = $this->group->get($id);
		if (empty($id) || empty($group))
		{
			flashmsg('You must specify a group to delete.', 'error');
			redirect('editor/groups');
		}
		
		$this->form_validation->set_rules('confirm', 'Confirmation', 'required');
		$this->form_validation->set_rules('id', 'Group ID', 'required|is_natural');

		if ($this->form_validation->run() === TRUE)
		{
			// Do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				if ($this->group->update($id, array('deleted' => 1)))
				{
					flashmsg('Group deleted successfully.', 'success');
					redirect('editor/groups');
				}
				else
				{
					flashmsg('There was an error while trying to delete the group.', 'error');
				}
			}
			else
			{
				redirect('editor/groups');
			}
		}
		
		$this->data['meta_title'] = 'Delete Group';
	}

}