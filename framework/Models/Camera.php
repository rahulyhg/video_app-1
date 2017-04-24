<?php

namespace Models;

use Core\Transformer;

class Camera {
	/**
	 * Get the list of all te cameras
	 * 
	 * @return Object
	 */
	public static function all() {
		// get the db
		global $app;
		$db = $app->getDatabase();

		try {
			$cameras = $db->camera();
			$camerasArray = Transformer::objectsToArray($cameras);
			return $camerasArray;
		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Gets a specified camera.
	 * 
	 * @param  string $key
	 * @param  mixed $value
	 * @return object
	 */
	public static function get($key, $value) {
		// get the db
		global $app;
		$db = $app->getDatabase();

		// get the camera
		try {
			$cameraQuery = $db->camera("$key = ?", "$value");
			$camera = $cameraQuery->fetch();
			$cameraCount = $cameraQuery->count();

			if ($cameraCount < 1) {
				return false;
			}
			return $camera;
		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Stores the camera into database.
	 * 
	 * @param  array $data
	 * @return boolean
	 */
	public static function store($data) {
		global $app;
		$db = $app->getDatabase();

		// prepare the data
		$cameraData = [
			"name" => $data["name"],
			"stream_address" => $data["stream_address"]
		];

		// insert data into the database
		try {
			$cameras = $db->camera();
			$result = $cameras->insert($cameraData);

			if ($result) {
				return true;
			}
			return false;
		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Deletes a record of teh camera from the database.
	 * 
	 * @param  int $id
	 * @return void
	 */
	public static function delete($id) {
		// get the user
		$camera = self::get("id", $id);

		// delete the camera
		$camera->delete();
		return true;
	}
}
