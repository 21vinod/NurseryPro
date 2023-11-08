<?php
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else { ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>NurseryPro | User DashBoard</title>
    <?php include('view/includes/header.php'); ?>
  </head>

  <body>
    <!------MENU SECTION START-->
    <?php include('includes/user-menu.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line">User DASHBOARD</h4>

          </div>

        </div>

        <div class="row">


          <a href="index.php?action=manage-tasks">
            <div class="col-md-4 col-sm-4 col-xs-6">
              <div class="alert alert-success back-widget-set text-center">
                <i class="fa fa-book fa-5x"></i>
                <?php
                $sql = "SELECT id from tasks";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $listdbooks = $query->rowCount();
                ?>
                <h3>
                  <?php echo htmlentities($listdbooks); ?>
                </h3>
                Tasks Listed
              </div>
            </div>
          </a>

          <a href="index.php?action=manage-tasks">
            <div class="col-md-4 col-sm-4 col-xs-6">
              <div class="alert alert-warning back-widget-set text-center">
                <i class="fa fa-recycle fa-5x"></i>
                <?php
                $rsts = 0;
                $sid = $_SESSION['stdid'];
                $sql2 = "SELECT id from tasks where assigned_worker=:sid";
                $query2 = $dbh->prepare($sql2);
                $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
                $query2->execute();
                $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                $returnedbooks = $query2->rowCount();
                ?>

                <h3>
                  <?php echo htmlentities($returnedbooks); ?>
                </h3>
                My Tasks
              </div>
            </div>
          </a>


        </div>
      </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include 'includes/footer.php'; ?>
  </body>

  </html>
<?php } ?>