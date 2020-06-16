<?php

require_once __DIR__.'/modelController.php';

class CommentsController {

    public function getController() {
        $controller = new ModelController();
        return $controller;
    }

    /* select comments */
    public function selectComment($id) {
        $controller = $this->getController();
        $sql = "SELECT id, username, content FROM comments WHERE news_id = ? ;";
        $result = $controller->oneParamRecord($sql, $id);
        return $result;
    }

    /* insert comment */
    public function insertComment($values) {
        $controller = $this->getController();
        $sql = "INSERT INTO comments (username, content, news_id) 
                VALUES (?, ?, ?);";
        $type = 'sss';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* update comment */
    public function updateComment($values) {
        $controller = $this->getController();
        $sql = "UPDATE comments SET content = ? WHERE id = ?;";
        $type = 's';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* delete comment */
    public function deleteComment($id) {
        $controller = $this->getController();
        $sql = "DELETE FROM comments WHERE id = ?;";
        $controller->oneParamRecord($sql, $id);
    }
}