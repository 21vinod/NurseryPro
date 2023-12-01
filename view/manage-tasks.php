<?php
session_start();
if (strlen($_SESSION['alogin']) == 0 && strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    return;
}  
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NurseryPro | Manage Tasks</title>
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
                    <h4 class="header-line">Manage Tasks</h4>
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
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Worker Assigned</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT * from  tasks";
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
                                                            <?php echo htmlentities($result->name); ?>
                                                        </td>

                                                        <td class="center">
                                                            <?php echo htmlentities($result->desc); ?>
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
                                                         <a
                                                                href="index.php?action=edit-task&id=<?php echo htmlentities($result->task_id); ?>">
                                                                <button class="btn btn-primary"><i class="fa fa-edit">Edit</i>
                                                                </button>
                                                            </a>

                                                            <a href="index.php?action=delete-task&id=<?php echo htmlentities($result->task_id); ?> "
                                                                onclick="return confirm('Are you sure you want to delete?');">
                                                                <button class="btn btn-primary"><i class="fa fa-edit">Delete</i>
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