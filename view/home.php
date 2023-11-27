<?php
session_start();
//error_reporting(0);
require_once('model/pdo.php');

?>

<!DOCTYPE html>
<html lang='en' xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NurseryPro</title>
    <?php include('includes/header.php'); ?>
</head>

<body>


    <?php include('includes/user-menu.php'); ?>

    <div class="content-wrapper">
        <div class="container">

            <!-- <div class="row">
                <div class="col-md-10 col-sm-8 col-xs-12 col-md-offset-1">
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="public/img/1.png" alt="" />
                            </div>
                            <div class="item">
                                <img src="public/img/2.png" alt="" />
                            </div>
                            <div class="item">
                                <img src="public/img/3.jpg" alt="" />
                            </div>
                        </div>
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example" data-slide-to="1"></li>
                            <li data-target="#carousel-example" data-slide-to="2"></li>
                        </ol>
                        <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                        </a>
                        <a class="right carousel-control" href="#carousel-example" data-slide="next">
                        </a>
                    </div>
                </div>
            </div>
            <hr /> -->
            <?php include("includes/flash.php") ?>
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Available Plants</h4>
                </div>
            </div>
            <a name="ulogin"></a>

            <div class="container mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity Available</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM items");
                        $count = 0;

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $src = $row['image'];
                            echo "<tr scope='row'><td>";
                            echo (htmlentities(++$count));
                            echo ("</td><td><img width='120' height='150' src='public/img/plants/$src' alt=''>");

                            echo ("</td><td>");
                            echo (htmlentities($row['name']));
                            echo ("</td><td>");

                            echo (htmlentities($row['desc']));
                            echo ("</td><td>");
                            echo (htmlentities($row['type']));
                            echo ("</td><td>");
                            echo ("$" . htmlentities($row['price']));
                            echo ("</td><td>");
                            echo (htmlentities($row['avl_qty']));
                            echo ("</td><td>");
                            echo ("</td></tr>");
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

</body>

</html>