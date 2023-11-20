<?php
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['create'])) {
        $vendor_name = $_POST['vendor_name'];
        $mobile_num = $_POST['mobile_num'];
        $item_name = $_POST['item_name'];
        $quantity = $_POST['quantity'];
        $item_price = $_POST['item_price'];
        // purchases: id	item_name	quantity	item_price	vendor_name	mobile_num	


        $sql = "INSERT INTO  purchases (vendor_name,mobile_num,item_name,quantity,item_price) VALUES(:vendor_name,:mobile_num,:item_name,:quantity,:item_price)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':vendor_name', $vendor_name, PDO::PARAM_STR);
        $query->bindParam(':mobile_num', $mobile_num, PDO::PARAM_STR);
        $query->bindParam(':item_name', $item_name, PDO::PARAM_STR);
        $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $query->bindParam(':item_price', $item_price, PDO::PARAM_STR);
        $query->execute();

        $lastInsertId = $pdo->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Purchase Order Listed successfully";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
        }
        header('location:index.php?action=manage-purchases');
        return;
    }

    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>NurseryPro | Purchases</title>
        <?php include('view/includes/header.php'); ?>
        <script>
            // Function to calculate and display multiplication
            function calculateMultiplication() {
                // Get the values from the input fields
                var num1 = document.getElementById("quantity").value;
                var num2 = document.getElementById("price").value;

                nim1 = $('#quantity').val() + 0;
                num2 = $('#price').val() + 0;
                // Perform multiplication
                var result = num1 * num2;

                // Display the result
                $('#total').empty().text(result);
            }

        </script>

    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include 'includes/admin-menu.php'; ?>
        <!-- MENU SECTION END-->

        <!-- Tasks creation -->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">New Purchase Order</h4>
                    </div>
                </div>
                <?php include('includes/flash.php'); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Purchase Info
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Vendor Name</label>
                                        <input class="form-control" type="text" name="vendor_name" autocomplete="on"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        <input class="form-control" type="tel" name="mobile_num" autocomplete="on"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label>Item name</label>
                                        <input class="form-control" type="text" name="item_name" autocomplete="on"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input class="form-control" type="number" id="quantity" name="quantity" value="0"
                                            oninput="calculateMultiplication()" ; autocomplete="off" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Item Price (in USD)</label>
                                        <input class="form-control" type="number" id="price" name="item_price" value="0"
                                            oninput="calculateMultiplication()" ; autocomplete="off" />
                                    </div>
                                    <div class="form-group">
                                        <label>Total Price (in USD)</label>.
                                        <div id="total" class="form-control" readonly></div>
                                        <!-- <input class="form-control" type="number" id="total" name="total" autocomplete="off"
                                            readonly /> -->
                                    </div>

                                    <button type="submit" name="create" class="btn btn-info">Create Purchase order </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- Task Creation end -->


        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include 'includes/footer.php'; ?>
    </body>

    </html>
<?php } ?>