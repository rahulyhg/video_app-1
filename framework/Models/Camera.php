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
}
