<?php

require_once __DIR__.'/../config/database.php';

class AdminController {

    public function connect()
    {
        $db = Database::getInstance();
        return $db;
    }

    /* login check */
    public function checkLogin($values) {
        $controller = $this->connect();
        $sql = "SELECT id, username, password FROM admin WHERE username = ? OR email = ? ;";
        $type = 'ss';
        $result = $controller->arrayParamRecord($sql, $values, $type);
        return $result;
    }

}