<?php
session_start();
error_reporting(0);
include 'includes/config.php';
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['create'])) {
        $task_id = $_POST['task_id'];
        $req_details = $_POST['req_details'];
        $req_by = $_POST['req_by'];
        $status = $_POST['status'];
        $approval_details = $_POST['approval_details'];
        $sql = "INSERT INTO  assistance (task_id,req_details,req_by,status,approval_details) VALUES(:task_id,:req_details,:req_by,:status,:approval_details)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':task_id', $task_id, PDO::PARAM_STR);
        $query->bindParam(':req_details', $req_details, PDO::PARAM_STR);
        $query->bindParam(':req_by', $req_by, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':approval_details', $approval_details, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Request Listed successfully";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
        }
        header('location:manage-requests.php');

    }

    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>NurseryPro | Add Request</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include 'includes/header.php'; ?>
        <!-- MENU SECTION END-->

        <!-- Tasks creation -->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Add Request</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Request Info
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Task Id</label>
                                        <input class="form-control" type="text" name="task_id" autocomplete="off"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label>Request Details</label>
                                        <textarea class="form-control" type="text" name="req_details" autocomplete="off"
                                            required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Requested By</label>
                                        <input class="form-control" type="text" name="req_by"
                                            value="<?PHP echo $_SESSION['stdid'] ?>" autocomplete="off" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="list">
                                            <select name="status">
                                                <option value="Open">Open</option>
                                                <option value="Assigned">Assigned</option>
                                                <option value="InProgress">In Progress</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Approval Details</label>
                                        <textarea class="form-control" type="text" name="approval_details"
                                            autocomplete="off" readonly></textarea>
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
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>