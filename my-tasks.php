<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['assign'])) {
        $id = $_GET['assign'];
        $sql = "UPDATE tasks SET assigned_worker=:workerid, status='Assigned' Where id=:taskid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':workerid', $_SESSION['stdid'], PDO::PARAM_STR);
        $query->bindParam(':taskid', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['assignmsg'] = "Assigned successfully";
        header('location:my-tasks.php');
    }


    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>NurseryPro | My Tasks</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body>
        <!------MENU SECTION START-->
        <?php
        if (strlen($_SESSION['login']) != 0) {
            include 'includes/header.php';
        } else if (strlen($_SESSION['alogin']) != 0) {
            include 'includes/admin-header.php';
        }
        ?>
        <!-- MENU SECTION END-->

        <!-- My tasks -->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line"></h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    My Tasks
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                            id="dataTables-example">
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
                                                $sid = $_SESSION['stdid'];
                                                //$sql="SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
                                                $sql = "SELECT * from  tasks where assigned_worker=:sid";
                                                $query = $dbh->prepare($sql);
                                                $query-> bindParam(':sid', $sid, PDO::PARAM_STR);
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
                                                                <?php echo htmlentities($result->description); ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo htmlentities($result->assigned_worker); ?>
                                                            </td>
                                                            <td class="center">
                                                                <a href="#" class="btn btn-success btn-xs">
                                                                    <?php echo htmlentities($result->status); ?>
                                                                </a>
                                                            </td>
                                                            <td class="center">
                                                                
                                                                    <input type='hidden' name='taskId' value=<?php echo htmlentities($result->id); ?>>
                                                                    <a href="my-tasks.php?assign=<?php echo htmlentities($result->id); ?>"
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
                            <!--End Advanced Tables -->
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
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Tasks Available
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                            id="dataTables-example">
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
                                                $sid = $_SESSION['stdid'];
                                                //$sql="SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
                                                $sql = "SELECT * from  tasks";
                                                $query = $dbh->prepare($sql);
                                                //$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
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
                                                                <?php echo htmlentities($result->description); ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo htmlentities($result->assigned_worker); ?>
                                                            </td>
                                                            <td class="center">
                                                                <a href="#" class="btn btn-success btn-xs">
                                                                    <?php echo htmlentities($result->status); ?>
                                                                </a>

                                                            </td>
                                                            <td class="center">
                                                                
                                                                    <input type='hidden' name='taskId' value=<?php echo htmlentities($result->id); ?>>
                                                                    <a href="my-tasks.php?assign=<?php echo htmlentities($result->id); ?>"
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
                            <!--End Advanced Tables -->
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- DATATABLE SCRIPTS  -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>

    </body>

    </html>
<?php } ?>