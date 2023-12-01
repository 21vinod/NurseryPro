<?php
session_start();
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} elseif (isset($_POST['create'])) {
    $customer_name = filter_var($_POST['customer_name'], FILTER_SANITIZE_STRING);
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_STRING);
    $item_id = filter_var($_POST['item_id'], FILTER_SANITIZE_STRING);
    $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $type = 'Sell';
    // sales: trans_id	customer_name	mobile	item_id	quantity	status	created_date	updated_date

    $sql = "INSERT INTO  transactions (customer_name,mobile,item_id,quantity,type,status) VALUES(:customer_name,:mobile,:item_id,:quantity,:type,:status)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':customer_name', $customer_name, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':item_id', $item_id, PDO::PARAM_STR);
    $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
    $query->bindParam(':type', $type, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $pdo->lastInsertId();
    if ($lastInsertId) {
        $_SESSION['msg'] = "Sale Order Listed successfully";
        include("model/update-items.php");
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
        function calculateMultiplication() {
            var num1 = $('#quantity').val();
            var num2 = $('#price').val();
            var result = num1 * num2 * 1.06;
            $('#total').empty().text(result);
        }
        function displayPrice() {
            var dropdown = document.getElementById("item_id");
            var selectedOption = dropdown.options[dropdown.selectedIndex];
            var selectedOptionText = selectedOption.text;
             document.getElementById("price").value = selectedOptionText.split("$")[1].trim();
        }
    </script>

</head>

<body>

    <?php include 'includes/user-menu.php'; ?>



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
                                   <label>Customer Name</label>
                                    <input class="form-control" type="text" name="customer_name" autocomplete="on"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" type="tel" name="mobile" autocomplete="on" required />
                                </div>
                                <div class="form-group">
                                    <label>Item name</label>
                                   <div class="list">
                                        <select name="item_id" id="item_id" onchange="displayPrice()">
                                            <?php
                                            $sql = "SELECT item_id,name,price FROM items";
                                            $stmt = $pdo->query($sql);
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $id = $row['item_id'];
                                                $name = $row['name'];
                                                $price = $row['price'];
                                                echo "<option value='$id'>$name -$$price</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input class="form-control" type="number" id="quantity" name="quantity" value="0"
                                        oninput="calculateMultiplication()" ; autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>Item Price (in USD)</label>
                                    <input class="form-control" type="number" id="price" name="item_price" value="0"
                                        oninput="calculateMultiplication()" ; autocomplete="off" readonly>

                                </div>
                                <div class="form-group">
                                    <label>Total Price (in USD, inc tax)</label>.
                                    <div id="total" class="form-control" readonly></div>
                                   
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
                                <button type="submit" name="create" class="btn btn-info">Create Sale order </button>
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