<?php
class Database {
    public function __consrtuct(){
        parent::__consrtuct('mysql:host=localhost;dbname=camagru', 'root', 'castle7');
    }
}