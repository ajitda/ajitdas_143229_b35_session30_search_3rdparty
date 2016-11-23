<?php
/**
 * Created by PhpStorm.
 * User: Web App Develop-PHP
 * Date: 11/5/2016
 * Time: 10:55 AM
 */

namespace App\Birthday;
use App\Message\Message;
use App\Model\Database as DB;
use App\Utility\Utility;
use PDO;

class Birthday extends DB
{
    public $id="";
    public $name="";
    public $birthday="";

    public function __construct(){

        parent::__construct();
    }
	 public function setData($postVaribaleData = NULL)
    {
        if (array_key_exists('id', $postVaribaleData)) {
            $this->id = $postVaribaleData['id'];
        }
        if (array_key_exists('your_name', $postVaribaleData)) {
            $this->name = $postVaribaleData['your_name'];
        }
        if (array_key_exists('your_birthday', $postVaribaleData)) {
            $this->birthday = $postVaribaleData['your_birthday'];
        }
    }
    public function store()
    {
        $arrData = array($this->name, $this->birthday);
        $fsql = "Insert INTO birthday(name, birthday) VALUES (?,?)";

     // echo $fsql;die();
        $result = $this->DBH->prepare($fsql);

        $result->execute($arrData);
        if($result)
            Message::setMessage("Success ! Data has been inserted Successfully :)");
        else
            Message::setMessage("Failed ! Data has not been inserted Successfully ):");
        Utility::redirect('index.php');
	}
    public function index($fetchMode='ASSOC'){
        $STH = $this->DBH->query("SELECT * from birthday WHERE is_deleted='No'");
        $fetchMode = strtoupper($fetchMode);
        if(substr_count($fetchMode, 'OBJ') > 0)
            $STH->setFetchMode(PDO::FETCH_OBJ);
        else
            $STH->setFetchMode(PDO::FETCH_ASSOC);
        $arrAllData = $STH->fetchAll();
        return $arrAllData;
    }//end of index();
    public function view($fetchMode='ASSOC'){
        $STH = $this->DBH->query('SELECT * from birthday where id='.$this->id);
        $fetchMode = strtoupper($fetchMode);
        if(substr_count($fetchMode,'OBJ') > 0)
            $STH->setFetchMode(PDO::FETCH_OBJ);
        else
            $STH->setFetchMode(PDO::FETCH_ASSOC);
        $arrOneData = $STH->fetch();
        return $arrOneData;
    }//end of view();

    public function update(){
        $arrData = array($this->name, $this->birthday);
        $sql = "UPDATE birthday SET name=?, birthday=? WHERE id=".$this->id;
        $STH = $this->DBH->prepare($sql);
        $STH->execute($arrData);
        Utility::redirect('index.php');
    }
    public function delete(){
        $sql='DELETE FROM birthday WHERE id ='.$this->id;
        $STH = $this->DBH->prepare($sql);
        $STH->execute();
        Utility::redirect('index.php');
    }
    public function trash($fetchMode ='ASSOC'){
        $query = "UPDATE birthday SET is_deleted=NOW() Where id=".$this->id;
        $stmt = $this->DBH->prepare($query);
        $stmt->execute();
        Utility::redirect('index.php');
    }
    public function trashed($fetchMode='ASSOC'){
        $sql = "SELECT * from book_title where is_deleted <> 'No' ";
        $STH = $this->DBH->query($sql);
        $fetchMode = strtoupper($fetchMode);
        if(substr_count($fetchMode,'OBJ') > 0)
            $STH->setFetchMode(PDO::FETCH_OBJ);
        else
            $STH->setFetchMode(PDO::FETCH_ASSOC);
        $arrAllData  = $STH->fetchAll();
        return $arrAllData;
    }

    public function recover(){

        $sql = "Update book_title SET is_deleted='No' where id=".$this->id;

        $STH = $this->DBH->prepare($sql);

        $STH->execute();

        Utility::redirect('trashed.php');

    }// end of recover();

    public function indexPaginator($page=0,$itemsPerPage=3){

        $start = (($page-1) * $itemsPerPage);

        $sql = "SELECT * from book_title  WHERE is_deleted = 'No' LIMIT $start,$itemsPerPage";

        $STH = $this->DBH->query($sql);

        $STH->setFetchMode(PDO::FETCH_OBJ);

        $arrSomeData  = $STH->fetchAll();
        return $arrSomeData;

    }// end of indexPaginator();
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
        if( isset($requestArray['byTitle']) && isset($requestArray['byAuthor']) )  $sql = "SELECT * FROM `book_title` WHERE `is_deleted` ='No' AND (`book_title` LIKE '%".$requestArray['search']."%' OR `author_name` LIKE '%".$requestArray['search']."%')";
        if(isset($requestArray['byTitle']) && !isset($requestArray['byAuthor']) ) $sql = "SELECT * FROM `book_title` WHERE `is_deleted` ='No' AND `book_title` LIKE '%".$requestArray['search']."%'";
        if(!isset($requestArray['byTitle']) && isset($requestArray['byAuthor']) )  $sql = "SELECT * FROM `book_title` WHERE `is_deleted` ='No' AND `author_name` LIKE '%".$requestArray['search']."%'";

        $STH  = $this->DBH->query($sql);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $allData = $STH->fetchAll();

        return $allData;

    }// end of search()

}