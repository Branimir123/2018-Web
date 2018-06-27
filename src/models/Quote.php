<?php
namespace models;

use libs\Db;
use models\Category;

class Quote implements \JsonSerializable
{
    private $id;
    private $title;
    private $date_added;
    private $author_id;
    private $quote_text;
    private $category_id;
    private $category_name;

    public function __construct()
    {

    }

    public static function create($title, $quote_text, $author_id, $category_id)
    {
        $current_date = date("Y-m-d h:i:sa");

        $instance = new self();
        $instance->setTitle($title);
        $instance->setQuoteText($quote_text);
        $instance->setAuthorId($author_id);
        $instance->setDateAdded($current_date);
        $instance->setCategoryId($category_id);

        return $instance;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }
    
    public function setDateAdded($date_added){
        $this->date_added = $date_added;
    }

    public function getDateAdded(){
        return $this->date_added;
    }

    public function setQuoteText($quote_text) {
        $this->quote_text = $quote_text;
    }

    public function getQuoteText() {
        return $this->quote_text;
    }

    public function setAuthorId($author_id) {
        $this->author_id = $author_id;
    }

    public function getAuthorId() {
        return $this->author_id;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }
    public function getCategoryId() {
        return $this->category_id;
    }

    public function setCategoryName($category_name) {
        $this->category_name = $category_name;
    }
    
    public function getCategoryName() {
        return $this->category_name;
    }
    
    public function getById($id)
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM quotes WHERE id = '$id'");
        $query->execute();
        $quote = new Quote();
        while ($foundQuote = $query->fetch()) {
            $category_name = Category::getById($foundQuote['category_id'])->getCategoryName();

            $quote->setId($foundQuote['id']);
            $quote->setTitle($foundQuote['title']);
            $quote->setDateAdded($foundQuote['date_added']);
            $quote->setAuthorId($foundQuote['author_id']);
            $quote->setQuoteText($foundQuote['quote_text']);
            $quote->setCategoryName($category_name);
        }

        return $quote;
    }

    public function getAllQuotes()
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM quotes");
        $query->execute();
        $quotes = [];

        while ($foundQuote = $query->fetch())
        {
            $category_name = Category::getById($foundQuote['category_id'])->getCategoryName();
            $quote =  new Quote();
            $quote->setId($foundQuote['id']);
            $quote->setTitle($foundQuote['title']);
            $quote->setDateAdded($foundQuote['date_added']);
            $quote->setAuthorId($foundQuote['author_id']);
            $quote->setQuoteText($foundQuote['quote_text']);
            $quote->setCategoryId($foundQuote['category_id']);
            $quote->setCategoryName($category_name);

            $quotes[] = $quote;
        }

        return $quotes;  
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `quotes` (date_added, author_id, quote_text, title, category_id) VALUES (?, ?, ?, ?, ?) ");
        return $query->execute([$this->date_added, $this->author_id, $this->quote_text, $this->title, $this->category_id]);
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