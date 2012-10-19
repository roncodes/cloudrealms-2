<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Characters extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('character_model', 'characters');
		$this->data['navbar'] = $this->load->view('editor/characters/navbar', null, true);
	}
	
	public function index()
	{
		$this->data['characters'] = $this->characters->get_all();
		$this->data['meta_title'] = 'All Characters';
	}
	
	public function classes()
	{
		$this->load->model('class_model', 'classes');
		$this->data['classes'] = $this->classes->get_all();
		$this->data['meta_title'] = 'Character Classes';
	}
	
	public function zodiacs()
	{
		$this->load->model('zodiac_model', 'zodiacs');
		$this->data['zodiacs'] = $this->zodiacs->get_all();
		$this->data['meta_title'] = 'Character Zodiacs';
	}
	
	public function create()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
		$this->form_validation->set_rules('company', 'Company Name', 'trim|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]|trim|xss_clean');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|trim|xss_clean');
		$this->form_validation->set_rules('group_id', 'Group', 'required|trim|xss_clean');
		
		if ($this->form_validation->run() == TRUE)
		{
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone'),
				'group_id' => $this->input->post('group_id')
			);
		}
		
		if ($this->form_validation->run() == TRUE && $this->ion_auth->register($username, $password, $email, $additional_data))
		{
			// Creating the user was successful, redirect them back to the admin page
			flashmsg('User created successfully.', 'success');
			redirect('/admin/players');
		}
		
		// Display the create user form
		$all_groups = $this->ion_auth->get_groups();
		$groups = array('' => 'Select one');
		foreach ($all_groups as $group)
		{
			$groups[$group->id] = $group->description;
		}
		$this->data['groups'] = $groups;
		$this->data['meta_title'] = 'Create User';
	}
	
	public function edit($id = NULL)
	{
		$user = $this->data['user'] = $this->ion_auth->get_user($id);
		if (empty($id) || empty($user))
		{
			flashmsg('You must specify a user to edit.', 'error');
			redirect('/admin/players');
		}
		
		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
		$this->form_validation->set_rules('company', 'Company Name', 'trim|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]|trim|xss_clean');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|xss_clean');
		$this->form_validation->set_rules('group_id', 'Group', 'required|trim|xss_clean');
		
		if ($this->form_validation->run() === TRUE)
		{
			$data = $this->input->post();
			
			if (empty($data['password']))
			{
				unset($data['password']);
			}
			unset($data['password_confirm']);
			
			if ($this->ion_auth->update_user($id, $data) === TRUE)
			{
				flashmsg('User edited successfully.', 'success');
				redirect('/admin/players');
			}
			else
			{
				flashmsg('There was an error while trying to edit the user.', 'error');
			}
		}
		
		$all_groups = $this->ion_auth->get_groups();
		$groups = array('' => 'Select one');
		foreach ($all_groups as $group)
		{
			$groups[$group->id] = $group->description;
		}
		$this->data['groups'] = $groups;
		$this->data['meta_title'] = 'Edit User';
	}

	public function delete($id = NULL)
	{
		$user = $this->data['user'] = $this->ion_auth->get_user($id);
		if (empty($id) || empty($user))
		{
			flashmsg('You must specify a user to edit.', 'error');
			redirect('/admin/players');
		}
		
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

		if ($this->form_validation->run() === TRUE)
		{
			// Do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// Do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_404();
				}

				// Do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->delete_user($id);
				}
				
				// Redirect them back to the admin page
				flashmsg('User deleted successfully.', 'success');
				redirect('/admin/players');
			}
			else
			{
				redirect('/admin/users');
			}
		}
		
		// Insert csrf check
		$this->data['csrf'] = $this->_get_csrf_nonce();
		$this->data['user'] = $this->ion_auth->get_user($id);
		$this->data['meta_title'] = 'Delete User';
	}
	
	function deactivate($id = NULL)
	{
		$user = $this->data['user'] = $this->ion_auth->get_user($id);
		if (empty($id) || empty($user))
		{
			flashmsg('You must specify a user to deactivate.', 'error');
			redirect('/admin/players');
		}

		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

		if ($this->form_validation->run() === TRUE)
		{
			// Do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// Do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_404();
				}

				// Do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
				
				// Redirect them back to the admin page
				flashmsg('User deactivated successfully.', 'success');
				redirect('/admin/players');
			}
			else
			{
				redirect('/admin/players');
			}
		}
		
		// Insert csrf check
		$this->data['csrf'] = $this->_get_csrf_nonce();
		$this->data['meta_title'] = 'Deactivate User';
	}

}