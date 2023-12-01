<?php
session_start();

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    return;
} elseif (isset($_POST['update'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $desc = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $task_id = filter_var(intval($_GET['id']), FILTER_SANITIZE_STRING);
    $sql = "UPDATE `tasks` SET `status`=:status WHERE `task_id`=:task_id";
    $query = $pdo->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':task_id', $task_id, PDO::PARAM_STR);
    $query->execute();
    $_SESSION['msg'] = "Tasks updated successfully";
    header('location:index.php?action=my-tasks');
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
                                $task_id = intval($_GET['id']);
                                $sql = "SELECT * FROM `tasks` WHERE `task_id`=:task_id";
                                $query = $pdo->prepare($sql);
                                $query->bindParam(':task_id', $task_id, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        ?>
                                        <div class="form-group">
                                            <label>Task Name</label>
                                            <input class="form-control" type="text" name="name"
                                                value="<?php echo htmlentities($result->name); ?>" required readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label>Task Description</label>
                                            <input class="form-control" type="text" name="desc"
                                                value="<?php echo htmlentities($result->desc); ?>" required readonly/>
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
                                    <?php }
                                } ?>
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