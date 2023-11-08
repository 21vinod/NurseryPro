<?php
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['create'])) {
        $category = $_POST['category'];
        $status = $_POST['status'];
        $sql = "INSERT INTO  tblcategory(CategoryName,Status) VALUES(:category,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Brand Listed successfully";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
        }
        header('location:index.php?action=manage-tasks');

    }
    if (isset($_POST['create_task'])) {
        $name = $_POST['name'];
        $status = $_POST['status'];
        $assigned = $_POST['worker'];
        $desc = $_POST['desc'];
        $sql = "INSERT INTO  tasks (name,description,assigned_worker,status) VALUES(:name,:description,:assigned_worker,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':description', $desc, PDO::PARAM_STR);
        $query->bindParam(':assigned_worker', $assigned, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Task Listed successfully";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
        }
        header('location:index.php?action=manage-tasks');

    }
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>NurseryPro | Add Categories</title>
        <?php include('view/includes/header.php'); ?>
    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include 'includes/admin-menu.php';?>
        <!-- MENU SECTION END-->
   
        <!-- Tasks creation -->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Add Task</h4>
                    </div>
                </div>
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
                                        <label>Assigned Worker</label>
                                        <input class="form-control" type="text" name="worker" autocomplete="off" />
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
        <!-- Task Creation end -->


        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include 'includes/footer.php'; ?>
    </body>

    </html>
<?php }?>