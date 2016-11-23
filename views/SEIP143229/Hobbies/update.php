<?php
//var_dump($_POST); die();
require_once('../../../vendor/autoload.php');
use App\Hobbies\Hobbies;
$objBookTitle = new Hobbies();
$objBookTitle->setData($_POST);
$objBookTitle->update();