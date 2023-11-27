<?php
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['create'])) {
        $item_id = $_POST['item_id'];
        $user_id = $_SESSION['uid'];
        $quantity = $_POST['quantity'];
        $details = $_POST['details'];
        $status = "Open";
        // inventory_req: id	item_id	quantity	details
        //inventory_req: inv_req_id	item_id	user_id	quantity	details	status	approval_details
        $sql = "INSERT INTO  `inventory_req` (item_id,user_id,status, quantity, details) VALUES(:item_id,:user_id,:status,:quantity, :details)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':item_id', $item_id, PDO::PARAM_STR);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $query->bindParam(':details', $details, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $pdo->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Request Listed successfully";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
        }
        header('location:index.php?action=manage-inventory_req');
        return;
    }

    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>NurseryPro | Add Inventory Request</title>
        <?php include('view/includes/header.php'); ?>
    </head>

    <body>

        <?php include 'includes/admin-menu.php'; ?>


        
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Add Inventory Request</h4>
                    </div>
                </div>
                <?php include('includes/flash.php'); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Inventory Info
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <!-- // inventory_req: id	item_id	quantity	details -->
                                        <!-- //inventory_req: inv_req_id	item_id	user_id	quantity	details	status	approval_details -->
                                        <label>Item name (item id)</label>
                                        <input class="form-control" type="text" name="item_id" autocomplete="off"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input class="form-control" type="number" name="quantity" autocomplete="off"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label>Details</label>
                                        <textarea class="form-control" type="text" name="details"
                                            autocomplete="off"></textarea>
                                    </div>

                                    <button type="submit" name="create" class="btn btn-info">Create Request </button>
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
<?php } ?>