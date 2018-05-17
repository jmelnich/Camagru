<?php
class Validation {
	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct() {
		echo "<br/>Validation in it<br/>";
		$this->_db = DB::getInstance();
	}
	public function check(Array $source, Array $items = array()) {
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $content) {
				$value = trim($source[$item]);
				if ($rule === 'name') {
					$fieldName = $content;
				}
				if ($rule === 'required' && empty($value)) {
					$this->addError("{$fieldName} is required");
				} else if (!empty($value)) {
					switch ($rule) {
						case 'min':
							if (strlen($value) < $content) {
								$this->addError("{$fieldName} must be a minimum of {$content} characters");
							}
							break;
						case 'max':
							if (strlen($value) > $content) {
								$this->addError("{$fieldName} must be a maximum of {$content} characters");
							}
							break;
						case 'matches':
							if ($value != $source[$content]) {
								$this->addError("{$fieldName} must match {$content} characters");
							}
							break;
						case 'unique':
							$check = $this->_db->get($content, array($item, '=', $value));
							if ($check->count()) {
								$this->addError("{$fieldName} is already taken");
							}
							break;
						case 'valid':
							if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
								$this->addError("{$fieldName} should be valid");
							}
							break;
						case 'complex':
							if (!preg_match("#[0-9]+#", $value)) {
								$this->addError("Password must include at least one number");
							}
							if (!preg_match("#[a-z]+#", $value)) {
								$this->addError("Password must include at least one letter");
							}
							break;
						default:
							# code...
							break;
					}
				}
			}
		}
		if (empty($this->_errors)) {
			$this->_passed = true;
		}
	}

	public function addError($errorText) {
		$this->_errors[] = $errorText;
	}

	public function getErrors() {
		return $this->_errors;
	}

	public function passed() {
		return $this->_passed;
	}
}