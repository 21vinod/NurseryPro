<?php
session_start();

require_once('model/pdo.php');
//echo ("<h1>1</h1>");

$email = "admin@gmail.com";
$password = "Test@123";

// $sql = "SELECT email,password,user_id,status FROM users WHERE email=:email and password=:password";
// $query = $pdo->prepare($sql);
// echo ("<h1>7</h1>");
// $query->bindParam(':email', $email, PDO::PARAM_STR);
// $query->bindParam(':password', $password, PDO::PARAM_STR);
// $query->execute();
$stmt = $pdo->query("SELECT * FROM items");
echo ("<h1>7</h1>");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo ("<h1>6</h1>");
if ($result->rowCount() > 0) {
    $_SESSION['uid'] = $result->user_id;
    if ($result->status == 1 && $_SESSION['uid'] == 1000) {
        $_SESSION['alogin'] = $_POST['emailid'];
        echo ("<h1>Location: 2</h1>");
        return;
    } else if ($result->status == 1) {
        $_SESSION['login'] = $_POST['emailid'];
        echo ("<h1>Location: 3</h1>");
        return;
    } else {
        $_SESSION["error"] = "Your account is deactivated. Please contact admin!!";
        echo ("<h1>Location:4</h1>");
        return;
    }
} else {
    $_SESSION["error"] = "Invalid Email or Password !!";
    echo ("<h1>Location: i5</h1>");
    return;
}
