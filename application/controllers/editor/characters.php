<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Characters extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('character_model', 'characters');
		$this->load->model('zodiac_model', 'zodiacs');
		$this->load->model('class_model', 'classes');
		$this->load->model('attribute_model', 'attributes');
		$this->data['navbar'] = $this->load->view('editor/characters/navbar', null, true);
	}
	
	public function index()
	{
		$this->data['characters'] = $this->characters->get_all();
		$this->data['meta_title'] = 'All Characters';
	}
	
	public function classes()
	{
		$this->data['classes'] = $this->classes->get_all();
		$this->data['meta_title'] = 'Character Classes';
	}
	
	public function zodiacs()
	{
		$this->data['zodiacs'] = $this->zodiacs->get_all();
		$this->data['meta_title'] = 'Character Zodiacs';
	}
	
	public function attributes($action = NULL, $id = NULL)
	{
		if($action=='create') {
			$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('acronym', 'Acronym', 'required|trim|xss_clean|min_length[2]|max_length[4]');
			$this->form_validation->set_rules('description', 'Description', 'required|trim|xss_clean');
			/* Make sure the acronym is all caps */
			if(isset($_POST['acronym'])){
				$_POST['acronym'] = strtoupper($_POST['acronym']);
			}
			if ($this->form_validation->run() == TRUE && $this->attributes->insert($_POST))
			{
				// Creating the attr was successful, redirect them back to the admin page
				flashmsg('Attribute created successfully.', 'success');
				redirect('/editor/characters/attributes');
			}
			$this->view = 'editor/characters/create_attr';
		} else if($action=='edit') {
			/**
				EDIT ATTRIBUTE
			**/
			$attr = $this->data['attr'] = $this->attributes->get($id);
			if (empty($id) || empty($attr))
			{
				flashmsg('You must specify a attribute to edit.', 'error');
				redirect('/editor/characters/attributes');
			}
			$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('acronym', 'Acronym', 'required|trim|xss_clean|min_length[2]|max_length[4]');
			$this->form_validation->set_rules('description', 'Description', 'required|trim|xss_clean');
			/* Make sure the acronym is all caps */
			if(isset($_POST['acronym'])){
				$_POST['acronym'] = strtoupper($_POST['acronym']);
			}
			if ($this->form_validation->run() == TRUE && $this->attributes->update($id, $_POST))
			{
				// Creating the attr was successful, redirect them back to the admin page
				flashmsg('Attribute has been updated successfully.', 'success');
				redirect('/editor/characters/attributes');
			}
			$this->view = 'editor/characters/edit_attr';
		} else if($action=='delete') {
			/**
				DELETE ATTRIBUTE
			**/
			$attr = $this->data['attr'] = $this->attributes->get($id);
			if (empty($id) || empty($attr))
			{
				flashmsg('You must specify a attribute to delete.', 'error');
				redirect('/editor/characters/attributes');
			}
			$this->form_validation->set_rules('confirm', 'confirmation', 'required');
			$this->form_validation->set_rules('id', 'attribute ID', 'required|is_natural');
			if ($this->form_validation->run() === TRUE)
			{
				// Do we really want to delete?
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
						$this->attributes->delete($id);
					}
					
					// Redirect them back to the admin page
					flashmsg('Attribute deleted successfully.', 'success');
					redirect('/editor/characters/attributes');
				}
				else
				{
					redirect('/editor/characters/attributes');
				}
			}
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->view = 'editor/characters/delete_attr';
		}
		$this->data['attributes'] = $this->attributes->get_all();
		$this->data['meta_title'] = 'Character Attributes';
	}
	
	public function create()
	{
		$this->form_validation->set_rules('player_id', 'Player', 'required|trim|xss_clean');
		$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('level', 'Level', 'trim|xss_clean|integer');
		$this->form_validation->set_rules('gold', 'Gold', 'trim|xss_clean|integer');
		$this->form_validation->set_rules('skill_points', 'Skill Points', 'trim|xss_clean|integer');
		$this->form_validation->set_rules('attack', 'Attack Points', 'required|trim|xss_clean|integer');
		$this->form_validation->set_rules('defense', 'Defense Points', 'required|trim|xss_clean|integer');
		$this->form_validation->set_rules('zodiac', 'Zodiac', 'required|trim');
		$this->form_validation->set_rules('avatar', 'Avatar', 'required|trim|xss_clean');
		$this->form_validation->set_rules('face', 'Face', 'required|trim|xss_clean');
		$this->form_validation->set_rules('marital_status', 'Marital Status', 'trim|xss_clean');
		$this->form_validation->set_rules('class', 'Class', 'required|trim|xss_clean');
		$this->form_validation->set_rules('gender', 'Gender', 'required|trim|xss_clean');
		
		if ($this->form_validation->run() == TRUE && $this->characters->insert($_POST))
		{
			// Creating the characters was successful, redirect them back to the admin page
			flashmsg('Character created successfully.', 'success');
			redirect('/editor/characters');
		}
		
		// Display the create user form
		$all_users = $this->ion_auth->get_users();
		$users = array('' => 'Select one');
		foreach ($all_users as $user)
		{
			$users[$user->id] = $user->username;
		}
		$this->data['users'] = $users;
		$all_zodiacs = $this->zodiacs->get_all();
		$zodiacs = array('' => 'Select one');
		foreach ($all_zodiacs as $zodiac)
		{
			$zodiacs[$zodiac->id] = $zodiac->name;
		}
		$this->data['zodiacs'] = $zodiacs;
		$all_classes = $this->classes->get_all();
		$classes = array('' => 'Select one');
		foreach ($all_classes as $class)
		{
			$classes[$class->id] = $class->name;
		}
		$this->data['classes'] = $classes;
		$all_characters = $this->characters->get_all();
		$characters = array('' => 'Single');
		foreach ($all_characters as $character)
		{
			$characters[$character->id] = $character->name;
		}
		$this->data['characters'] = $characters;
		$this->data['meta_title'] = 'Create Character';
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