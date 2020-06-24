<?php

require_once __DIR__.'/../config/database.php';

class UserController {

    public function connect()
    {
        $db = Database::getInstance();
        return $db;
    }

    /* select all users from the database */
    public function fetchUsers($offset, $total_records_per_page) {
        $controller = $this->connect();
        $sql = "SELECT id, username, email, password FROM user
        ORDER BY id DESC LIMIT $offset, $total_records_per_page;";
        $result = $controller->fetchRecords($sql);
        return $result;
    }

    /* select user */
    public function selectUser($id) {
        $controller = $this->connect();
        $sql = "SELECT id, username, email FROM user WHERE id = ?;";
        $result = $controller->oneParamRecord($sql, $id);
        return $result;
    }

    /* insert user */
    public function insertUser($values) {
        $controller = $this->connect();
        $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?);";
        $type = 'sss';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* update user */
    public function updateUser($values) {
        $controller = $this->connect();
        $sql = "UPDATE user SET username = ?, password = ? email = ?  WHERE id = ?;";
        $type = 'sss';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* delete user */
    public function deleteUser($id) {
        $controller = $this->connect();
        $sql = "DELETE FROM user WHERE id = ?;";
        $controller->oneParamRecord($sql, $id);
    }

    /* check username */
    public function checkUsername($username) {
        $controller = $this->connect();
        $sql = "SELECT id, username, password FROM user WHERE username = ?;";
        $result = $controller->oneParamRecord($sql, $username);
        return $result;
    }

    /* login check */
    public function checkLogin($values) {
        $controller = $this->connect();
        $sql = "SELECT id, username, password FROM user WHERE username = ? OR email = ? ;";
        $type = 'ss';
        $result = $controller->arrayParamRecord($sql, $values, $type);
        return $result;
    }

    /* get the number of users */
    public function getNumOfUsers() {
        $controller = $this->connect();
        $sql = "SELECT id FROM user ;";
        $result = $controller->numRows($sql);
        return $result;
    }

}