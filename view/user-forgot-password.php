<?php
if (isset($_POST['change'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT EmailId FROM users WHERE EmailId=:email and MobileNumber=:mobile";
    $query = $pdo->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $con = "update users set Password=:newpassword where EmailId=:email and MobileNumber=:mobile";
        $chngpwd1 = $pdo->prepare($con);
        $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
        $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        echo "<script>alert('Your Password succesfully changed');</script>";
    } else {
        echo "<script>alert('Email id or Mobile no is invalid');</script>";
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NurseryPro | Password Recovery </title>
    <?php include('view/includes/header.php'); ?>
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("New Password and Confirm Password Field do not match  !!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>

</head>

<body>
    
    <?php include('includes/user-menu.php'); ?>
    
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">User Password Recovery</h4>
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            LOGIN
                        </div>
                        <div class="panel-body">
                            <form role="form" name="chngpwd" method="post" onSubmit="return valid();">

                                <div class="form-group">
                                    <label>Reg Email id</label>
                                    <input class="form-control" type="email" name="email" required autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label>Reg Mobile No</label>
                                    <input class="form-control" type="text" name="mobile" required autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="newpassword" required
                                        autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label>ConfirmPassword</label>
                                    <input class="form-control" type="password" name="confirmpassword" required
                                        autocomplete="off" />
                                </div>


                                <button type="submit" name="change" class="btn btn-info">Chnage Password</button> | <a
                                    href="index.php">Login</a>
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