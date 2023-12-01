<?php
session_start();

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} elseif (isset($_POST['create_task'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $assignedTo = filter_var($_POST['worker'], FILTER_SANITIZE_STRING);
    $desc = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);

    //tasks: task_id	name	desc	user_id	status	created_date	updated_date
    $sql = "INSERT INTO `tasks`(`name`, `desc`, `user_id`, `status`) VALUES (:name,:desc,:user_id,:status)";
    $query = $pdo->prepare($sql);
    $query->execute(array(':name' => $name, ':desc' => $desc, ':user_id' => $assignedTo, ':status' => $status));
    // echo "<script>alert('test');</script>";
    // return;
    $lastInsertId = $pdo->lastInsertId();
    if ($lastInsertId) {
        $_SESSION['msg'] = "Task listed successfully";
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again";
    }
    header('location:index.php?action=manage-tasks');
    return;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NurseryPro | Add tasks</title>
    <?php include('view/includes/header.php'); ?>
</head>

<body>

    <?php include 'includes/user-menu.php'; ?>


    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Add Task</h4>
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
                                <div class="form-group">
                                    <label>Task Name</label>
                                    <input class="form-control" type="text" name="name" autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <label>Task Description</label>
                                    <textarea class="form-control" type="text" name="desc" autocomplete="off"
                                        required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Assigned Worker(Enter User ID)</label>
                                    <div class="list">
                                        <select name="worker">
                                            <?php
                                            $sql = "SELECT user_id,first_name FROM users";
                                            $stmt = $pdo->query($sql);
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $id = $row['user_id'];
                                                $name = $row['first_name'];
                                                echo "<option value='$id'>$name</option>";
                                            }
                                            ?>
                                          </select>
                                    </div>
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
                                <button type="submit" name="create_task" class="btn btn-info">Create Task </button>
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