<?php
require_once("../../../vendor/autoload.php");
use App\Hobbies\Hobbies;

$bookTitle = new Hobbies();
$bookTitle->setData($_GET);
$bookTitle->delete();