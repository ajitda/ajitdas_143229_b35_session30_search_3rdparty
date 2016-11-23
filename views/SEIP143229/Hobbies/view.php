<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

</head>
<body>

<?php
require_once("../../../vendor/autoload.php");
use App\Hobbies\Hobbies;

$bookObject = new Hobbies();
$bookObject->setData($_GET);
$oneData = $bookObject->view("obj");
echo "<div class='book_elemet'>";
echo "ID : ".$oneData->id .'<br>';
echo "Your Name : " . $oneData->name .'<br>';
echo "Your Hobbies Name : " .$oneData->hobbies .'<br>';
echo "</div>";

?>
</body>
</html>