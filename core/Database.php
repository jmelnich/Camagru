<?php
class Database {
    public function connect() {
    	$host = 'localhost';
    	$dbname = 'camagru';
    	$user = 'root';
    	$password = 'castle7';
    	// Set DSN
    	$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
        try {
			$pdo = new PDO($dsn, $user, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e) {
			echo "Connection failed " . $e->getMessage(). '<br>';
			die();
		}
		// // PDO Query
		// $sql = 'SELECT * FROM users';
  //       foreach ($pdo->query($sql) as $row) {
  //           echo "row['id']" . $row['id'];
  //       }
  //       $pdo = null;
    }
}