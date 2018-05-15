<?php
class View {
    function __construct() {
    }
    public function render($name, $data = null) {
        require 'views/includes/header.php';
        require 'views/' . $name . '.php';
        require 'views/includes/footer.php';
    }
}