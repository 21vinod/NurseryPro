<?php
session_start();
require_once('model/pdo.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    return;
} elseif (isset($_POST['update'])) {
    $customer_name = $_POST['customer_name'];
    $mobile = $_POST['mobile'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];
    $trans_id = $_POST['id'];
    $sql = "UPDATE `transactions` SET `customer_name`=:customer_name,`mobile`=:mobile,`item_id`=:item_id,`quantity`=:quantity,`status`=:status WHERE `trans_id`=:trans_id AND `type`='Sell'";
    $query = $pdo->prepare($sql);
    $query->bindParam(':customer_name', $customer_name, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':item_id', $item_id, PDO::PARAM_STR);
    $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
    $query->bindParam(':trans_id', $trans_id, PDO::PARAM_STR);
    $query->execute();
    $_SESSION['msg'] = "Tasks updated successfully";
    header('location:index.php?action=manage-sales');
    return;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NurseryPro | Edit tasks</title>
    <?php include('view/includes/header.php'); ?>
</head>

<body>
    <?php include('includes/admin-menu.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Edit Task</h4>
                </div>
            </div>

            <?php include('includes/flash.php'); ?>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class=" panel panel-info">
                        <div class="panel-heading">
                            Task Info
                        </div>

                        <div class="panel-body">
                            <form role="form" method="post">
                                <?php
                                $task_id = intval($_GET['id']);
                                $sql = "SELECT * FROM `transactions` WHERE `trans_id`=:id AND `type`='Sell'";
                                $query = $pdo->prepare($sql);
                                $query->bindParam(':id', $task_id, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        ?>
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <input class="form-control" type="text" name="customer_name"
                                                value="<?php echo htmlentities($result->customer_name); ?>" required />
                                        </div>
                                        <!-- // sales: trans_id	customer_name	mobile	item_id	quantity	status	created_date	updated_date -->
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input class="form-control" type="text" name="mobile"
                                                value="<?php echo htmlentities($result->mobile); ?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Item ID</label>
                                            <input class="form-control" type="text" name="item_id"
                                                value="<?php echo htmlentities($result->item_id); ?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input class="form-control" type="text" name="quantity"
                                                value="<?php echo htmlentities($result->quantity); ?>" required />
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
                                    <?php }
                                } ?>
                                <input type="hidden" type="text" name="id"
                                    value="<?php echo htmlentities($result->trans_id); ?>" required />

                                <button type="submit" name="update" class="btn btn-info">Update </button>
                                <button type="reset" name="update" class="btn btn-cancel">Cancel </button>

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