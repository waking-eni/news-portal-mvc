<?php

require_once __DIR__.'/modelController.php';

class NewsController {

    public function getController() {
        $controller = new ModelController();
        return $controller;
    }

    /* select all news from the database */
    public function fetchNews($offset, $total_records_per_page) {
        $controller = $this->getController();
        $sql = "SELECT id, title, author, date_added, short_description, picture 
        FROM news ORDER BY date_added DESC LIMIT $offset, $total_records_per_page ;";
        $result = $controller->fetchRecords($sql);
        return $result;
    }

    /* select user */
    public function selectNews($id) {
        $controller = $this->getController();
        $sql = "SELECT title, category, administrator_id, date_added, short_description, 
        content, picture, picture_source FROM news WHERE id = ? ;";
        $result = $controller->oneParamRecord($sql, $id);
        return $result;
    }

    /* insert news */
    public function insertNews($values) {
        $controller = $this->getController();
        $sql = "INSERT INTO news (author, title, category, date_added, content, short_description, picture, picture_source) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $type = 'ssssssbs';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* update news */
    public function updateNews($values) {
        $controller = $this->getController();
        $sql = "UPDATE news SET author = ?, title = ? category = ?, content = ?, short_description = ?, 
                picture = ?, picture_source = ?  WHERE id = ?;";
        $type = 'ssssssss';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* delete news */
    public function deleteNews($id) {
        $controller = $this->getController();
        $sql = "DELETE FROM news WHERE id = ?;";
        $controller->oneParamRecord($sql, $id);
    }

    /* get the number of articles */
    public function getNumOfArticles() {
        $controller = $this->getController();
        $sql = "SELECT id FROM news ;";
        $result = $controller->numRows($sql);
        return $result;
    }

    /* select article by category */
    public function selectArticlesByCat($cat, $offset, $total_records_per_page) {
        $controller = $this->getController();
        $sql = "SELECT id, title, date_added, short_description, author, picture 
        FROM news WHERE category = ? ;";
        $result = $controller->oneParamRecord($sql, $cat);
        return $result;
    }

    public function getNumberOfCategories() {
        $controller = $this->getController();
        $sql = "SELECT DISTINCT category FROM news ;";
        $result = $controller->numRows($sql);
        return $result;
        exit();
    }

    public function getAllCategories() {
        $controller = $this->getController();
        $sql = "SELECT DISTINCT category FROM news ;";
        $result = $controller->fetchRecords($sql);
        return $result;
        exit();
    }
}
