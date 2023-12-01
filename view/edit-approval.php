<?php
session_start();
require_once('model/pdo.php');

if (strlen($_SESSION['alogin']) == 0 && $_SESSION['login'] == 0) {
    header('location:index.php');
    return;
} elseif (isset($_POST['update'])) {

    $req_details = filter_var($_POST['req_details'], FILTER_SANITIZE_STRING);
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $approval_details = filter_var($_POST['approval_details'], FILTER_SANITIZE_STRING);
    $astn_req_id = filter_var(intval($_POST['id']), FILTER_SANITIZE_STRING);
    
    //UPDATE `assistance_req` SET `req_details`='test req',`user_id`='1003',`status`='Approved' WHERE `astn_req_id`=3;
    $sql = "UPDATE `assistance_req` SET `req_details`=:req_details,`user_id`=:user_id,`status`=:status, `approval_details`=:approval_details WHERE `astn_req_id`=:astn_req_id";
    $query = $pdo->prepare($sql);

    $query->bindParam(':req_details', $req_details, PDO::PARAM_STR);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':approval_details', $approval_details, PDO::PARAM_STR);
    $query->bindParam(':astn_req_id', $astn_req_id, PDO::PARAM_STR);
    $query->execute();
    echo "<script> alert('tesr');</script>";
    $_SESSION['msg'] = "Request updated successfully";
    header('location:index.php?action=manage-requests');
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
    <?php include('includes/user-menu.php'); ?>
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
                                $astn_req_id = intval($_GET['id']);
                                $sql = "SELECT * FROM `assistance_req` WHERE `astn_req_id`=:astn_req_id";
                                $query = $pdo->prepare($sql);
                                $query->bindParam(':astn_req_id', $astn_req_id, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        ?>
                                        <div class="form-group">
                                            <label>Request details</label>
                                            <input class="form-control" type="text" name="req_details"
                                                value="<?php echo htmlentities($result->req_details); ?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Requested By</label>
                                            <input class="form-control" type="text" name="user_id"
                                                value="<?php echo htmlentities($result->user_id); ?>" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="list">
                                                <select name="status">
                                                    <option value="Open">Open</option>
                                                    <option value="Approved">Approved</option>
                                                    <option value="Declines">Declines</option>
                                                    <option value="Need more details">Need more details</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Approval Details</label>
                                            <input class="form-control" type="text" name="approval_details"
                                                value="<?php echo htmlentities($result->approval_details); ?>" required />
                                        </div>
                                    <?php }
                                } ?>
                                <input type="hidden" type="text" name="id"
                                    value="<?php echo htmlentities($result->astn_req_id); ?>" required />
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