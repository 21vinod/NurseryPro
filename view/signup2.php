<?php
require_once('../model/pdo.php');
$password = password_hash("Admin@123", PASSWORD_DEFAULT);
$sql = "INSERT INTO `users`(`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `user_type`, `status`, `street`, `city`, `state`, `zip`, `created_date`, `updated_date`)
VALUES ('1000','Admin','Administrator','admin@gmail.com',:password,'+1 9876543210','admin','1','Innovate parkway 1101','Lees Summit','Missouri','64002','','')";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":password", $password, PDO::PARAM_STR);
$stmt->execute();