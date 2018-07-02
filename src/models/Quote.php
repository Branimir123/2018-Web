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
        $query = (new Db())->getConn()->prepare("SELECT q.*, u.username, u.full_name, c.category_name, l.*, count(l.user_id) as likesCount
            FROM quotes q 
            JOIN users u ON q.author_id = u.id 
            JOIN categories c ON q.category_id = c.id
            JOIN likes l ON q.id = l.quote_id
            WHERE q.id = $id"
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
            $quote->setLikes($foundQuote['likesCount']);
        }

        return $quote;
    }

    public function getAllQuotes()
    {
        $query = (new Db())->getConn()->prepare("SELECT q.*, u.username, u.full_name, c.category_name, count(l.user_id) as likesCount
            FROM quotes q 
            JOIN users u ON q.author_id = u.id 
            JOIN categories c ON q.category_id = c.id
            LEFT JOIN likes l ON q.id = l.quote_id
            GROUP BY q.id"
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
            $quote->setLikes($foundQuote['likesCount']);

            $quotes[] = $quote;
        }

        return $quotes;  
    }

    public function getAllQuotesOrderedByDate()
    {
        $query = (new Db())->getConn()->prepare("SELECT q.*, u.username, u.full_name, c.category_name, count(l.user_id) as likesCount
            FROM quotes q 
            JOIN users u ON q.author_id = u.id 
            JOIN categories c ON q.category_id = c.id
            LEFT JOIN likes l ON q.id = l.quote_id
            GROUP BY q.id
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
            $quote->setLikes($foundQuote['likesCount']);

            $quotes[] = $quote;
        }

        return $quotes;  
    }

    public function getMostLiked()
    {
        $query = (new Db())->getConn()->prepare("SELECT q.*, u.username, u.full_name, c.category_name, count(l.user_id) as likesCount
            FROM quotes q 
            JOIN users u ON q.author_id = u.id 
            JOIN categories c ON q.category_id = c.id
            LEFT JOIN likes l ON q.id = l.quote_id
            GROUP BY q.id
            ORDER BY likesCount DESC"
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
            $quote->setLikes($foundQuote['likesCount']);

            $quotes[] = $quote;
        }

        return $quotes;  
    }

    public function getUserQuotes($user_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT q.*, u.username, u.full_name, c.category_name, count(l.user_id) as likesCount
            FROM quotes q 
            JOIN users u ON q.author_id = u.id 
            JOIN categories c ON q.category_id = c.id
            LEFT JOIN likes l ON q.id = l.quote_id
            WHERE q.author_id = $user_id
            GROUP BY q.id"
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
            $quote->setLikes($foundQuote['likesCount']);

            $quotes[] = $quote;
        }

        return $quotes;  
    }

    public function getByCategory($category_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT q.*, u.username, u.full_name, c.category_name, count(l.user_id) as likesCount
            FROM quotes q 
            JOIN users u ON q.author_id = u.id 
            JOIN categories c ON q.category_id = c.id
            LEFT JOIN likes l ON q.id = l.quote_id
            WHERE q.category_id = $category_id
            GROUP BY q.id
            ORDER BY likesCount DESC"
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
            $quote->setLikes($foundQuote['likesCount']);

            $quotes[] = $quote;
        }

        return $quotes;  
    }

    public function insert()
    {
        $db = (new Db())->getConn();
        $query = $db->prepare("INSERT INTO `quotes` (date_added, author_id, quote_text, title, real_author, category_id, likes) VALUES (?, ?, ?, ?, ?, ?, ?) ");
        
        $query->execute([$this->date_added, $this->author_id, $this->quote_text, $this->title, $this->real_author, $this->category_id, 0]);

        return $db->lastInsertId();
    }

    public static function delete($id)
    {
        $deleteLikes = (new Db())->getConn()->prepare("DELETE FROM likes WHERE quote_id = $id");
        $deleteQuote = (new Db())->getConn()->prepare("DELETE FROM quotes WHERE id = $id");
        
        $deleteLikes->execute();
        return $deleteQuote->execute();
    }

    public static function edit($id, $quote_text, $title, $real_author, $category_id)
    {
        $query = (new Db())->getConn()->prepare("UPDATE quotes SET title=?, quote_text=?, real_author=?, category_id=? WHERE id=?");
        return $query->execute([$title, $quote_text, $real_author, $category_id, $id]);
    }

    public function like($quote_id, $user_id) {
        $query = (new Db())->getConn()->prepare("INSERT INTO likes (quote_id, user_id) VALUES (?, ?)");

        return $query->execute([$quote_id, $user_id]);
    }

    public function isLikedByUser($quote_id, $user_id) {
        $query = (new Db())->getConn()->prepare("SELECT COUNT(*) as has_liked FROM likes WHERE quote_id = $quote_id AND user_id = $user_id");
        $query->execute();

        $likesCount = 0;
        while ($foundLikes = $query->fetch()) {
            $likesCount = $foundLikes['has_liked'];
        }

        return $likesCount;
    }

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}