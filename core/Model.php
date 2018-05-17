<?php
class Model {
    private $_db = null;
    public function __construct() {
        $this->_db = DB::getInstance();
    }
}