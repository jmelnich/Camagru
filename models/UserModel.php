<?php
class UserModel extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function getAllUsers() {
    	$sql = "SELECT * from users";
		$stmt =$this->pdo->connect()->query($sql);
		while ($row = $stmt->fetch()) {
			$uid = $row['id'];
			echo "all users" . $uid;
			return $uid;
		}
	}

	public function addUser($user) {
		$sql = "INSERT INTO users (email, username, pass)
		VALUES  ($user->email, $user->name, $user->pass);";
		$this->pdo->insert($sql);
	}

	public function checkUserData($email, $password) {
		echo $password;
		// $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
		// $stmt = $this->pdo->connect()->query($sql);
		// $result = $stmt->prepare($sql);
		// $result->bindParam(':email', $email, PDO::PARAM_INT);
		// $result->bindParam(':password', $password, PDO::PARAM_INT);
		// $result->execute();

		// $user=$result->fetch();
		// if ($user) {
		// 	echo "here is " .  $user['id'];
		// 	return $user['id'];
		// }
		return false;
	}
}