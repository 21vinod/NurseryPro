<?php
session_start();
error_reporting(0);
require_once('model/pdo.php');

if ($_SESSION['login'] != '' || $_SESSION['alogin'] != '') {
    $_SESSION['login'] = '';
    $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {

    $email = trim(htmlentities(strip_tags($_POST['emailid'], ENT_QUOTES)));
    $email = filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    // email,password,user_id,status
    $sql = "SELECT * FROM users WHERE email=:email";
    $query = $pdo->prepare($sql);
    $query->execute(array(":email" => $email));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($query->rowCount() > 0 && password_verify($password, $result['password'])) {
        $_SESSION['uid'] = $result['user_id'];
        if ($result['status'] == 1 && $_SESSION['uid'] == 1000) {
            $_SESSION['alogin'] = $_POST['emailid'];
            header("Location:index.php?action=admin-dashboard");
            return;
        } else if ($result['status'] == 1) {
            $_SESSION['login'] = $_POST['emailid'];
            header("Location:index.php?action=user-dashboard");
            return;
        } else {
            $_SESSION["error"] = "Your account is deactivated. Please contact admin!!";
            header("Location:index.php?action=login");
            return;
        }
    } else {
        $_SESSION["error"] = "Invalid Email or Password !!";
        header("Location:index.php?action=login");
        return;
    }
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <title>NurseryPro</title>
    <?php include('includes/header.php'); ?>
</head>

<body>

    <?php include('includes/user-menu.php'); ?>

    <div class="content-wrapper">
        <div class="container">

            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">USER LOGIN</h4>
                </div>
            </div>
            <?php include('includes/flash.php'); ?>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            LOGIN
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">

                                <div class="form-group">
                                    <label>Email id</label>
                                    <input class="form-control" type="text" name="emailid" required
                                        autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="password" required
                                        autocomplete="off" />
                                    <p class="help-block"><a href="index.php?action=user-forgot-password">Forgot
                                            Password</a></p>
                                </div>

                                <button type="submit" name="login" class="btn btn-info">LOGIN </button> | <a
                                    href="index.php?action=signup">Not Registered Yet</a>
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