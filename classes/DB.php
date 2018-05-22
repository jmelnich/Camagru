<?php
class DB {
	private static $_instance = null;
	private $_pdo,
			$_query,
			$_error = false,
			$_results,
			$_result,
			$_count = 0;

	/* this is run when the class is instantiated. We cannot call it twice.
	Using DB::getInstance();*/
	private function __construct() {
		try {
			$DSN = 'mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db') . ';charset=utf8';
			$this->_pdo = new PDO($DSN, Config::get('mysql/username'), Config::get('mysql/password'));
			echo "connected";
			// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// return $_pdo;
		} catch (PDOException $e) {
			echo "Connection failed " . $e->getMessage(). '<br>';
			die();
		}
	}

	public static function getInstance() {
		/* check if insatnce is not set (but default, it is not),
		use self because of static */
		if (!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	/* $user = DB::getInstance()->query("SELECT username FROM users WHERE username = ?", array('julia')); */
	public function query($sql, $params = array()) {
		$this->_error = false;
		if ($this->_query = $this->_pdo->prepare($sql)) {
			if(count($params)) {
				$x = 1;
				foreach ($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			if ($this->_query->execute()) {
				/* Query is succesful (the bd exists, the table exists*/
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
				if ($this->_count > 0) {
					/* it found the name/email whatever in db */
					return $this;
				} else {
					$this->_error = true;
				}
			}
		}
		return $this;
	}

	private function action($action, $table, $where = array()) {
		/* check if we pass field, operator and value */
		if(count($where) === 3) {
			$operators = array('=', '>', '<', '>=', '<=');
			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];
		} else {
			echo 'Not valid usage of method arguments. Check requrements';
			return false;
		}
		if (in_array($operator, $operators)) {
			/* if it is, construct our query */
			$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
			if (!$this->query($sql, array($value))->error()) {
				return $this;
			}
		}
		return $this;
	}

	/* This function make use of private ACTION method.
	$user = DB::getInstance()->get('users', array('username', '=', 'julia')); */
	public function get($table, $where) {
		return $this->action('SELECT *', $table, $where);
	}

	/* $user = DB::getInstance()->delete('users', array('username', '=', 'julia')); */
	public function delete($table, $where) {
		return $this->action('DELETE', $table, $where);
	}

	/* returns an array of users/ one / nothing */
	public function results() {
		return $this->_results;
	}

	/* returns the first value of the array from result method */
	public function first() {
		return $this->results()[0];
	}

	public function error() {
		return $this->_error;
	}

	public function count() {
		return $this->_count;
	}

	/* $user = DB::getInstance()->insert('users', array(
		'email' => "test@gmail.com",
		'username' => "abc",
		'pass' => "123",
	)); */
	public function insert($table, $fields = array()) {
		if (count($fields)) {
			$keys = array_keys($fields);
			$values = null;
			$x = 1;
			foreach ($fields as $field) {
				//print_r( "<br/>" . $field . "<br/>");
				$values .= '?';
				if ($x < count($fields)) {
					$values .= ', ';
				}
				$x++;
			}
			$sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) ."`) VALUES ({$values})";
			if($this->query($sql, $fields)->error()) {
				return true;
			}
		}
		return $this; //changed from $this
	}

	/* update user info by id. Usage:
		$user = DB::getInstance()->updateById('users', 2, array(
		'username' => "ivan",
	)); */
	public function updateById($table, $id, $fields) {
		if (count($fields)) {
			$set = '';
			$x = 1;
			foreach ($fields as $name => $value) {
				$set .= "{$name} = ?";
				if ($x < count($fields)) {
					$set .= ',';
				}
				$x++;
			}
			$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
			if($this->query($sql, $fields)->error()) {
				return true;
			}
		}
		return $this;
	}

	/* update user info by email. Usage:
		$user = DB::getInstance()->updateByEmail('users', 'julyettka@gmail.com', array(
		'activation' => '1'
	)); */
	public function updateByEmail($table, $email, $fields) {
		if (count($fields)) {
			$set = '';
			$x = 1;
			foreach ($fields as $name => $value) {
				$set .= "{$name} = ?";
				if ($x < count($fields)) {
					$set .= ', ';
				}
				$x++;
			}
			$sql = "UPDATE {$table} SET {$set} WHERE email = '$email'";
			if($this->query($sql, $fields)->error()) {
				return true;
			}
		}
		return $this;
	}

}