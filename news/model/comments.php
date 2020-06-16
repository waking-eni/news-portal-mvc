<?php

/* comments table */

class Comments {

    /* table fields */
    public $id;
    public $content;
    public $newsId;
    public $username;

    /* set default value with constructor */
    function __construct()
    {
        $this->id = 0;
        $this->content = "";
        $this->newsId = "";
        $this->username = "";
    }
}