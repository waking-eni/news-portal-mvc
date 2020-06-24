<?php

require_once __DIR__.'/../config/database.php';

class CommentsController {

    public function connect()
    {
        $db = Database::getInstance();
        return $db;
    }

    /* select comments */
    public function selectComment($id) {
        $controller = $this->connect();
        $sql = "SELECT id, username, content FROM comments WHERE news_id = ? LIMIT 2;";
        $result = $controller->oneParamRecord($sql, $id);
        return $result;
    }

    /* insert comment */
    public function insertComment($values) {
        $controller = $this->connect();
        $sql = "INSERT INTO comments (username, content, news_id) 
                VALUES (?, ?, ?);";
        $type = 'sss';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* update comment */
    public function updateComment($values) {
        $controller = $this->connect();
        $sql = "UPDATE comments SET content = ? WHERE id = ?;";
        $type = 's';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* delete comment */
    public function deleteComment($id) {
        $controller = $this->connect();
        $sql = "DELETE FROM comments WHERE id = ?;";
        $controller->oneParamRecord($sql, $id);
    }
}
