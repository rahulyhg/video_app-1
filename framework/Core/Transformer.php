<?php

namespace Core;

class Transformer {
	/**
	 * Transform NotORM object results to array
	 * 
	 * @param  Object $objects
	 * @return array
	 */
	public static function objectsToArray($objects) {
		$arrayResult = [];;
		foreach ($objects as $object) {
			array_push($arrayResult, $object);
		}

		return $arrayResult;
	}
}
