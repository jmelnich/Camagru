<?php
class ImageValidation {
	private $_passed = false,
			$_errors = array(),
			$_db = null;

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
								$this->addError("{$fieldName} must be a minimum of {$content} bytes");
							}
							break;
						case 'max':
							if (strlen($value) > $content) {
								$this->addError("{$fieldName} must be a maximum of {$content} bytes");
							}
							break;
						case 'type':
							if ($value !== 'image/jpg' && $value !=='image/jpeg' && $value !== 'image/png' && $value !== 'image/gif') {
								$this->addError("{$fieldName} should be png, jpg or gif only");
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