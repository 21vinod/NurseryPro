<?php
session_start();
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    return;
} elseif (isset($_GET['assign'])) {
    $id = filter_var($_GET['assign'], FILTER_SANITIZE_STRING);
    $sql = "UPDATE tasks SET user_id=:user_id, status='Assigned' Where task_id=:taskid";
    $query = $pdo->prepare($sql);
    $query->bindParam(':user_id', $_SESSION['uid'], PDO::PARAM_STR);
    $query->bindParam(':taskid', $id, PDO::PARAM_STR);
    $query->execute();
    $_SESSION['msg'] = "Assigned successfully";
    header('location:index.php?action=my-tasks');
    return;
} elseif (isset($_GET['unassign'])) {
    $id = filter_var($_GET['unassign'], FILTER_SANITIZE_STRING);
    $unassign = 0;
    $sql = "UPDATE tasks SET user_id=:user_id, status='Open' Where task_id=:taskid";
    $query = $pdo->prepare($sql);
    $query->bindParam(':user_id', $unassign, PDO::PARAM_STR);
    $query->bindParam(':taskid', $id, PDO::PARAM_STR);
    $query->execute();
    $_SESSION['msg'] = "Unassigned successfully";
    header('location:index.php?action=my-tasks');
    return;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NurseryPro | My Tasks</title>
    <?php include('view/includes/header.php'); ?>
</head>

<body>

    <?php
    if (strlen($_SESSION['login']) != 0) {
        include 'includes/user-menu.php';
    } else if (strlen($_SESSION['alogin']) != 0) {
        include 'includes/user-menu.php';
    }
    ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line"></h4>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                My Tasks
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $uid = $_SESSION['uid'];
                                            $sql = "SELECT * FROM  tasks WHERE user_id=:uid";
                                            $query = $pdo->prepare($sql);
                                            $query->bindParam(':uid', $uid, PDO::PARAM_STR);
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
                                                            <?php echo htmlentities($result->name); ?>
                                                        </td>

                                                        <td class="center">
                                                            <?php echo htmlentities($result->desc); ?>
                                                        </td>
                                                        <td class="center">
                                                            <a href="#" class="btn btn-success btn-xs">
                                                                <?php echo htmlentities($result->status); ?>
                                                            </a>
                                                        </td>
                                                        <td class="center">

                                                            <input type='hidden' name='taskId'
                                                                value=<?= htmlentities($result->task_id); ?>>
                                                            <a
                                                                href="index.php?action=update-task&id=<?php echo htmlentities($result->task_id); ?>">
                                                                <button class="btn btn-primary"><i class="fa fa-edit">Update
                                                                        Satus</i>
                                                                </button>
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

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>