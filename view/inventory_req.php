<?php
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['create'])) {
        $item_name = $_POST['item_name'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        // inventory_req: id	item_name	quantity	description
        $approval_details = $_POST['approval_details'];
        $sql = "INSERT INTO  inventory_req (item_name,	quantity, description) VALUES(:item_name,	:quantity, :description)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':item_name', $item_name, PDO::PARAM_STR);
        $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
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
        <!------MENU SECTION START-->
        <?php include 'includes/admin-menu.php'; ?>
        <!-- MENU SECTION END-->

        <!-- Tasks creation -->
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
                                        <!-- // inventory_req: id	item_name	quantity	description -->
                                        <label>Item name</label>
                                        <input class="form-control" type="text" name="item_name" autocomplete="off"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input class="form-control" type="number" name="quantity" autocomplete="off"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" type="text" name="description"
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
        <!-- Task Creation end -->


        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include 'includes/footer.php'; ?>
    </body>

    </html>
<?php } ?>