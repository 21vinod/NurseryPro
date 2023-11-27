<?php
if (strlen($_SESSION['login']) == 0 && strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} elseif (isset($_GET['del'])) {
    $id = $_GET['del'];
    //inventory_req: inv_req_id	item_id	user_id	quantity	details	status	approval_details
    $sql = "DELETE from inventory_req WHERE inv_req_id=:id";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $_SESSION['msg'] = "Request deleted scuccessfully ";
    header('location:index.php?action=manage-inventory_req');
    return;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NurseryPro | Manage Inventory Requests</title>
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


    <!-- manage tasks -->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Manage Inventory Requests</h4>
                </div>
                <?php include('includes/flash.php'); ?>

                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Tasks Listing
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                       >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item ID</th>
                                                <th>User ID</th>
                                                <th>Quantity</th>
                                                <th>Details</th>
                                                <th>Status</th>
                                                <th>Approval details</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT * from  inventory_req";
                                            $query = $pdo->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center">
                                                            <?php echo htmlentities($cnt); ?>
                                                            <!-- //inventory_req: item_id	user_id	quantity	details	status	approval_details -->
                                                        </td> <!-- // inventory_req: id	item_name	quantity	description -->
                                                        <td class="center">
                                                            <?php echo htmlentities($result->item_id); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->user_id); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->quantity); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->details); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->status); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->approval_details); ?>
                                                        </td>
                                                        <td class="center">
                                                            <a
                                                                href="index.php?action=edit-inventory_req&id=<?php echo htmlentities($result->inv_req_id); ?>">
                                                                <button class="btn btn-primary"><i class="fa fa-edit">Edit</i>
                                                                </button>
                                                            </a>
                                                            <a href="index.php?action=manage-inventory_req&del=<?php echo htmlentities($result->inv_req_id); ?>"
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
    <!-- manage tasks end -->



    <?php include 'includes/footer.php'; ?>
</body>

</html>