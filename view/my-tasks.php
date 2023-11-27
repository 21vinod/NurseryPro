<?php
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    return;
} elseif(isset($_GET['assign'])) {
        $id = $_GET['assign'];
        $sql = "UPDATE tasks SET user_id=:user_id, status='Assigned' Where task_id=:taskid";
        $query = $pdo->prepare($sql);
        $query->bindParam(':user_id', $_SESSION['uid'], PDO::PARAM_STR);
        $query->bindParam(':taskid', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "Assigned successfully";
        header('location:index.php?action=my-tasks');
        return;
    }
    elseif(isset($_GET['unassign'])) {
        $id = $_GET['assign'];
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
            include 'includes/admin-menu.php';
        }
        ?>
        

        <!-- My tasks -->
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
                                        <table class="table table-striped table-bordered table-hover"
                                           >
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Assigned Worker</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $uid = $_SESSION['uid'];
                                                //$sql="SELECT tblitems.BookName,tblitems.ISBNNumber,tblissueditemdetails.IssuesDate,tblissueditemdetails.ReturnDate,tblissueditemdetails.id as rid,tblissueditemdetails.fine from  tblissueditemdetails join users on users.user_id=tblissueditemdetails.user_id join tblitems on tblitems.id=tblissueditemdetails.BookId where users.user_id=:uid order by tblissueditemdetails.id desc";
                                                $sql = "SELECT * FROM  tasks WHERE user_id=:uid";
                                                $query = $pdo->prepare($sql);
                                                $query-> bindParam(':uid', $uid, PDO::PARAM_STR);
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
                                                                <?php echo htmlentities($result->user_id); ?>
                                                            </td>
                                                            <td class="center">
                                                                <a href="#" class="btn btn-success btn-xs">
                                                                    <?php echo htmlentities($result->status); ?>
                                                                </a>
                                                            </td>
                                                            <td class="center">
                                                                
                                                                    <input type='hidden' name='taskId' value=<?=htmlentities($result->task_id); ?>>
                                                                    <a href="my-tasks.php?unassign=<?= htmlentities($result->task_id); ?>"
                                                                        onclick="return confirm('Are you sure you want to Unassign the task?');">
                                                                        <button type="button" class="btn btn-danger"><i
                                                                            class="fa fa-pencil">Unassign</i></button>
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


        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Assign Tasks</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Tasks Available
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                           >
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Assigned Worker</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $uid = $_SESSION['uid'];
                                                //$sql="SELECT tblitems.BookName,tblitems.ISBNNumber,tblissueditemdetails.IssuesDate,tblissueditemdetails.ReturnDate,tblissueditemdetails.id as rid,tblissueditemdetails.fine from  tblissueditemdetails join users on users.user_id=tblissueditemdetails.user_id join tblitems on tblitems.id=tblissueditemdetails.BookId where users.user_id=:uid order by tblissueditemdetails.id desc";
                                                $sql = "SELECT * FROM  tasks";
                                                $query = $pdo->prepare($sql);
                                                //$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
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
                                                                <?php echo htmlentities($result->user_id); ?>
                                                            </td>
                                                            <td class="center">
                                                                <a href="#" class="btn btn-success btn-xs">
                                                                    <?php echo htmlentities($result->status); ?>
                                                                </a>

                                                            </td>
                                                            <td class="center">
                                                                
                                                                    <input type='hidden' name='taskId' value=<?php echo htmlentities($result->task_id); ?>>
                                                                    <a href="my-tasks.php?assign=<?php echo htmlentities($result->task_id); ?>"
                                                                        onclick="return confirm('Are you sure you want to Assign the task?');">
                                                                        <button type="button" class="btn btn-danger"><i
                                                                            class="fa fa-pencil">Assign to
                                                                            me</i></button>
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