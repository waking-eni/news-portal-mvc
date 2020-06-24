<?php

require_once __DIR__.'/../config/database.php';

class NewsController {

    public function connect()
    {
        $db = Database::getInstance();
        return $db;
    }

    /* select all news from the database */
    public function fetchNews($offset, $total_records_per_page) {
        $controller = $this->connect();
        $sql = "SELECT id, title, author, date_added, short_description, picture 
        FROM news ORDER BY date_added DESC LIMIT $offset, $total_records_per_page ;";
        $result = $controller->fetchRecords($sql);
        return $result;
    }

    /* select user */
    public function selectNews($id) {
        $controller = $this->connect();
        $sql = "SELECT title, category, administrator_id, date_added, short_description, 
        content, picture, picture_source FROM news WHERE id = ? ;";
        $result = $controller->oneParamRecord($sql, $id);
        return $result;
    }

    /* insert news */
    public function insertNews($values) {
        $controller = $this->connect();
        $sql = "INSERT INTO news (author, title, category, date_added, content, short_description, picture, picture_source) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $type = 'ssssssbs';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* update news */
    public function updateNews($values) {
        $controller = $this->connect();
        $sql = "UPDATE news SET author = ?, title = ? category = ?, content = ?, short_description = ?, 
                picture = ?, picture_source = ?  WHERE id = ?;";
        $type = 'ssssssss';
        $controller->arrayParamRecord($sql, $values, $type);
    }

    /* delete news */
    public function deleteNews($id) {
        $controller = $this->connect();
        $sql = "DELETE FROM news WHERE id = ?;";
        $controller->oneParamRecord($sql, $id);
    }

    /* get the number of articles */
    public function getNumOfArticles() {
        $controller = $this->connect();
        $sql = "SELECT id FROM news ;";
        $result = $controller->numRows($sql);
        return $result;
    }

    /* select article by category */
    public function selectArticlesByCat($cat, $offset, $total_records_per_page) {
        $controller = $this->connect();
        $sql = "SELECT id, title, date_added, short_description, author, picture 
        FROM news WHERE category = ? ;";
        $result = $controller->oneParamRecord($sql, $cat);
        return $result;
    }

    public function getNumberOfCategories() {
        $controller = $this->connect();
        $sql = "SELECT DISTINCT category FROM news ;";
        $result = $controller->numRows($sql);
        return $result;
        exit();
    }

    public function getAllCategories() {
        $controller = $this->connect();
        $sql = "SELECT DISTINCT category FROM news ;";
        $result = $controller->fetchRecords($sql);
        return $result;
        exit();
    }
}
