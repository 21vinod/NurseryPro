<?php
if (strlen($_SESSION['login']) == 0 && strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from assistance  WHERE id=:id";
        $query = $pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Request deleted scuccessfully ";
        header('location:index.php?action=manage-requests');

    }
    ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>NurseryPro | Manage Requests</title>
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
                        <h4 class="header-line">Manage Requests</h4>
                    </div>
                    <?php include('Location: includes/flash.php'); ?>

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
                                                    <th>Task Id</th>
                                                    <th>Request Details</th>
                                                    <th>Requested By</th>
                                                    <th>Status</th>
                                                    <th>Approval Details</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sql = "SELECT * from  assistance";
                                                $query = $pdo->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) { ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center">
                                                                <?php echo htmlentities($cnt); ?>
                                                            </td> <!-- task_id	req_details	req_by	status	approval_details -->
                                                            <td class="center">
                                                                <?php echo htmlentities($result->task_id); ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo htmlentities($result->req_details); ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo htmlentities($result->req_by); ?>
                                                            </td>
                                                            <td class="center">
                                                                <a href="#" class="btn btn-success btn-xs">
                                                                    <?php echo htmlentities($result->status); ?>
                                                                </a>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo htmlentities($result->approval_details); ?>
                                                            </td>
                                                            <td class="center">
                                                                <a
                                                                    href="manage-requests.php?id=<?php echo htmlentities($result->id); ?>">
                                                                    <button class="btn btn-primary"><i class="fa fa-edit">Edit</i>
                                                                    </button>
                                                                </a>
                                                                <a href="manage-requests.php?del=<?php echo htmlentities($result->id); ?>"
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