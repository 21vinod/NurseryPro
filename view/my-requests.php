<?php
session_start();
//error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    return;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NurseryPro | Manage Requests</title>
    <?php include('view/includes/header.php'); ?>
</head>

<body>

    <?php
    if (strlen($_SESSION['login']) != 0) {
        include 'includes/user-menu.php';
    }
    ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">My Requests</h4>
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
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                           <tr>
                                                <th>#</th>
                                                <th>Request Details</th>
                                                <th>Requested By</th>
                                                <th>Status</th>
                                                <th>Approval Details</th>
                                                <th>Created Date</th>
                                                <th>Updated Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $uid=$_SESSION['uid'];
                                            $sql = "SELECT * FROM `assistance_req` WHERE `user_id`=$uid";
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
                                                        <td class="center">
                                                            <?php echo htmlentities($result->req_details); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php
                                                            $sql = "SELECT first_name FROM users WHERE user_id=$result->user_id";
                                                            $stmt = $pdo->query($sql);
                                                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                                            echo $row['first_name'];
                                                            ?>
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
                                                            <?php echo htmlentities($result->created_date); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->updated_date); ?>
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