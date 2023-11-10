<?php

require_once('model/pdo.php');
error_reporting(0);
session_start();


$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Perform the specified action
switch ($action) {
    case 'login':
        include('view/home.php');
        break;
    case 'signup':
        include('view/signup.php');
        break;
    case 'adminlogin':
        include('view/adminlogin.php');
        break;
    case 'admin-dashboard':
        include('view/admin-dashboard.php');
        break;
    case 'user-dashboard':
        include('view/user-dashboard.php');
        break;
    case 'add-request':
        include('view/add-request.php');
        break;
    case 'add-tasks':
        include('view/add-tasks.php');
        break;
    case 'change-password':
        include('view/change-password.php');
        break;
    case 'edit-approval':
        include('view/edit-approval.php');
        break;
    case 'edit-task':
        include('view/edit-task.php');
        break;
    case 'inventory_req':
        include('view/inventory_req.php');
        break;
    case 'manage-inventory_req':
        include('view/manage-inventory_req.php');
        break;
    case 'manage-sales':
        include('view/manage-sales.php');
        break;
    case 'manage-requests':
        include('view/manage-requests.php');
        break;
    case 'manage-tasks':
        include('view/manage-tasks.php');
        break;
    case 'my-profile':
        include('view/my-profile.php');
        break;
    case 'my-tasks':
        include('view/my-tasks.php');
        break;
    case 'reg-users':
        include('view/reg-users.php');
        break;
    case 'admin-change-password':
        include('view/admin-change-password.php');
        break;
    case 'logout':
        //destory session
        session_destroy();
        $login_message = 'You have been logged out.';
        header('Location: index.php?action=login');
        break;
}
?>