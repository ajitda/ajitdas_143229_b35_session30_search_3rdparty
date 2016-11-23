<?php
require_once("../../../vendor/autoload.php");
use App\Hobbies\Hobbies;
$objBookTitle = new Hobbies();
$objBookTitle->setData($_GET);
$objBookTitle->trash();


