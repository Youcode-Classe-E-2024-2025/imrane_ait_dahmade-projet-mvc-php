<?php

namespace App\Models;

use app\core\Database;
use PDO;

class Article
{
    private $id;
    private $title;
    private $content;
    private $author;
    private $created_at;
    private $conn;

    public function __construct()
    {
        $this->conn = Database::instance()->getConnection();
    }
   
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    // Setters
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    public function AjouterArticle()
    {
        $requet = "INSERT INTO article (title, content, author, created_at) VALUES (:title, :content, :author, :created_at)";
        $stmt = $this->conn->prepare($requet);  
        
        $stmt->execute([
            ':title' => $this->title,
            ':content' => $this->content,
            ':author' => $this->author,
            ':created_at' => $this->created_at
        ]);
    }

    public function getArticles($idUser)
    {

        $query = "SELECT * FROM article where author_id = :author";


        $stmt = $this->conn->prepare($query);
        $stmt->execute([':author' => $idUser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    
}