<?php
// session_start();
//error_reporting(0);
require_once('model/pdo.php');

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'home':
        include('view/home.php');
        break;
    case 'login':
        include('view/login.php');
        break;
    case 'signup':
        include('view/signup.php');
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
    case 'add-sales':
        include('view/add-sales.php');
        break;
    case 'add-purchases':
        include('view/add-purchases.php');
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
    case 'update-task':
        include('view/update-task.php');
        break;
    case 'edit-sales':
        include('view/edit-sales.php');
        break;
    case 'update-items':
        include('model/update-items.php');
        break;
    case 'edit-purchases':
        include('view/edit-purchases.php');
        break;
    case 'edit-inventory_req':
        include('view/edit-inventory_req.php');
        break;
    case 'delete-task':
        include("model/delete-task.php");
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
    case 'manage-purchases':
        include('view/manage-purchases.php');
        break;
    case 'manage-requests':
        include('view/manage-requests.php');
        break;
    case 'my-requests':
        include('view/my-requests.php');
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
        include('model/logout.php');
        break;
}
?>