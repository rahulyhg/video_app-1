<?php

namespace Controllers;

class PagesController {
	/**
	 * Displays the landing page
	 */
	public static function index($message = []) {
		render("index", NULL, $message);
	}

	/**
	 * Displays the login page
	 */
	public static function login($message = []) {
		render("users/login", NULL ,$message);
	}

	/**
	 * Displays the register page
	 */
	public static function register() {
		render("users/register");
	}
}
