<?php

namespace Models;

use Core\Transformer;

class Lecture {
	/**
	 * Gets all the lectures
	 */
	public static function all() {
		// get the db
		global $app;
		$db = $app->getDatabase();

		try {
			$lectures = $db->lecture();
			$lecturesArray = Transformer::objectsToArray($lectures);
			return $lecturesArray;
		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Gets the lecture by a specified parameter
	 * 
	 * @param  string $key
	 * @param  mixed $value
	 * @return object
	 */
	public static function get($key, $value) {
		// get the db
		global $app;
		$db = $app->getDatabase();

		// get the lecture
		try {
			$lectureQuery = $db->lecture("$key = ?", "$value");
			$lecture = $lectureQuery->fetch();
			$lectureCount = $lectureQuery->count();

			if ($lectureCount < 1) {
				return false;
			}
			return $lecture;
		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Persist the lecture to the database.
	 * 
	 * @param array $data
	 * 
	 */
	public static function store($data) {
		global $app;
		$db = $app->getDatabase();

		// prepare the data
		$lectureData = [
			"title" => $data["title"],
			"note" => $data["note"],
			"user_id" => $data["user_id"],
			"date" => $data["date"],
			"starts_at" => $data["starts_at"],
			"ends_at" => $data["ends_at"]
		];

		// insert data into the database
		try {
			$lectures = $db->lecture();
			$result = $lectures->insert($lectureData);

			if ($result) {
				return true;
			}
			return false;
		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Get all the lectures for a user.
	 * 
	 * @param  int $user_id
	 * @return array
	 */
	public static function getForUser($user_id) {
		// get the database
		global $app;
		$db = $app->getDatabase();

		// get all the records
		$subscriptions = $db->lecture_user()->where("user_id", $user_id);
		$subscriptionIdsArray = array();
		foreach ($subscriptions as $subscription) {
			array_push($subscriptionIdsArray, $subscription["lecture_id"]);
		}
		$lectures = $db->lecture()->where("id", $subscriptionIdsArray);
		return $lectures;
	}

	/**
	 * Get a specific lecture.
	 * 
	 * @param  int $user_id
	 * @param  int $lecture_id
	 * @return Object
	 */
	public static function getSubscriptionRecord($user_id, $lecture_id) {
		// get the database
		global $app;
		$db = $app->getDatabase();

		// return the record
		$record = $db->lecture_user()->where("lecture_id", $lecture_id)->where("user_id", $user_id);
		return $record;
	}
}
