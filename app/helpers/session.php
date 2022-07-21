<?php
session_start();
	function isLoggedin() {
		if (isset($_SESSION['user_id'])) {
			return true;
		} else {
			return false;
		}
	}