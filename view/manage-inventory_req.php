<?php
if (strlen($_SESSION['login']) == 0 && strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE from inventory_req WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Request deleted scuccessfully ";
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
        <!------MENU SECTION START-->
        <?php
        if (strlen($_SESSION['login']) != 0) {
            include 'includes/user-menu.php';
        } else if (strlen($_SESSION['alogin']) != 0) {
            include 'includes/admin-menu.php';
        }
        ?>
        <!-- MENU SECTION END-->

        <!-- manage tasks -->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Manage Inventory Requests</h4>
                    </div>
                    <?php include('includes/flash.php'); ?>
                    <div class="row">
                        <?php if ($_SESSION['error'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-danger">
                                    <strong>Error :</strong>
                                    <?php echo htmlentities($_SESSION['error']); ?>
                                    <?php echo htmlentities($_SESSION['error'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['msg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['updatemsg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['updatemsg']); ?>
                                    <?php echo htmlentities($_SESSION['updatemsg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['delmsg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['delmsg']); ?>
                                    <?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Tasks Listing
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                            id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Item name</th>
                                                    <th>Quantity</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sql = "SELECT * from  inventory_req";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center">
                                                                <?php echo htmlentities($cnt); ?>
                                                            </td> <!-- // inventory_req: id	item_name	quantity	description -->
                                                            <td class="center">
                                                                <?php echo htmlentities($result->item_name); ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo htmlentities($result->quantity); ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo htmlentities($result->description); ?>
                                                            </td>
                                                            
                                                            <td class="center">
                                                                <a
                                                                    href="manage-inventory_req.php?id=<?php echo htmlentities($result->id); ?>">
                                                                    <button class="btn btn-primary"><i class="fa fa-edit">Edit</i>
                                                                    </button>
                                                                </a>
                                                                <a href="manage-inventory_req.php?del=<?php echo htmlentities($result->id); ?>"
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
                            <!--End Advanced Tables -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- manage tasks end -->


        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include 'includes/footer.php'; ?>
    </body>

    </html>
<?php } ?>