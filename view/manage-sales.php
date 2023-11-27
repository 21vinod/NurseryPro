<?php
session_start();
//error_reporting(0);
require_once('model/pdo.php');
if (strlen($_SESSION['alogin']) == 0 && strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    return;
} elseif (isset($_GET['del'])) {
    if ($_SESSION['uid'] == 1000) {
        $id = $_GET['del'];
        $sql = "DELETE FROM `transactions` WHERE `trans_id`=:id AND `type`='Sell'";
        $query = $pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "Sales record deleted scuccessfully!!";
    } else {
        $_SESSION['error'] = "You dont have permissions to Delete!!";
    }
    header('location:index.php?action=manage-sales');
    return;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NurseryPro | Manage Sales</title>
    <?php include('view/includes/header.php'); ?>
</head>

<body>

    <?php
    if (strlen($_SESSION['login']) != 0) {
        include 'includes/user-menu.php';
    } else if (strlen($_SESSION['alogin']) != 0) {
        include 'includes/admin-menu.php';
    }
    ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Sales records</h4>
                </div>
                <?php include('includes/flash.php'); ?>

                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Sales Listing
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                       >
                                        <thead>

                                            <tr>
                                                <th>#</th>
                                                <th>Customer Name</th>
                                                <th>Mobile Number</th>
                                                <th>Item ID</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Created Date</th>
                                                <th>Updated Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM transactions WHERE type='Sell'";
                                            $query = $pdo->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center">
                                                            <?php echo htmlentities($cnt); ?>
                                                        </td>
                                                        <!-- // sales: trans_id	customer_name	mobile	item_id	quantity	status	created_date	updated_date -->
                                                        <td class="center">
                                                            <?php echo htmlentities($result->customer_name); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->mobile); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->item_id); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->quantity); ?>
                                                        </td>
                                                        
                                                        <td class="center">
                                                            <?php echo htmlentities($result->quantity * 1.062 ); ?>
                                                        </td>
                                                        <td class="center">
                                                            <a href="#" class="btn btn-success btn-xs">
                                                                <?php echo htmlentities($result->status); ?>
                                                            </a>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->created_date); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->updated_date); ?>
                                                        </td>
                                                        <td class="center">
                                                            <a
                                                                href="index.php?action=edit-sales&id=<?php echo htmlentities($result->trans_id); ?>">
                                                                <button class="btn btn-primary"><i class="fa fa-edit">Edit</i>
                                                                </button>
                                                            </a>
                                                            <a href="index.php?action=manage-sales&del=<?php echo htmlentities($result->trans_id); ?>"
                                                                onclick="return confirm('Are you sure you want to delete?');">
                                                                <button class="btn btn-danger"><i
                                                                        class="fa fa-pencil">Delete</i></button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>