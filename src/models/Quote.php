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
    private $author_username;
    private $autor_full_name;
    private $real_author;
    private $likes;

    public function __construct()
    {

    }

    public static function create($title, $quote_text, $author_id, $real_author, $category_id)
    {
        $current_date = date("Y-m-d h:i:sa");

        $instance = new self();
        $instance->setTitle($title);
        $instance->setQuoteText($quote_text);
        $instance->setAuthorId($author_id);
        $instance->setDateAdded($current_date);
        $instance->setCategoryId($category_id);
        $instance->setRealAuthor($real_author);
        $instance->setLikes(0);

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

    public function setAuthorUsername($author_username) {
        $this->author_username = $author_username;
    }
    
    public function getAuthorUsername() {
        return $this->author_username;
    }

    public function setAuthorFullName($author_full_name) {
        $this->author_full_name = $author_full_name;
    }
    
    public function getAuthorFullName() {
        return $this->author_full_name;
    }
    
    public function setRealAuthor($real_author) {
        $this->real_author = $real_author;
    }

    public function getRealAuthor() {
        return $this->real_author;
    }
    
    public function setLikes($likes) {
        $this->likes = $likes;
    }

    public function getLikes() {
        return $this->likes;
    }

    public function getById($id)
    {
        $query = (new Db())->getConn()->prepare("SELECT q.*, u.username, u.full_name, c.category_name
            FROM quotes q 
            JOIN users u ON q.author_id = u.id 
            JOIN categories c ON q.category_id = c.id"
        );

        $query->execute();
        $quote = new Quote();
        while ($foundQuote = $query->fetch()) {
            $quote =  new Quote();
            $quote->setId($foundQuote['id']);
            $quote->setTitle($foundQuote['title']);
            $quote->setDateAdded($foundQuote['date_added']);
            $quote->setAuthorId($foundQuote['author_id']);
            $quote->setQuoteText($foundQuote['quote_text']);
            $quote->setCategoryId($foundQuote['category_id']);
            $quote->setAuthorUsername($foundQuote['username']);
            $quote->setAuthorFullName($foundQuote['full_name']);
            $quote->setCategoryName($foundQuote['category_name']);
            $quote->setRealAuthor($foundQuote['real_author']);
            $quote->setLikes($foundQuote['likes']);
        }

        return $quote;
    }

    public function getAllQuotes()
    {
        $query = (new Db())->getConn()->prepare("SELECT q.*, u.username, u.full_name, c.category_name
            FROM quotes q 
            JOIN users u ON q.author_id = u.id 
            JOIN categories c ON q.category_id = c.id"
        );

        $query->execute();
        $quotes = [];

        while ($foundQuote = $query->fetch())
        {
            $quote =  new Quote();
            $quote->setId($foundQuote['id']);
            $quote->setTitle($foundQuote['title']);
            $quote->setDateAdded($foundQuote['date_added']);
            $quote->setAuthorId($foundQuote['author_id']);
            $quote->setQuoteText($foundQuote['quote_text']);
            $quote->setCategoryId($foundQuote['category_id']);
            $quote->setAuthorUsername($foundQuote['username']);
            $quote->setAuthorFullName($foundQuote['full_name']);
            $quote->setCategoryName($foundQuote['category_name']);
            $quote->setRealAuthor($foundQuote['real_author']);
            $quote->setLikes($foundQuote['likes']);

            $quotes[] = $quote;
        }

        return $quotes;  
    }

    public function getAllQuotesOrderedByDate()
    {
        $query = (new Db())->getConn()->prepare("SELECT q.*, u.username, u.full_name, c.category_name
            FROM quotes q 
            JOIN users u ON q.author_id = u.id 
            JOIN categories c ON q.category_id = c.id
            ORDER BY q.date_added DESC"
        );

        $query->execute();
        $quotes = [];

        while ($foundQuote = $query->fetch())
        {
            $quote =  new Quote();
            $quote->setId($foundQuote['id']);
            $quote->setTitle($foundQuote['title']);
            $quote->setDateAdded($foundQuote['date_added']);
            $quote->setAuthorId($foundQuote['author_id']);
            $quote->setQuoteText($foundQuote['quote_text']);
            $quote->setCategoryId($foundQuote['category_id']);
            $quote->setAuthorUsername($foundQuote['username']);
            $quote->setAuthorFullName($foundQuote['full_name']);
            $quote->setCategoryName($foundQuote['category_name']);
            $quote->setRealAuthor($foundQuote['real_author']);
            $quote->setLikes($foundQuote['likes']);

            $quotes[] = $quote;
        }

        return $quotes;  
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `quotes` (date_added, author_id, quote_text, title, real_author, category_id, likes) VALUES (?, ?, ?, ?, ?, ?, ?) ");
        return $query->execute([$this->date_added, $this->author_id, $this->quote_text, $this->title, $this->real_author, $this->category_id, 0]);
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

    public function like(){
        $query = (new Db())->getConn()->prepare("UPDATE quotes SET likes=? WHERE id=?");
        return $query->execute([$this->getLikes() + 1, $this->id]);
    }

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}