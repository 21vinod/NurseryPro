<?php
session_start();
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
            <div class="jumbotron">
                <h2 class="display-4">Welcome to NurseryPro!</h2>
                <p class="lead">We are delighted to have you with us. Explore the wonders of nature with our
                    dedicated team.</p>
                <hr class="my-4">
                <p>For purchases and visits, contact us:</p>
                <address>
                    <strong>NurseryPro</strong><br>
                    123 Green Street<br>
                    Overland Park, KS 66213<br>
                    <abbr title="Phone">P:(555) 123-4567</abbr>
                </address>
            </div>
        </div>

        <div class="container">
            <?php include("includes/flash.php") ?>
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Available Plants at this movement</h4>
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
                    <tbody id="dataTable">
                        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                loadTableData(1);
                                $(document).on('click', '.pagination a', function () {
                                    var page = $(this).data('page');
                                    loadTableData(page);
                                });

                                function loadTableData(page) {
                                    $.getJSON('view/get-json-items.php', { page: page }, function (data) {
                                        var html = "";
                                        count = (page - 1) * 5;
                                        $.each(data.records, function (key, val) {
                                             src = "public/img/plants/"+val.image 
                                            html += "<tr>";
                                            html += "<td>" + ++count + "</td>";
                                            html += "<td>" + "<img width='120' height='150' src="+src+" alt=''>" + "</td>";
                                            html += "<td>" + val.name + "</td>";
                                            html += "<td>" + val.desc + "</td>";
                                            html += "<td>" + val.type + "</td>";
                                            html += "<td> $" + val.price + "</td>";
                                            html += "<td>" + val.avl_qty + "</td>";
                                            html += "</tr>";
                                        });
                                        $('#dataTable').html(html);

                                        var pagination = "";
                                        for (var i = 1; i <= data.total_pages; i++) {
                                            var activeClass = (i === page) ? 'active' : '';
                                            pagination += "<a href='#' class='" + activeClass + "' data-page='" + i + "'>" + i + "</a>";
                                        }
                                        $('#pagination').html(pagination);
                                    });
                                }
                            });
                        </script>

                    </tbody>


                </table>
                <div class="pagination" id="pagination">
                </div>
            </div>
        </div>
    </div>



    <?php include 'includes/footer.php'; ?>

</body>

</html>