<?php

class Book
{
//Properties
    private $id;
    private $title;
    private $author;
    private $isAvailable;

// Methods

    public function __construct($id, $title, $author, $isAvailable)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->isAvailable = $isAvailable;
    }

    public function markAsBorrowed()
    {
        $this->isAvailable = false;
    }
    public function markAsReturned()
    {
        $this->isAvailable = true;
    }
    public function getId()
    {
        return $this->id;
    }
    public function isAvailable()
    {
        return $this->isAvailable;
    }

}