<?php
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['create'])) {
        $customer_name = $_POST['customer_name'];
        $mobile_num = $_POST['mobile_num'];
        $item = $_POST['item'];
        $quantity = $_POST['quantity'];
        $item_price = $_POST['item_price'];
        // sales: id	customer_name	mobile_num	item	quantity	item_price

        $sql = "INSERT INTO  sales (customer_name,mobile_num,item,quantity,item_price) VALUES(:customer_name,:mobile_num,:item,:quantity,:item_price)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':customer_name', $customer_name, PDO::PARAM_STR);
        $query->bindParam(':mobile_num', $mobile_num, PDO::PARAM_STR);
        $query->bindParam(':item', $item, PDO::PARAM_STR);
        $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $query->bindParam(':item_price', $item_price, PDO::PARAM_STR);
        $query->execute();

        $lastInsertId = $pdo->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Sale Order Listed successfully";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
        }
        header('location:index.php?action=manage-sales');
        return;
    }

    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>NurseryPro | Sales</title>
        <?php include('view/includes/header.php'); ?>
        <script>
            // Function to calculate and display multiplication
            function calculateMultiplication() {
                // Get the values from the input fields
                var num1 = document.getElementById("quantity").value;
                var num2 = document.getElementById("price").value;

                // Perform multiplication
                var result = num1 * num2;

                // Display the result
                document.getElementById("total").innerHTML = result;
            }
        </script>
        
    </head>

    <body>
        
        <?php include 'includes/admin-menu.php'; ?>
        

        <!-- Tasks creation -->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">New Sale Order</h4>
                    </div>
                </div>
                <?php include('includes/flash.php'); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Sale Info
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <!-- // sales: id	customer_name	mobile_num	item	quantity	item_price -->
                                        <label>Customer Name</label>
                                        <input class="form-control" type="text" name="customer_name" autocomplete="on"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        <input class="form-control" type="tel" name="mobile_num" autocomplete="on"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label>Item name</label>
                                        <input class="form-control" type="text" name="item" autocomplete="on" required />
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

                                    <button type="submit" name="create" class="btn btn-info">Create Sale order </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- Task Creation end -->


        
        <?php include 'includes/footer.php'; ?>
    </body>

    </html>
<?php } ?>