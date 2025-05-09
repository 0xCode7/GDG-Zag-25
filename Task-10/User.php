<?php

class User
{
    private $id;
    private $name;
    private $borrowedBooks = [];

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function borrowBook($book, $library)
    {
        if ($book->isAvailable()) {
            $library->updateBookStatus($book->getId(), false);
            $this->borrowedBooks[] = $book;
            $_SESSION['success'] = "$book->title Borrowed Successfully";
        } else {
             $_SESSION['error'] = "Book is not available";
        }
    }

    public function returnBook($book, $library)
    {
        foreach ($this->borrowedBooks as $key => $borrowedBook) {
            if ($borrowedBook->getId() == $book->getId()) {
                unset($this->borrowedBooks[$key]);
                $library->updateBookStatus($book->getId(), true);
                $_SESSION['success'] = "$book->title Returned Successfully";
                return;
            }
        }
        $_SESSION['error'] = "You haven't borrowed this book.";

    }
}