<?php
session_start();

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} elseif (isset($_GET['inid'])) {
    $id = filter_var($_GET['inid'], FILTER_SANITIZE_STRING);
    $status = 0;
    $sql = "UPDATE users SET status=:status  WHERE user_id=:id";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();

    $_SESSION['msg'] = "User blocked successfully";
    header('location:index.php?action=reg-users');
    return;
} elseif (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
    $status = 1;
    $sql = "UPDATE users SET status=:status  WHERE user_id=:id";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();

    $_SESSION['msg'] = "User unblocked successfully";
    header('location:index.php?action=reg-users');
    return;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>NurseryPro | Manage Registered Users</title>
    <?php include('view/includes/header.php'); ?>
</head>

<body>

    <?php include('includes/user-menu.php'); ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Manage Registered Users</h4>
                </div>
            </div>
            <?php include('includes/flash.php'); ?>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Registered Users
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email id </th>
                                            <th>Mobile Number</th>
                                            <th>Address</th>
                                            <th>Reg Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sql = "SELECT * FROM users";
                                        $query = $pdo->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <tr class="odd gradeX">
                                                    <td class="center">
                                                        <?php echo htmlentities($cnt); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo htmlentities($result->user_id); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo htmlentities($result->first_name); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo htmlentities($result->last_name); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo htmlentities($result->email); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo htmlentities($result->mobile); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php $addr = $result->street . ", " . $result->city . ", " . $result->state . ", " . $result->zip;
                                                        echo htmlentities($addr); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo htmlentities($result->created_date); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php if ($result->status == 1) {
                                                            echo htmlentities("Active");
                                                        } else {
                                                            echo htmlentities("Blocked");
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php if ($result->status == 1) { ?>
                                                            <a href="index.php?action=reg-users&inid=<?php echo htmlentities($result->user_id); ?>"
                                                                onclick="return confirm('Are you sure you want to block this User?');">
                                                                <button class="btn btn-danger"> Inactive</button>
                                                            <?php } else { ?>

                                                                <a href="index.php?action=reg-users&id=<?php echo htmlentities($result->user_id); ?>"
                                                                    onclick="return confirm('Are you sure you want to active this User?');"><button
                                                                        class="btn btn-primary"> Active</button>
                                                                <?php } ?>

                                                    </td>
                                                </tr>
                                                <?php $cnt = $cnt + 1;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>



        </div>
    </div>


    <?php include 'includes/footer.php'; ?>
</body>

</html>