<?php
class Controller {
    function __construct() {
        echo ' *** Main controller ****'; //all controllers share
        $this->view = new View();
        $this->model = new Model();
    }

}