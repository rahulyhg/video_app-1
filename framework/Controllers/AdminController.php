<?php

namespace Controllers;

use Models\User;
use Models\Auth;

class AdminController {
	/**
	 * Display the form for creating a new admin.
	 * 
	 * @return view
	 */
	public static function create() {
		render("admins/create");
	}

	/**
	 * Persists the newly created admin into the database.
	 * 
	 * @param  array $data
	 * @return boolean
	 */
	public static function store($credentials = []) {
		// get the variables from post request
		$email = $credentials["email"];
		$password = $credentials["password"];
		$credentials["access_level"] = 1;

		// if any of the needed fields is empty, do not store the user
		if ($email == "" || $password == "") {
			PagesController::index();
		}

		// check if there is a user like that
		$user = User::get("email", $email);

		if (!$user) {
			$newUser = User::create($credentials);

			if ($newUser) {
				Auth::login($newUser);
				redirect('');
			} else {
				render("index", NULL, ["type" => "error", "body" => "There was a problem with user registration"]);
			}
		} else {
			render("users/register", NULL, ["type" => "error", "body" => "There already is a user with this email registered"]);
		}

	}
}
