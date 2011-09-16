<?php
/*
 * Configure defaults below. Possible values are:
 *
 * DEFAULT_SIMPLE_SANITIZE_SECURITY_LEVEL
 * - Determines the level of sanitization to perform on input
 *
 *		strict		- Removes all characters that are not alphanumeric (a-z, 0-9)
 *		both		- Performs html and sql conversions (described below; html first, then sql)
 *		html		- Converts all characters used in html into safe entities
 *		mysql		- Sanitizes input to be safely inserted into a mysql database
 *		none		- No sanitation. String/number size limitations can still apply
 *
 * DEFAULT_SIMPLE_SANITIZE_DATA_TYPE
 * - Determines where to find the data
 *
 *		post		- Retrieves POST data
 *		get			- Retrieves GET data
 *		request		- Rtrieves data from PHP's $_REQUEST global variable
 *
 * DEFAULT_SIMPLE_SANITIZE_LIMIT
 * - Determines the max string length or max numerical number allowed. Requires a numerical value
 *
 *		< 0			- No limit
 *		= 0			- No limit
 *		> 0			- Limit on strings/numbers
 */

define('DEFAULT_SIMPLE_SANITIZE_SECURITY_LEVEL', 'strict');

define('DEFAULT_SIMPLE_SANITIZE_DATA_TYPE', 'post');

define('DEFAULT_SIMPLE_SANITIZE_LIMIT',	0);


###########################################################
##
## DO NOT EDIT BELOW UNLESS YOU KNOW WHAT YOU ARE DOING!
##
###########################################################

class SimpleSanitize {
	private $data;		// Data source; Either $_POST, $_GET, or $_REQUEST
	private $level;		// Level of sanitization to perform
	private $limit;		// Max string length or highest number value

	function  __construct($data_type = null, $level = null, $limit = null) {
		if (is_numeric($level)) {
			$temp_limit = $limit;
			$limit      = $level;
			$level      = $temp_limit;
		}
		$this->setDataType(($data_type === null) ? DEFAULT_SIMPLE_SANITIZE_DATA_TYPE:$data_type);
		$this->setLevel(($level === null) ? DEFAULT_SIMPLE_SANITIZE_SECURITY_LEVEL:$level);
		$this->setLimit(($limit === null) ? DEFAULT_SIMPLE_SANITIZE_LIMIT:$limit);
	}

	function setDataType($data_type) {
		switch ($data_type) {
			case 'post':
				$this->data = $_POST;
				break;
			case 'get':
				$this->data = $_GET;
				break;
			case 'request':
				$this->data = $_REQUEST;
				break;
			default:
				throw new Exception('Invalid construct parameter: data_type');
		}
	}

	function setLevel($level) {
		switch ($level) {
			case 'strict':
			case 'mysql':
			case 'html':
			case 'both':
			case 'none':
				$this->level = $level;
				break;
			default:
				throw new Exception('Invalid construct parameter: level');
		}
	}

	function setLimit($limit) {
		if(!is_numeric($limit))
			throw new Exception('Invalid limit. Must be a numerical value.');

		$this->limit = $limit;
	}

	function get($name = null, $level = null, $limit = null) {
		return $this->getData($name, 'string', $level, $limit);
	}

	function getInt($name = null, $limit = null) {
		return $this->getData($name, 'int', null, $limit);
	}

	function getFloat($name = null, $limit = null) {
		return $this->getData($name, 'float', null, $limit);
	}

	function getBoolean($name = null) {
		return $this->getData($name, 'boolean', null, 0);
	}

	function untouched($name = null) {
		if($name === null)
			return $this->data;
		else
			return $this->data[$name];
	}

	private function getData($name, $type, $level, $limit) {
		if(is_numeric($level)) {
			$temp_limit = $limit;
			$limit = $level;
			$level = $temp_limit;
		}

		if($limit != null && !is_numeric($limit))
			throw new Exception('Invalid limit. Must be a numeric value.');

		if($name === null)
			$input = $this->data;
		else if(!isset($this->data[$name]))
			return null;
		else
			$input = $this->data[$name];

		$apply_limit = ($limit === null) ? $this->limit:$limit;
		$apply_level = ($level === null) ? $this->level:$level;

		return $this->cleanUp($input, $type, $apply_level, $apply_limit);
	}

	private function cleanUp($input, $type, $level, $limit) {
		if (is_array($input)) {
			foreach ($input as $k => $val) {
				$input[$k] = $this->cleanUp($val, $type, $level, $limit);
			}
			return $input;
		} else if ($type == 'string' || $type == 'boolean') {
			$trimmed = trim($input);

			if(get_magic_quotes_gpc())
				$trimmed = stripslashes($trimmed);

			if ($limit > 0)
				$trimmed = substr($trimmed, 0, $limit);

			return $this->sanitize($trimmed, $type, 0, $level);
		} else {
			return $this->sanitize($input, $type, $limit);
		}
	}

	private function sanitize($input, $type, $limit = 0, $level = null) {
		switch ($type) {
			case 'int':
				$num = (int)$input;
				break;
			case 'float':
				$num = (float)$input;
				break;
			case 'boolean':
				return (strtolower($input) == 'true') || ($input == '1');
			default:
				return $this->sanitizeString($input, $level);
		}

		if($limit > 0 && $num > $limit)
			return $limit;
		else
			return $num;
	}

	private function sanitizeString($input, $level) {
		switch($level) {
			case 'strict':
				$input = preg_replace('/[^a-zA-Z0-9_-]/', '', $input);
				break;
			case 'both':
			case 'html':
				$input = htmlentities($input, ENT_QUOTES);
				if($level == 'html')
					break;
			case 'mysql':
				$input = $this->mysqlSafe($input);
			case 'none':
				break;
			default:
				throw new Exception('Invalid level. Possible values: strict, both, html, mysql, none.');
		}

		return $input;
	}

	private function mysqlSafe($input) {
		$search = array("\\", "\x00", "\x1a", "\n", "\r", "'", '"');
		$replace = array('\\\\', '\0', '\Z', '\n', '\r', "\'", '\"');

		return str_replace($search, $replace, $input);
	}
}
?>
