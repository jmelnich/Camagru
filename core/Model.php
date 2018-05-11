<?php
class Model {
    public $pdo;
    function __constuct() {
        $this->pdo = new Database();
    }
}