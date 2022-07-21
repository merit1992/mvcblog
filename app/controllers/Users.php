<?php

class Users extends Controller {
	public function __construct() {
		$this->userModel = $this->model('User');
	}

	public function register() {
		$data = [
			'title' => '',
			'username' => '',
			'email' => '',
			'password' => '',
			'confirmPassword' => '',
			'usernameError' => '',
			'emailError' => '',
			'passwordError' => '',
			'confirmPasswordError' => ''
		];

		if (strtoupper($_SERVER['REQUEST_METHOD'] == 'POST')) {
			if (isset($_POST['submit'])) {
				
				$data = [
					'username' => htmlspecialchars(rtrim($_POST['username'])),
					'email' => htmlspecialchars(rtrim($_POST['email'])),
					'password' => htmlspecialchars(rtrim($_POST['password'])),
					'confirmPassword' => htmlspecialchars(rtrim($_POST['confirmPassword'])),
					'usernameError' => '',
					'emailError' => '',
					'passwordError' => '',
					'confirmPasswordError' => ''
				];

				// check for validation before sending data into the database

				if (empty($data['username'])) {
					$data['usernameError'] = 'Please enter your username';
				} elseif (!preg_match("/^['a-zA-Z0-9']&*/", $data['username'])){
					$data['usernameError'] = 'Only alphabet and number is allowed';
				}
				if (empty($data['email'])) {
					$data['emailError'] = 'Please enter your email';
				} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$data['emailError'] = 'Incorrect email format';
				} else {
					if ($this->userModel->checkUserByEmail($data['email'], $data['username'])) {
						$data['emailError'] = 'user already exist';
					}
				}
				if (empty($data['password'])) {
					$data['passwordError'] = 'please enter your password';
				} elseif (strlen($data['password']) < 6) {
					$data['passwordError'] = 'Password weak. 7 character or more is expected';
				}
				if (empty($data['confirmPassword'])) {
					$data['confirmPasswordError'] = 'please enter your password again here';
				} elseif ($data['password'] !== $data['confirmPassword']) {
					$data['confirmPasswordError'] = 'Password and Confirm password didnt match. Try again';
				}
				if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
					
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
					if ($this->userModel->register($data)){
						header('location:'. URLROOT .'/users/login');
					} else {
						die('Something went wrong');
					}
				}
			}
		}

		$this->view('users/register', $data);
	}
	public function login() {
		$data = [
			'title' => '',
			'email/username' => '',
			'password' => '',
			'email/usernameError' => '',
			'passwordError' => ''
		];
		if (strtoupper($_SERVER['REQUEST_METHOD'] == 'POST')) {
			if (isset($_POST['submit'])) {
				$data = [
					'email/username' => htmlspecialchars(rtrim($_POST['email/username'])),
					'password' => htmlspecialchars(rtrim($_POST['password'])),
					'email/usernameError' => '',
					'passwordError' => ''
				];
				if (empty($data['email/username'])) {
					$data['email/usernameError'] = 'please enter your email or username';
				}
				if (empty($data['password'])) {
					$data['passwordError'] = 'please enter your password';
				}
				if (empty($data['email/usernameError']) && empty($data['passwordError'])) {
						if ($this->userModel->checkUserByEmail($data['email/username'], $data['email/username'])){
						$logginUser = $this->userModel->login($data['email/username'], $data['password']);
						if ($logginUser) {
							$this->userSession($logginUser);
						} else {
							$data['passwordError'] = "Password/Email combination is incorrect";
							$this->view('users/login', $data);
						}
					} else {
						$data['passwordError'] = 'User not found';
					}
				}
			} else {
				$data = [
					'title' => '',
					'email' => '',
					'password' => '',
					'emailError' => '',
					'passwordError' => ''
				];
			}
		}

		$this->view('users/login', $data);
	}
	public function userSession($user) {
		$_SESSION['user_id'] = $user->client_id;
		$_SESSION['username'] = $user->username;
		$_SESSION['email'] = $user->email;
		header('location:' . URLROOT . '/pages/index');

	}
	public function logout() {
		unset($_SESSION['user_id']);
		unset($_SESSION['username']);
		unset($_SESSION['email']); 
		header('location:' . URLROOT . '/users/login');
	}
}