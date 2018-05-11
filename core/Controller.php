<?php

class Controller {
    function __construct() {
        echo 'Main cont ';
        $this->view = new View();
    }
}