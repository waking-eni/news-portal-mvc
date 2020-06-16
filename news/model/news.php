<?php

/* news table */

class News {

    /* table fields */
    public $id;
    public $author;
    public $title;
    public $category;
    public $dateAdded;
    public $content;
    public $shortDesc;
    public $picture;
    public $pictureSrc;

    /* set default value with constructor */
    function __construct()
    {
        $this->id = 0;
        $this->author = "";
        $this->title = "";
        $this->category = "";
        $this->dateAdded = "";
        $this->content = "";
        $this->shortDesc = "";
        $this->picture = "";
        $this->pictureSrc = "";
    }
}