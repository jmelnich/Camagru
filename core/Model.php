<?php
class Model {
    function __construct() {
        echo "<br/>**** Model ****<br/>";
        $this->db = new Database();
    }
    public function loadModel($name) {
        //echo "11";
        $path = 'models/' . ucfirst($name) . 'Model.php';
        if (file_exists($path)) {
            require 'models/' . ucfirst($name) . 'Model.php';
            $modelName = ucfirst($name) . 'Model';
            $this->model = new $modelName();
        }
    }
    public function run() {
        echo "IM RUNNING";
        $login = $_POST['login'];
        $password = $_POST['password'];
        $sth = $this->db->prepare("SELECT id FROM users WHERE login = :login AND password = :password");
        $sth->execute(array(
            ':login' => $login,
            ':password' => $password
        ));
        $data = $sth->fetchAll();
        print_r($data);
    }
}