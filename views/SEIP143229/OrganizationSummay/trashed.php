<?php
require_once("../../../vendor/autoload.php");
use App\Birthday\Birthday;
use App\Message\Message;
$objBookTitle = new Birthday();
$allData = $objBookTitle->trashed("obj");
######################## pagination code block#1 of 2 start ######################################
$recordCount= count($allData);
if(isset($_REQUEST['Page']))   $page = $_REQUEST['Page'];
else if(isset($_SESSION['Page']))   $page = $_SESSION['Page'];
else   $page = 1;
$_SESSION['Page']= $page;
if(isset($_REQUEST['ItemsPerPage']))   $itemsPerPage = $_REQUEST['ItemsPerPage'];
else if(isset($_SESSION['ItemsPerPage']))   $itemsPerPage = $_SESSION['ItemsPerPage'];
else   $itemsPerPage = 3;
$_SESSION['ItemsPerPage']= $itemsPerPage;
$pages = ceil($recordCount/$itemsPerPage);
$someData = $objBookTitle->trashedPaginator($page,$itemsPerPage);
$serial = (($page-1) * $itemsPerPage) +1;
####################### pagination code block#1 of 2 end #########################################
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../../resources/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../resources/assets/font-awesome/css/font-awesome.min.css">
    <script src="../../../resources/assets/js/jquery-1.11.1.min.js"></script>
    <script src="../../../resources/assets/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div id="TopMenuBar">
    <button type="button" onclick="window.location.href='../index.php'" class=" btn-primary btn-lg">Home</button>
    <button type="button" onclick="window.location.href='index.php?Page=1'" class=" btn-success btn-lg">Active List</button>
</div>
<h1> Trashed List</h1>
<?php
echo "<table border='5px' >";
echo "<th> Serial </th>";
echo "<th> ID </th>";
echo "<th> Book Title </th>";
echo "<th> Author Name </th>";
echo "<th> Action </th>";
foreach($someData as $oneData){########### Traversing $someData is Required for pagination  #############
   echo "<tr style='height: 40px'>";
    echo "<td>".$serial."</td>";
    echo "<td>".$oneData->id."</td>";
    echo "<td>".$oneData->book_title."</td>";
    echo "<td>".$oneData->author_name."</td>";
    echo "<td>";
    echo "<a href='recover.php?id=$oneData->id'><button class='btn btn-success'>Recover</button></a> ";
    echo "<a href='delete.php?id=$oneData->id'><button class='btn btn-danger'>Delete</button></a> ";
    echo "</td>";
    echo "</tr>";
    $serial++;
}
echo "</table>";
?>
<!--  ######################## pagination code block#2/2 start ###################################### -->
<div align="left" class="container">
    <ul class="pagination">
        <?php
        echo '<li><a href="">' . "Previous" . '</a></li>';
        for($i=1;$i<=$pages;$i++)
        {
            if($i==$page) echo '<li class="active"><a href="">'. $i . '</a></li>';
            else  echo "<li><a href='?Page=$i'>". $i . '</a></li>';

        }
        echo '<li><a href="">' . "Next" . '</a></li>';
        ?>
        <select  class="form-control"  name="ItemsPerPage" id="ItemsPerPage" onchange="javascript:location.href = this.value;" >
            <?php
            if($itemsPerPage==3 ) echo '<option value="?ItemsPerPage=3" selected >Show 3 Items Per Page</option>';
            else echo '<option  value="?ItemsPerPage=3">Show 3 Items Per Page</option>';

            if($itemsPerPage==4 )  echo '<option  value="?ItemsPerPage=4" selected >Show 4 Items Per Page</option>';
            else  echo '<option  value="?ItemsPerPage=4">Show 4 Items Per Page</option>';

            if($itemsPerPage==5 )  echo '<option  value="?ItemsPerPage=5" selected >Show 5 Items Per Page</option>';
            else echo '<option  value="?ItemsPerPage=5">Show 5 Items Per Page</option>';

            if($itemsPerPage==6 )  echo '<option  value="?ItemsPerPage=6"selected >Show 6 Items Per Page</option>';
            else echo '<option  value="?ItemsPerPage=6">Show 6 Items Per Page</option>';

            if($itemsPerPage==10 )   echo '<option  value="?ItemsPerPage=10"selected >Show 10 Items Per Page</option>';
            else echo '<option  value="?ItemsPerPage=10">Show 10 Items Per Page</option>';

            if($itemsPerPage==15 )  echo '<option  value="?ItemsPerPage=15"selected >Show 15 Items Per Page</option>';
            else    echo '<option  value="?ItemsPerPage=15">Show 15 Items Per Page</option>';
            ?>
        </select>
    </ul>
</div>
<!--  ######################## pagination code block#2/2 end ###################################### -->
</body>

</html>
