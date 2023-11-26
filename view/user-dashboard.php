<?php
if (strlen($_SESSION['login']) == 0) {
  header('Location: index.php');
  return;
}
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>NurseryPro | User DashBoard</title>
  <?php include('view/includes/header.php'); ?>
</head>

<body>

  <?php include('includes/user-menu.php'); ?>

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
              $sql = "SELECT task_id FROM tasks";
              $query = $pdo->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $listditems = $query->rowCount();
              ?>
              <h3>
                <?php echo htmlentities($listditems); ?>
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
              $uid = $_SESSION['uid'];
              $sql = "SELECT task_id FROM tasks WHERE user_id=:uid";
              $query = $pdo->prepare($sql);
              $query->bindParam(':uid', $uid, PDO::PARAM_STR);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $returneditems = $query->rowCount();
              ?>

              <h3>
                <?php echo htmlentities($returneditems); ?>
              </h3>
              My Tasks
            </div>
          </div>
        </a>


      </div>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?>
</body>

</html>