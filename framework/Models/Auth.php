<?php

namespace Models;
use Models\User;

class Auth {
	/**
	 * Logs the user in
	 */
	public static function login($credentials) {
		// check if the user is in the database
		$user = User::get("email", $credentials["email"]);

		if ($user) {
			// authenticate passwords
			if (password_verify($credentials["password"], $user["password"])) {
				// store the user to a session
				$_SESSION["logged_in_user"] = $user["id"];

				// redirect to index
				return true;
			}
			return false;
		} else {
			return false;
		}
	}

	/**
	 * Logs the user out
	 */
	public static function logout() {
		$user = self::user();
		if ($user) {
			session_unset($_SESSION);
			session_destroy();
		}

		render("index");
	}

	/**
	 * Returns the logged in user
	 */
	public static function user() {
		// get the user from session
		$user = User::get("id", $_SESSION["logged_in_user"]);
		if ($user) {
			return $user;
		}

		return false;
	}
}
