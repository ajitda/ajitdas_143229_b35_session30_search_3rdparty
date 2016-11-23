<?php
include_once("../../../vendor/autoload.php");
use App\BookTitle\BookTitle;
use App\Message\Message;
use App\Utility\Utility;
$serial = 1;
$bookObject = new BookTitle();
$allData = $bookObject->index("obj");

################## search  block 1 of 5 start ##################
if(isset($_REQUEST['search']) )$allData =  $bookObject->search($_REQUEST);
$availableKeywords=$bookObject->getAllKeywords();
$comma_separated_keywords= '"'.implode('","',$availableKeywords).'"';
################## search  block 1 of 5 end ##################

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
$someData = $bookObject->indexPaginator($page,$itemsPerPage);
$serial = (($page-1) * $itemsPerPage) +1;
####################### pagination code block#1 of 2 end #########################################
################## search  block 2 of 5 start ##################
if(isset($_REQUEST['search']) ) {
    $someData = $bookObject->search($_REQUEST);
    $serial = 1;
}
################## search  block 2 of 5 end ##################
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="../../../resources/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../resources/assets/font-awesome/css/font-awesome.min.css">
    <script src="../../../resources/assets/js/jquery-1.11.1.min.js"></script>
    <script src="../../../resources/assets/bootstrap/js/bootstrap.min.js"></script>
    <style>
        table,th,td{border-collapse: collapse;padding:5px;text-align:center;margin:0 auto;}
        .main{margin:50px 0;text-align: center;}
        .select_page{margin:20px 0;}
    </style>
    <!-- required for search, block3 of 5 start -->
    <link rel="stylesheet" href="../../../resources/assets/bootstrap/css/jquery-ui.css">
    <script src="../../../resources/assets/bootstrap/js/jquery-1.12.4.js"></script>
    <script src="../../../resources/assets/bootstrap/js/jquery-ui.js"></script>
    <!-- required for search, block3 of 5 end -->

</head>
<body>
<div class="container">
    <div class="main">
           <div class="row">
               <div class="col-md-5 col-sm-5">
                        <!-- required for search, block 4 of 5 start -->
                        <form id="searchForm" action="index.php"  method="get">
                            <input type="text" value="" id="searchID" name="search" placeholder="Search" width="60" >
                            <input type="checkbox"  name="byTitle" checked >By Title
                            <input type="checkbox"  name="byAuthor" checked >By Author
                            <input hidden type="submit" class="btn-primary" value="search">
                        </form>
                        <!-- required for search, block 4 of 5 end -->
               </div>
               <div class="col-md-7">
                   <div id="TopMenuBar">
                       <button type="button" onclick="window.location.href='../index.php'" class=" btn-primary btn-lg">Home</button>
                       <button type="button" onclick="window.location.href='create.php'" class=" btn-primary btn-lg">Add new</button>
                       <button type="button" onclick="window.location.href='trashed.php?Page=1'" class=" btn-success btn-lg">Trashed List</button>
                   </div>
               </div>
           </div>

            <h1> Active List</h1>
            <div class="row">
                <div class="col-md-12">
<?php


    echo "<table border='2px' style='border-collapse:collapse;' >";
    echo "<thead><th>Serial</th><th>ID</th><th>Book Title</th><th>Author Name</th><th>Action</th></thead>";
    echo "<tbody>";
foreach($someData as $oneData){
    echo "<tr >";
    echo "<td > $serial </td>";
    echo "<td> $oneData->id </td>";
    echo "<td> $oneData->booktitle </td>";
    echo "<td> $oneData->author </td>";
    echo "<td>
            <a href='view.php?id=$oneData->id'><button class='btn btn-info'>View</button></a>
            <a href='medit.php?id=$oneData->id'><button class='btn btn-primary'>Edit</button></a>
            <a href='trash.php?id=$oneData->id'><button class='btn btn-primary'>Trash</button></a>
            <a href='delete.php?id=$oneData->id'><button class='btn btn-danger'>Delete</button></a>
</td>";
    echo "</tr>";
    $serial++;
}
    echo "</tbody>";
    echo "</table>";

?>
            <a href="create.php">Add a new Book</a>
                </div>
            </div>
    <!--  ######################## pagination code block#2 of 2 start ###################################### -->
    <div align="left" class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <ul class="pagination">
                    <?php
                    $pageMinusOne=$page-1;
                    $pagePlusOne = $page+1;
                    if($page>$pages) Utility::redirect("index.php?Page=$pages");
                    if($page>1) echo "<li><a href='index.php?Page=$pageMinusOne'>" . "Previous" . '</a></li>';
                    for($i=1;$i<=$pages;$i++)
                    {
                        if($i==$page) echo '<li class="active"><a href="">'. $i . '</a></li>';
                        else  echo "<li><a href='?Page=$i'>". $i . '</a></li>';
                    }
                    if($page<$pages) echo "<li><a href='index.php?Page=$pagePlusOne'>" . "Next" . '</a></li>';
                    ?>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="select_page">
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
                </div>
            </div>
        </div>
    </div>
    <!--  ######################## pagination code block#2 of 2 end ###################################### -->

        <div class="row">
            <div class="col-md-12">
                <a href="pdf.php" class="btn btn-primary" role="button">Download as PDF</a>
                <a href="xl.php" class="btn btn-primary" role="button">Download as XL</a>
                <a href="email.php?list=1" class="btn btn-primary" role="button">Email to friend</a>
            </div>
        </div>
    </div>
</div>
<!-- required for search, block 5 of 5 start -->
<script>
    $(function() {
        var availableTags = [
            <?php
            echo $comma_separated_keywords;
            ?>
        ];
        // Filter function to search only from the beginning of the string
        $( "#searchID" ).autocomplete({
            source: function(request, response) {
                var results = $.ui.autocomplete.filter(availableTags, request.term);
                results = $.map(availableTags, function (tag) {
                    if (tag.toUpperCase().indexOf(request.term.toUpperCase()) === 0) {
                        return tag;
                    }
                });
                response(results.slice(0, 15));
            }
        });
        $( "#searchID" ).autocomplete({
            select: function(event, ui) {
                $("#searchID").val(ui.item.label);
                $("#searchForm").submit();
            }
        });
    });

</script>
<!-- required for search, block5 of 5 end -->
</body>

</html>