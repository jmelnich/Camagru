<?php
class Database {
    public function connect() {
      require 'config/database.php';
        try {
			$pdo = new PDO($DSN, $USER, $PASSWORD);
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