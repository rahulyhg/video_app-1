<?php

namespace Core;

class Responder {
	/**
	 * Responds with a json.
	 * 
	 * @param  array $data
	 * @param  int $code
	 * @param  string $collectionName
	 * @return json
	 */
	public static function respondWithJson($collectionName, $data, $code = 200) {
		header('Content-Type: application/json');
		http_response_code($code);
		echo json_encode([$collectionName => $data]);
		die();
	}
}
