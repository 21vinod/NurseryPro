<?php
include_once("pdo.php");

if (isset($_POST['signup'])) {

    //Code for User ID
    $count_my_page = ("user_id.txt");
    $hits = file($count_my_page);
    $hits[0]++;
    $fp = fopen($count_my_page, "w");
    fputs($fp, "$hits[0]");
    fclose($fp);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $user_type = $_POST['user_type'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $status = 1; //let admin check the user type and approve/reject
    // dont signup if email alrady exists or check with jquery

  //  $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `mobile`, `user_type`, `status`) VALUES ('worker1','willow','worker1@gmail.com',:password,'+1 9876543210','admin','1')";

    $sql = "INSERT INTO  users(first_name,last_name,email,password,mobile,user_type,status) 
    VALUES(:first_name,:last_name,:email,:password,:mobile,:user_type,:status)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':user_type', $user_type, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $pdo->lastInsertId();
    if ($lastInsertId) {
        echo '<script>alert("Your registration has been succesfull!!")</script>';
    } else {
        echo "<script>alert('Something went wrong. Please try again!!');</script>";
    }
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NurseryPro | User Signup</title>
    <?php include('view/includes/header.php'); ?>
    <script type="text/javascript">
        function valid() {
            if (document.signup.password.value != document.signup.confirmpassword.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.signup.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'emailid=' + $("#emailid").val(),
                type: "POST",
                success: function (data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () { }
            });
        }
    </script>

</head>

<body>
    
    <?php include('includes/user-menu.php'); ?>
    
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">User Signup</h4>

                </div>

            </div>
            <div class="row">

                <div class="col-md-9 col-md-offset-1">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            SINGUP
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post" onSubmit="return valid();">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" name="first_name" autocomplete="off"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" name="last_name" autocomplete="off"
                                        required />
                                </div>

                                <div class="form-group">
                                    <label>User Type:</label>
                                    <input class="form-control" type="text" name="user_type" maxlength="10"
                                        autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>Mobile Number :</label>
                                    <input class="form-control" type="text" name="mobile" maxlength="10"
                                        autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" id="emailid"
                                        onBlur="checkAvailability()" autocomplete="off" required />
                                    <span id="user-availability-status" style="font-size:12px;"></span>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="password" autocomplete="off"
                                        required />
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password </label>
                                    <input class="form-control" type="password" name="confirmpassword"
                                        autocomplete="off" required />
                                </div>

                                <button type="submit" name="signup" class="btn btn-danger" id="submit">Register Now
                                </button>

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