<?php

	class User {
		private $db;
		public function __construct() {
			$this->db = new Database;
		}
		public function checkUserByEmail($email, $username) {
			$this->db->query("SELECT * FROM client WHERE email = :email OR username = :username ");

			$this->db->bind(':email', $email);
			$this->db->bind(':username', $username);

			$row = $this->db->single();

			if ($this->db->rowCount() > 0) {
				return $row;
			} else {
				return false;
			}
		}

		public function register($data) {
			$this->db->query("INSERT INTO client (username, email, password) VALUES (:username, :email, :password)");

			$this->db->bind(':username', $data['username']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':password', $data['password']);

			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function login($email_username, $password) {
			$row = $this->checkUserByEmail($email_username, $email_username);
			if ($row == false)
				return false;

				$hashedpwd = $row->password;
				if (password_verify($password, $hashedpwd)) {
					return $row;
				} else {
					return false;
				}
			
		}
	}