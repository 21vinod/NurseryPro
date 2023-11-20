<?php
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

// code for block User    
if(isset($_GET['inid']))
{
$id=$_GET['inid'];
$status=0;
$sql = "update users set Status=:status  WHERE id=:id";
$query = $pdo->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:index.php?action=reg-users');
}



//code for active Users
if(isset($_GET['id']))
{
$id=$_GET['id'];
$status=1;
$sql = "update users set Status=:status  WHERE id=:id";
$query = $pdo->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:index.php?action=reg-users');
}


    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>NurseryPro | Manage Reg Users</title>
    <?php include('view/includes/header.php'); ?>
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/admin-menu.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Manage Reg Users</h4>
    </div>


        </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Reg Users
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>Email id </th>
                                            <th>Mobile Number</th>
                                            <th>Reg Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT * from users";
$query = $pdo -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->user_id);?></td>
                                            <td class="center"><?php echo htmlentities($result->FullName);?></td>
                                            <td class="center"><?php echo htmlentities($result->EmailId);?></td>
                                            <td class="center"><?php echo htmlentities($result->MobileNumber);?></td>
                                             <td class="center"><?php echo htmlentities($result->RegDate);?></td>
                                            <td class="center"><?php if($result->Status==1)
                                            {
                                                echo htmlentities("Active");
                                            } else {


                                            echo htmlentities("Blocked");
}
                                            ?></td>
                                            <td class="center">
<?php if($result->Status==1)
 {?>
<a href="reg-users.php?inid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to block this User?');" >  <button class="btn btn-danger"> Inactive</button>
<?php } else {?>

<a href="reg-users.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to active this User?');"><button class="btn btn-primary"> Active</button> 
                                            <?php } ?>

<a href="User-history.php?stdid=<?php echo htmlentities($result->user_id);?>"><button class="btn btn-success"> Details</button> 

                                          
                                            </td>
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
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

     <!-- CONTENT-WRAPPER SECTION END-->
     <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php } ?>
