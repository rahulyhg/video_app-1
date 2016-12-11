<?php

namespace Models;

class User {
	/**
	 * Gets all the users
	 */
	public static function all() {
		// get the db
		global $app;
		$db = $app->getDatabase();

		try {
			$users = $db->user()->select("*");
		} catch (PDOException $e) {
			return false;
		}
		return $users;
	}

	/**
	 * Persists a user to a database
	 */
	public static function create($credentials) {
		// get the db
		global $app;
		$db = $app->getDatabase();

		// store user in the database
		try {
			$users = $db->user();
			$result = $users->insert([
				"email" => $credentials["email"],
				"password" => password_hash($credentials["password"], PASSWORD_BCRYPT),
				"description" => $credentials["description"],
				"access_level" => 0
			]);
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}


	/**
	 * Gets the user by specified parameter
	 * 
	 * @param  string $key
	 * @param  mixed $value
	 * @return object
	 */
	public static function get($key, $value) {
		// get the db
		global $app;
		$db = $app->getDatabase();

		// get the user
		try {
			$userQuery = $db->user("$key = ?", "$value");
			$user = $userQuery->fetch();
			$userCount = $userQuery->count();

			if ($userCount < 1) {
				return false;
			}
			return $user;
		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Blocks the user
	 */
	public static function block($id) {
		// get the user
		$userToBeBlocked = self::get("id", $id);

		// block the user
		$userToBeBlocked->update([
			'blocked' => 1
		]);
		return true;
	}

	/**
	 * Unblocks the user
	 */
	public static function unblock($id) {
		// get the user
		$userToBeUnblocked = self::get("id", $id);

		// unblock the user
		$userToBeUnblocked->update([
			'blocked' => 0
		]);
		return true;
	}

	// Deletes the user
	public static function delete($id) {
		// get the user
		$user = self::get("id", $id);

		// delete the user
		$user->delete();
		return true;
	}
}
