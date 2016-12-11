<?php

namespace Core;

use Models\User;
use Models\Lecture;
use Models\Auth;

/**
 * Middleware class is responsible for handling ACL
 */
class Middleware {
	/**
	 * Returns false if user is not an admin
	 */
	public static function isUserAdmin() {
		$user = Auth::user();

		if ($user) {
			if ($user["access_level"] == 1) {
				return true;
			}
			return false;
		}
		return false;
	}

	/**
	 * Returns true if the user is blocked
	 */
	public static function isUserBlocked($id) {
		$user = User::get("id", $id);

		if ($user) {
			if ($user["blocked"] == 1) {
				return true;
			}
			return false;
		}
		return false;
	}

	/**
	 * Returns true if the user is logged in
	 * 
	 * @return boolean
	 */
	public static function isUserLoggedIn() {
		$user = Auth::user();

		if ($user) {
			return true;
		}
		return false;
	}
}
