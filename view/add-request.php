<?php
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
        $query = $pdo->prepare($sql);
        $query->bindParam(':task_id', $task_id, PDO::PARAM_STR);
        $query->bindParam(':req_details', $req_details, PDO::PARAM_STR);
        $query->bindParam(':req_by', $req_by, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':approval_details', $approval_details, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $pdo->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Request Listed successfully";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
        }
        header('location:index.php?action=manage-requests');
        return;
    }

    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>NurseryPro | Add Request</title>
        <?php include('view/includes/header.php'); ?>
    </head>

    <body>
        
        <?php include 'includes/user-menu.php'; ?>
        

        <!-- Tasks creation -->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Add Request</h4>
                    </div>
                </div>
                <?php include('includes/flash.php'); ?>
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
                                            value="<?PHP echo $_SESSION['uid'] ?>" autocomplete="off" readonly />
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


        
        <?php include 'includes/footer.php'; ?>
    </body>

    </html>
<?php } ?>