<?php
session_start();
//error_reporting(0);
require_once('model/pdo.php');

// $param1 = $_GET['id'];
// echo "<script>alert('$param1')</script>";

if (isset($_GET['id'])) {
    if ($_SESSION['uid'] == 1000) {
        $id = $_GET['id'];
        $sql = "DELETE FROM `tasks` WHERE `task_id`=:id";
        $query = $pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "Task deleted successfully!!";
    } else {
        $_SESSION['error'] = "You dont have permissions to Delete!!";
    }
    header('Location:index.php?action=manage-tasks');
    return;
}
?>