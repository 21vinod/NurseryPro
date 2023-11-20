<?php
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else { ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
   
    <title>NurseryPro | Admin Dash Board</title>
    <?php include('view/includes/header.php'); ?>
  </head>

  <body>
    <!------MENU SECTION START-->
    <?php include('includes/admin-menu.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line">ADMIN DASHBOARD</h4>

          </div>

        </div>

        <div class="row">
          <a href="index.php?action=manage-tasks">
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-success back-widget-set text-center">
                <i class="fa fa-book fa-5x"></i>
                <?php
                $sql = "SELECT id from tasks ";
                $query = $pdo->prepare($sql);
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
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-warning back-widget-set text-center">
                <i class="fa fa-recycle fa-5x"></i>
                <!-- <?php
                // $sql2 = "SELECT id from tasks where (RetrunStatus='' || RetrunStatus is null)";
                // $query2 = $pdo->prepare($sql2);
                // $query2->execute();
                // $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                // $returnedbooks = $query2->rowCount();echo htmlentities($returnedbooks);
                ?>
-->
                <h3>
                  <?php echo "5" ?>
                </h3>
                Tasks Not Assigned Yet
              </div>
            </div>
          </a>

          <a href="index.php?action=reg-users">
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-danger back-widget-set text-center">
                <i class="fa fa-users fa-5x"></i>
                <?php
                $sql3 = "SELECT id from users ";
                $query3 = $pdo->prepare($sql3);
                $query3->execute();
                $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                $regstds = $query3->rowCount();
                ?>
                <h3>
                  <?php echo htmlentities($regstds); ?>
                </h3>
                Registered Users
              </div>
            </div>
          </a>

          <a href="index.php?action=manage-requests">
            <div class="col-md-3 col-sm-3 col-xs-6">
              <div class="alert alert-success back-widget-set text-center">
                <i class="fa fa-user fa-5x"></i>
                <?php
                $sq4 = "SELECT id from assistance ";
                $query4 = $pdo->prepare($sq4);
                $query4->execute();
                $results4 = $query4->fetchAll(PDO::FETCH_OBJ);
                $listdathrs = $query4->rowCount();
                ?>
                <h3>
                  <?php echo htmlentities($listdathrs); ?>
                </h3>
                Approval Requests
              </div>
            </div>
          </a>
        </div>



        <div class="row">



          <a href="index.php?action=manage-inventory_req">
            <div class="col-md-3 col-sm-3 rscol-xs-6">
              <div class="alert alert-info back-widget-set text-center">
                <i class="fa fa-file-archive-o fa-5x"></i>
                <?php
                $sql5 = "SELECT id from inventory_req ";
                $query5 = $pdo->prepare($sql5);
                $query5->execute();
                $results5 = $query5->fetchAll(PDO::FETCH_OBJ);
                $listdcats = $query5->rowCount();
                ?>
                <h3>
                  <?php echo htmlentities($listdcats); ?>
                </h3>
                Inventory Requests
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