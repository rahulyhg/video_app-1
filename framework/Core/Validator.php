<?php

namespace Core;
use \Filterus;

class Validator {
	/**
	 * Calls a validator with a given validation string.
	 * 
	 * @return object
	 */
	public static function make($validationgString = "") {
		$filter = Filterus\Filter::factory($validationgString);
		return $filter;
	}
}
