<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->layout = 'layouts/auth';
	}

	function index()
	{
		$this->view = false;
		if ( ! $this->ion_auth->logged_in())
		{
			// Not logged in, redirect them to the login page
			redirect('auth/login');
		}
		elseif ( ! $this->ion_auth->is_admin())
		{
			// Not an admin, redirect them to the home page because they must be an administrator to view this
			redirect(base_url());
		} 
		redirect('editor/dashboard');
	}

	function login()
	{
		if ($this->ion_auth->logged_in())
		{
			// User is already logged in so no need to access this page
			redirect(base_url());
		}

		// Validate form input
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

		if ($this->form_validation->run() == TRUE)
		{
			// Check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
			{
				// Login was successful, so redirect them back to the home page
				flashmsg($this->ion_auth->messages(), 'success');
				if(is_admin()){
					redirect('editor');
				}
				redirect(base_url());
			}
			else
			{
				// Login was unsuccessful, so flash a message to them with the error
				flashmsg($this->ion_auth->errors(), 'error');
			}
		}

		// User hasn't logged in, so show the login form
		$this->data['meta_title'] = 'Login';
	}

	function logout()
	{
		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them back to the page they came from
		redirect('auth');
	}

	function change_password()
	{
		$this->form_validation->set_rules('old', 'Old password', 'required');
		$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

		if ( ! $this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		$user = $this->ion_auth->get_user($this->session->userdata('user_id'));

		if ($this->form_validation->run() == FALSE)
		{
			// Used for the user_id hidden field
			$this->data['user_id'] = array(
				'name' => 'user_id',
				'id' => 'user_id',
				'type' => 'hidden',
				'value' => $user->id
			);

			$this->data['meta_title'] = 'Change Password';
		}
		else
		{
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				// The password was successfully changed
				flashmsg($this->ion_auth->messages(), 'success');
				$this->logout();
			}
			else
			{
				flashmsg($this->ion_auth->errors(), 'error');
				redirect('auth/change_password');
			}
		}
	}

	function forgot_password()
	{
		// Get the identity type from config and send it when you load the view
		$identity = $this->config->item('identity', 'ion_auth');
		$identity_human = ucwords(str_replace('_', ' ', $identity)); // If someone uses underscores to connect words in the column names
		$this->form_validation->set_rules($identity, $identity_human, 'required');
		if ($this->form_validation->run() === TRUE)
		{
			// Run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($this->input->post($identity));

			if ($forgotten)
			{
				// Password email was sent successfully
				flashmsg($this->ion_auth->messages(), 'success');
				redirect('auth/login');
			}
			else
			{
				flashmsg($this->ion_auth->errors(), 'error');
			}
		}
		
		// Setup the input to display in the form
		$this->data[$identity] = array(
			'name' => $identity,
			'id' => $identity
		);
		
		// Set any errors and display the form
		$this->data['identity'] = $identity;
		$this->data['identity_human'] = $identity_human;
		$this->data['meta_title'] = 'Forgot Password';
	}

	public function reset_password($code)
	{
		$reset = $this->ion_auth->forgotten_password_complete($code);

		if ($reset)
		{
			// If the reset worked then send them to the login page
			flashmsg($this->ion_auth->messages(), 'success');
			redirect('auth/login');
		}
		else
		{
			// If the reset didnt work then send them back to the forgot password page
			flashmsg($this->ion_auth->errors(), 'error');
			redirect('auth/forgot_password');
		}
	}
	
	function register()
	{
		if ($this->ion_auth->logged_in())
		{
			flashmsg('You are already logged in.');
			redirect('');
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
		$this->form_validation->set_rules('company', 'Company Name', 'trim|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]|trim|xss_clean');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE)
		{
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone')
			);
		}
		
		if ($this->form_validation->run() == TRUE && $this->ion_auth->register($username, $password, $email, $additional_data))
		{
			// Creating the user was successful, edirect them back to the admin page
			flashmsg('You have successfully registered.', 'success');
			redirect('auth/login');
		}
		else
		{
			// Display the create user form
			$this->data['meta_title'] = 'Register';
		}
	}

	function activate($id, $code = FALSE)
	{
		if ($code !== FALSE)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			// An admin can activate a user without a code
			$activation = $this->ion_auth->activate($id);
		}
		
		if ($activation)
		{
			// Redirect them to the auth page
			flashmsg($this->ion_auth->messages(), 'success');
			
			if ($this->ion_auth->is_admin())
			{
				redirect('admin/users');
			}
			else
			{
				redirect('auth');
			}
		}
		else
		{
			// Redirect them to the forgot password page
			flashmsg($this->ion_auth->errors(), 'error');
			
			if ($this->ion_auth->is_admin())
			{
				redirect('admin/users');
			}
			else
			{
				redirect('admin/users/forgot_password');
			}
		}
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */