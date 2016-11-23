<?php
/**
 * Created by PhpStorm.
 * User: Web App Develop-PHP
 * Date: 11/5/2016
 * Time: 11:06 AM
 */

namespace App\Hobbies;
use App\Message\Message;
use App\Model\Database as DB;
use App\Utility\Utility;
use PDO;
class Hobbies extends DB
{
    public $id="";
    public $name="";
    public $hobbies="";

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
        if (array_key_exists('hobby', $postVaribaleData)) {
            $allHobbies = implode(',', $postVaribaleData['hobby']);
            $this->hobbies = $allHobbies;
        }
    }
    public function store()
    {
        $arrData = array($this->name, $this->hobbies);
        $fsql = "Insert INTO hobbies(name, hobbies) VALUES (?,?)";

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
        $STH = $this->DBH->query("SELECT * from hobbies WHERE is_deleted='No'");
        $fetchMode = strtoupper($fetchMode);
        if(substr_count($fetchMode, 'OBJ') > 0)
            $STH->setFetchMode(PDO::FETCH_OBJ);
        else
            $STH->setFetchMode(PDO::FETCH_ASSOC);
        $arrAllData = $STH->fetchAll();
        return $arrAllData;
    }//end of index();
    public function view($fetchMode='ASSOC'){
        $STH = $this->DBH->query('SELECT * from hobbies where id='.$this->id);
        $fetchMode = strtoupper($fetchMode);
        if(substr_count($fetchMode,'OBJ') > 0)
            $STH->setFetchMode(PDO::FETCH_OBJ);
        else
            $STH->setFetchMode(PDO::FETCH_ASSOC);
        $arrOneData = $STH->fetch();
        return $arrOneData;
    }//end of view();

    public function update(){
        $arrData = array($this->name, $this->hobbies);
        $sql = "UPDATE hobbies set name=?, hobbies=? WHERE id=".$this->id;
        $STH = $this->DBH->prepare($sql);
        $STH->execute($arrData);
        Utility::redirect('index.php');
    }
    public function delete(){
        $sql='DELETE FROM hobbies WHERE id = '.$this->id;
        $STH = $this->DBH->prepare($sql);

        $result = $STH->execute();

        Utility::redirect('index.php');

    }
    public function trash($fetchMode ='ASSOC'){
        $query = "UPDATE hobbies SET is_deleted=NOW() Where id=".$this->id;
        $stmt = $this->DBH->prepare($query);
        $stmt->execute();
        Utility::redirect('index.php');
    }

}