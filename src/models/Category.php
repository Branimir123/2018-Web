<?php
namespace models;

use libs\Db;

class Category implements \JsonSerializable
{
    private $id;
    private $category_name;

    public function __construct()
    {

    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    public function getCategoryName()
    {
        return $this->category_name;
    }

    public function getById($id)
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM categories WHERE id = '$id'");
        $query->execute();
        $category = new Category();
        while ($foundCategory = $query->fetch()) {
            $category->setId($foundCategory['id']);
            $category->setCategoryName($foundCategory['category_name']);
        }

        return $category;
    }

    public function getByName($category_name)
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM categories WHERE category_name = '$category_name'");
        $query->execute();
        $category = new Category();
        while ($foundCategory = $query->fetch()) {
            $category->setId($foundCategory['id']);
            $category->setCategoryName($foundCategory['category_name']);
        }

        return $category;
    }
   
    public function getAllCategories() {
        $query = (new Db())->getConn()->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = [];

        while ($foundCategory = $query->fetch())
        {
            $category =  new Category();
            $category->setId($foundCategory['id']);
            $category->setCategoryName($foundCategory['category_name']);

            $categories[] = $category;
        }

        return $categories; 
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `quotes` (date_added, author_id, quote_text, title) VALUES (?, ?, ?, ?) ");
        return $query->execute([$this->date_added, $this->author_id, $this->quote_text, $this->title]);
    }

    public static function delete($id)
    {
        $query = (new Db())->getConn()->prepare("DELETE FROM quotes WHERE id=?");
        
        return $query->execute([$id]);
    }

    public static function edit($id, $quote_text, $title)
    {
        $query = (new Db())->getConn()->prepare("UPDATE quotes SET title=?, quote_text=? WHERE id=?");
        return $query->execute([$title, $quote_text]);
    }

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}