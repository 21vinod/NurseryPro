<?php
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} elseif (isset($_POST['create'])) {
    $customer_name = $_POST['customer_name'];
    $mobile = $_POST['mobile'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];
    $type = "Buy";
    $item_price = 1;

    $sql = "INSERT INTO  transactions (Customer_name,mobile,item_id,quantity,status,type) VALUES(:customer_name,:mobile,:item_id,:quantity,:status,:type)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':customer_name', $customer_name, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':item_id', $item_id, PDO::PARAM_STR);
    $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':type', $type, PDO::PARAM_STR);
    $query->execute();

    $_SESSION['msg'] = "Purchase Order Listed successfully";
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

            nim1 = $('#quantity').val();
            num2 = $('#price').val();
            // Perform multiplication
            var result = num1 * num2 * 1.06;

            // Display the result
            $('#total').empty().text(result);
        }

    </script>

</head>

<body>

    <?php include 'includes/admin-menu.php'; ?>



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
                                    <input class="form-control" type="text" name="customer_name" autocomplete="on"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" type="tel" name="mobile" autocomplete="on" required />
                                </div>
                                <div class="form-group">
                                    <label>Item name(Item ID)</label>
                                    <input class="form-control" type="text" name="item_id" autocomplete="on" required />
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
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="list">
                                        <select name="status">
                                            <option value="Paid">Paid</option>
                                            <option value="Unpaid">Unpaid</option>
                                            <option value="Pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" name="create" class="btn btn-info">Create Purchase order </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>




    <?php include 'includes/footer.php'; ?>
</body>

</html>