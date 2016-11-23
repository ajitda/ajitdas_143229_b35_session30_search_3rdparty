<?php


namespace App\BookTitle;
use App\Message\Message;
use App\Model\Database as DB;
use App\Utility\Utility;
use PDO;

class BookTitle extends DB
{
    public $id = "";
    public $book_title = "";
    public $author_name = "";

    public function __construct()
    {

        parent::__construct();
    }

    public function setData($postVaribaleData = NULL)
    {
        if (array_key_exists('id', $postVaribaleData)) {
            $this->id = $postVaribaleData['id'];
        }
        if (array_key_exists('book_title', $postVaribaleData)) {
            $this->book_title = $postVaribaleData['book_title'];
        }
        if (array_key_exists('author_name', $postVaribaleData)) {
            $this->author_name = $postVaribaleData['author_name'];
        }
    }//end of setData

    public function store()
    {
        $arrData = array($this->book_title, $this->author_name);
        $fsql = "Insert INTO book_title(booktitle, author) VALUES (?,?)";

        $result = $this->DBH->prepare($fsql);

        $result->execute($arrData);
        if($result)
            Message::setMessage("Success ! Data has been inserted Successfully :)");
        else
            Message::setMessage("Failed ! Data has not been inserted Successfully ):");
        Utility::redirect('index.php');
    }//end of store

    public function index($fetchMode='ASSOC'){
        $STH = $this->DBH->query("SELECT * from book_title WHERE is_deleted='No'");
        $fetchMode = strtoupper($fetchMode);
        if(substr_count($fetchMode, 'OBJ') > 0)
            $STH->setFetchMode(PDO::FETCH_OBJ);
        else
            $STH->setFetchMode(PDO::FETCH_ASSOC);
        $arrAllData = $STH->fetchAll();
        return $arrAllData;
    }//end of index();
    public function view($fetchMode='ASSOC'){
        $STH = $this->DBH->query('SELECT * from book_title where id='.$this->id);
        $fetchMode = strtoupper($fetchMode);
        if(substr_count($fetchMode,'OBJ') > 0)
            $STH->setFetchMode(PDO::FETCH_OBJ);
        else
            $STH->setFetchMode(PDO::FETCH_ASSOC);
        $arrOneData = $STH->fetch();
        return $arrOneData;
    }//end of view();

    public function update(){
        $arrData = array($this->book_title, $this->author_name);
        $sql = "UPDATE book_title set booktitle=?, author=? WHERE id=".$this->id;
        $STH = $this->DBH->prepare($sql);
        $STH->execute($arrData);
        Utility::redirect('index.php');
    }
    public function delete(){
        $sql='DELETE FROM book_title WHERE id = '.$this->id;
        $STH = $this->DBH->prepare($sql);


        $result = $STH->execute();

        Utility::redirect('index.php');
    }
    public function trash($fetchMode ='ASSOC'){
            $query = "UPDATE book_title SET is_deleted=NOW() Where id=".$this->id;
            $stmt = $this->DBH->prepare($query);
            $stmt->execute();
            Utility::redirect('index.php');
    }

    public function indexPaginator($page=0,$itemsPerPage=3){
        $start = (($page-1) * $itemsPerPage);
        $sql = "SELECT * from book_title  WHERE is_deleted = 'No' LIMIT $start,$itemsPerPage";
        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $arrSomeData  = $STH->fetchAll();
        return $arrSomeData;
    }

    public function trashedPaginator($page=0,$itemsPerPage=3){
        $start = (($page-1) * $itemsPerPage);
        $sql = "SELECT * from book_title  WHERE is_deleted <> 'No' LIMIT $start,$itemsPerPage";
        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $arrSomeData  = $STH->fetchAll();
        return $arrSomeData;
    }// end of trashedPaginator();

    public function search($requestArray){
        $sql = "";
        if( isset($requestArray['byTitle']) && isset($requestArray['byAuthor']) )  $sql = "SELECT * FROM `book_title` WHERE `is_deleted` ='No' AND (`booktitle` LIKE '%".$requestArray['search']."%' OR `author` LIKE '%".$requestArray['search']."%')";
        if(isset($requestArray['byTitle']) && !isset($requestArray['byAuthor']) ) $sql = "SELECT * FROM `book_title` WHERE `is_deleted` ='No' AND `booktitle` LIKE '%".$requestArray['search']."%'";
        if(!isset($requestArray['byTitle']) && isset($requestArray['byAuthor']) )  $sql = "SELECT * FROM `book_title` WHERE `is_deleted` ='No' AND `author` LIKE '%".$requestArray['search']."%'";
        $STH  = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData = $STH->fetchAll();
        return $allData;

    }// end of search()

    public function getAllKeywords()
    {
        $_allKeywords = array();
//        $WordsArr = array();
        $sql = "SELECT * FROM `book_title` WHERE `is_deleted` ='No'";

        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        // for each search field block start
        $allData= $STH->fetchAll();
        foreach ($allData as $oneData) {
            $_allKeywords[] = trim($oneData->booktitle);
        }

        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);

        $allData= $STH->fetchAll();
        foreach ($allData as $oneData) {
            $eachString= strip_tags($oneData->booktitle);
            $eachString=trim( $eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);
            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord){
                $_allKeywords[] = trim($eachWord);
            }
        }
        // for each search field block end

        // for each search field block start
        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData= $STH->fetchAll();
        foreach ($allData as $oneData) {
            $_allKeywords[] = trim($oneData->author);
        }
        $STH = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData= $STH->fetchAll();
        foreach ($allData as $oneData) {

            $eachString= strip_tags($oneData->author);
            $eachString=trim( $eachString);
            $eachString= preg_replace( "/\r|\n/", " ", $eachString);
            $eachString= str_replace("&nbsp;","",  $eachString);
            $WordsArr = explode(" ", $eachString);

            foreach ($WordsArr as $eachWord){
                $_allKeywords[] = trim($eachWord);
            }
        }
        // for each search field block end

        return array_unique($_allKeywords);

    }// get all keywords

}