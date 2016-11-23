<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="resources/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/assets/font-awesome/css/font-awesome.min.css">
    <script src="resources/assets/js/jquery-1.11.1.min.js"></script>
    <script src="resources/assets/bootstrap/js/bootstrap.min.js"></script>
<style>
    /*  bhoechie tab */
    div.bhoechie-tab-container{
        z-index: 10;
        background-color: #ffffff;
        padding: 0 !important;
        border-radius: 4px;
        -moz-border-radius: 4px;
        border:1px solid #ddd;
        margin-top: 20px;
        margin-left: 50px;
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
        -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        background-clip: padding-box;
        opacity: 0.97;
        filter: alpha(opacity=97);
    }
    div.bhoechie-tab-menu{
        padding-right: 0;
        padding-left: 0;
        padding-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a .glyphicon,
    div.bhoechie-tab-menu div.list-group>a .fa {
        color: #5A55A3;
    }
    div.bhoechie-tab-menu div.list-group>a:first-child{
        border-top-right-radius: 0;
        -moz-border-top-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a:last-child{
        border-bottom-right-radius: 0;
        -moz-border-bottom-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a.active,
    div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
    div.bhoechie-tab-menu div.list-group>a.active .fa{
        background-color: #5A55A3;
        background-image: #5A55A3;
        color: #ffffff;
    }
    div.bhoechie-tab-menu div.list-group>a.active:after{
        content: '';
        position: absolute;
        left: 100%;
        top: 50%;
        margin-top: -13px;
        border-left: 0;
        border-bottom: 13px solid transparent;
        border-top: 13px solid transparent;
        border-left: 10px solid #5A55A3;
    }

    div.bhoechie-tab-content{
        background-color: #ffffff;
        /* border: 1px solid #eeeeee; */
        padding-left: 20px;
        padding-top: 10px;
    }

    div.bhoechie-tab div.bhoechie-tab-content:not(.active){
        display: none;
    }</style>
    <script>
        $(document).ready(function() {
            $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });
        });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 bhoechie-tab-menu">
                <div class="list-group">
                    <a href="http://localhost/bitm_b35_ajit/labexam8_ajitdas_143229_b35_update_delete/views/SEIP143229/BookTitle/index.php" target="iframe_a" class="list-group-item active text-center">
                        <h4 class="glyphicon glyphicon-book"></h4><br/>Book Title
                    </a>
                    <a href="http://localhost/bitm_b35_ajit/labexam8_ajitdas_143229_b35_update_delete/views/SEIP143229/Birthday/index.php" target="iframe_b" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-book"></h4><br/>Birthday
                    </a>
                    <a href="#" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br/>Train
                    </a>
                    <a href="#" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br/>Hotel
                    </a>
                    <a href="#" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-cutlery"></h4><br/>Restaurant
                    </a>
                    <a href="#" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-credit-card"></h4><br/>Credit Card
                    </a>
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 bhoechie-tab">
                <!-- Book Title section -->
                <div class="bhoechie-tab-content active">
                    <center>
                        <div>Book Title</div>
                        <iframe height="500px" width="100%" frameborder="0" src="http://localhost/bitm_b35_ajit/ajitdas_143229_b35_session30_search_3rdparty/views/SEIP143229/BookTitle/index.php" name="iframe_a"></iframe>
                    </center>
                </div>
                <!-- Birthday section -->
                <div class="bhoechie-tab-content">
                    <center>
                        <div><h1>Birthday</h1></div>
                        <iframe height="500px" width="100%" frameborder="0" src="http://localhost/bitm_b35_ajit/ajitdas_143229_b35_session30_search_3rdparty/views/SEIP143229/Birthday/index.php" name="iframe_b"></iframe>
                    </center>
                </div>
                <!-- City section -->
                <div class="bhoechie-tab-content">
                    <center>
                        <div>Book Title</div>
                        <iframe height="500px" width="100%" src="http://localhost/bitm_b35_ajit/labexam8_ajitdas_143229_b35_update_delete/views/SEIP143229/BookTitle/index.php" name="iframe_c"></iframe>
                    </center>
                </div>
                <!-- Gender section -->
                <div class="bhoechie-tab-content">
                    <center>
                        <div>Book Title</div>
                        <iframe height="500px" width="100%" src="http://localhost/bitm_b35_ajit/labexam8_ajitdas_143229_b35_update_delete/views/SEIP143229/BookTitle/index.php" name="iframe_d"></iframe>
                    </center>
                </div>
                <!-- flight section -->
                <div class="bhoechie-tab-content">
                    <center>
                        <div>Book Title</div>
                        <iframe height="500px" width="100%" src="http://localhost/bitm_b35_ajit/labexam8_ajitdas_143229_b35_update_delete/views/SEIP143229/BookTitle/index.php" name="iframe_e"></iframe>
                    </center>
                </div>
                <!-- flight section -->
                <div class="bhoechie-tab-content">
                    <center>
                        <div>Book Title</div>
                        <iframe height="100%" width="100%" src="http://localhost/bitm_b35_ajit/labexam8_ajitdas_143229_b35_update_delete/views/SEIP143229/BookTitle/index.php" name="iframe_f"></iframe>
                    </center>
                </div>
                <!-- flight section -->
                <div class="bhoechie-tab-content">
                    <center>
                        <div>Organization Summary</div>
                        <iframe height="500px" width="100%" src="http://localhost/bitm_b35_ajit/labexam8_ajitdas_143229_b35_update_delete/views/SEIP143229/BookTitle/index.php" name="iframe_a"></iframe>
                    </center>
                </div>
                <!-- flight section -->
                <div class="bhoechie-tab-content">
                    <center>
                        <div>Book Title</div>
                        <iframe height="500px" width="100%" src="http://localhost/bitm_b35_ajit/labexam8_ajitdas_143229_b35_update_delete/views/SEIP143229/BookTitle/index.php" name="iframe_a"></iframe>
                    </center>
                </div>
                <!-- train section -->
                <div class="bhoechie-tab-content">
                    <center>
                        <h1 class="glyphicon glyphicon-road" style="font-size:12em;color:#55518a"></h1>
                        <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                        <h3 style="margin-top: 0;color:#55518a">Train Reservation</h3>
                    </center>
                </div>
                <!-- hotel search -->
                <div class="bhoechie-tab-content">
                    <center>
                        <h1 class="glyphicon glyphicon-home" style="font-size:12em;color:#55518a"></h1>
                        <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                        <h3 style="margin-top: 0;color:#55518a">Hotel Directory</h3>
                    </center>
                </div>
                <div class="bhoechie-tab-content">
                    <center>
                        <h1 class="glyphicon glyphicon-cutlery" style="font-size:12em;color:#55518a"></h1>
                        <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                        <h3 style="margin-top: 0;color:#55518a">Restaurant Diirectory</h3>
                    </center>
                </div>
                <div class="bhoechie-tab-content">
                    <center>
                        <h1 class="glyphicon glyphicon-credit-card" style="font-size:12em;color:#55518a"></h1>
                        <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                        <h3 style="margin-top: 0;color:#55518a">Credit Card</h3>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>