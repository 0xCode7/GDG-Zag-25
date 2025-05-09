<?php
require_once 'db.php';

class Library
{
    private $conn;
    private $books = [];

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->loadBooks();
    }

    public function loadBooks()
    {
        $stmt = $this->conn->query("SELECT * FROM books");
        $this->books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBook($title, $author)
    {
        $stmt = $this->conn->prepare("INSERT INTO books (title, author, isAvailable) VALUES (:title, :author, 1)");
        $stmt->execute(['title' => $title, 'author' => $author]);

        $this->loadBooks();
        $_SESSION['success'] = "Book Added Successfully";
    }

    public function removeBook($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM books WHERE id = :id");
            $stmt->execute(['id' => $id]);

            if ($stmt->rowCount() > 0) {
                $_SESSION['success'] = "Book Deleted Successfully";
            } else {
                $_SESSION['error'] = "No book found with ID: $id";
            }

            $this->loadBooks();
        } catch (Exception $e) {
            $_SESSION['error'] = "Failed to delete book: " . $e->getMessage();
        }
    }


    public function listAvailableBooks()
    {
        $availableBooks = [];
        foreach ($this->books as $book) {
            if ($book['isAvailable']) {
                $availableBooks[] = $book;
            }
        }
        return $availableBooks;
    }

    public function listBorrowedBooks()
    {
        $borrowedBooks = [];
        foreach ($this->books as $book) {
            if (!$book['isAvailable']) {
                $borrowedBooks[] = $book;
            }
        }
        return $borrowedBooks;
    }

    public function getBooks()
    {
        return $this->books;
    }

    public function findBook($keyword)
    {
        $stmt = $this->conn->prepare("SELECT * FROM books WHERE title LIKE :keyword OR author LIKE :keyword");
        $stmt->execute(['keyword' => "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatus($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function updateBookStatus($id, $status)
    {
        $stmt = $this->conn->prepare("UPDATE books SET isAvailable = :status WHERE id = :id");
        $stmt->execute(['id' => $id, 'status' => !$status]);
        $this->loadBooks();
        if ($status) {
            $_SESSION['success'] = "Book Returned Successfully";
        }else{
                $_SESSION['success'] = "Book Borrowed Successfully";

        }
        header('Location: index.php');
    }

}