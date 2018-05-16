<?php
class Model {
    public $pdo;
    public function __construct() {
        // $pdo = new Database; !!!!!!!Загрузить новую DB
        // $this->pdo = $pdo;
    }
    // public function loadModel($name) {
    //     $path = 'models/' . ucfirst($name) . 'Model.php';
    //     if (file_exists($path)) {
    //         require 'models/' . ucfirst($name) . 'Model.php';
    //         $modelName = ucfirst($name) . 'Model';
    //         $this->model = new $modelName();
    //     }
    // }

    // public function run($email, $password) {
    //     //$db = new User;
    //     echo "IM RUNNING";
    //     require 'models/LoginModel.php';
    //     $this->call = new LoginModel();
    //     $this->call->getAllUsers();
    //     // PDO Query
    //    // echo ($db->getAllUsers());
    //     // $sql = 'SELECT * FROM users';
    //     // foreach ($this->db->select()->query($sql) as $row) {
    //     //     echo "row['id']" . $row['id'];
    //     // }
    //     //$pdo = null;
    //     // $sth = $this->db->prepare("SELECT id FROM users WHERE email = :email AND password = :password");
    //     // $sth->execute(array(
    //     //     ':email' => $email,
    //     //     ':password' => $password
    //     // ));
    //     // $data = $sth->fetchAll();
    //     // print_r($data);

    //     // $sql = 'SELECT id FROM users';
    //     // foreach ($this->db->$pdo->query($sql) as $row) {
    //     //     echo "row['id']" . $row['id'];
    //     // }
    //     // $this->db = null;
    // }
}