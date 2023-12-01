<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['color'])) {
        $selectedColor = $_POST['color'];
        setcookie('backgroundColor', $selectedColor, time() + 3600); //1 hour
    }
}
$_COOKIE['backgroundColor'] = isset($_COOKIE['backgroundColor']) ? $_COOKIE['backgroundColor'] : "";
$storedColor = $_COOKIE['backgroundColor']; 
if ($storedColor) {
    echo "<style>body { background-color: $storedColor; }</style>";
}
?>

<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">
                <img src="public/img/logo.png" />
            </a>
        </div>
        <?php $_SESSION['login'] = isset($_SESSION['login']) ? $_SESSION['login'] : ""; ?>
        <?php $_SESSION['alogin'] = isset($_SESSION['alogin']) ? $_SESSION['alogin'] : ""; ?>

        <div class="right-div">
            <form method="post" class="my-4" action="">
                Background color: <button type="submit" name="color" value="lightblue">Light Blue</button>
                <button type="submit" name="color" value="lightgreen">Light Green</button>
                <button type="submit" name="color" value="white">No Color</button>
            </form>
            <?php if ($_SESSION['login'] || $_SESSION['alogin']) { ?>
                <a href="index.php?action=logout" class="btn btn-danger pull-right">LOG OUT</a>
            <?php } ?>
        </div>
    </div>
</div>

<?php if ($_SESSION['login']) { ?>
    <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="index.php?action=user-dashboard" class="menu-top-active">DASHBOARD</a></li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> <i
                                        class="fa fa-angle-down">Tasks</i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                            href="index.php?action=my-tasks">My
                                            Tasks</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> <i
                                        class="fa fa-angle-down">Requests</i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                            href="index.php?action=add-request">Add
                                            Request</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                            href="index.php?action=my-requests">MY
                                            Requests</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php } else if ($_SESSION['alogin']) { ?>
        <section class="menu-section">
            <div class="container">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="navbar-collapse collapse ">
                            <ul id="menu-top" class="nav navbar-nav navbar-right">
                                <li><a href="index.php?action=admin-dashboard" class="menu-top-active">DASHBOARD</a></li>

                                <li>
                                    <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Tasks <i
                                            class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="index.php?action=add-tasks">Add
                                                Tasks</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="index.php?action=manage-tasks">Manage
                                                Tasks</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Requests <i
                                            class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">

                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="index.php?action=manage-requests">Manage
                                                Requests</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Business <i
                                            class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="index.php?action=inventory_req">Inventory Request</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="index.php?action=manage-inventory_req">Manage Inventory Request</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="index.php?action=add-sales">Add Sales</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="index.php?action=manage-sales">Manage Sales</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="index.php?action=add-purchases">Add Purchases</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1"
                                                href="index.php?action=manage-purchases">Manage Purchases</a></li>
                                    </ul>
                                </li>
                                <li><a href="index.php?action=reg-users">Reg User</a></li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>
<?php } else { ?>
        <section class="menu-section">
            <div class="container">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="navbar-collapse collapse ">
                            <ul id="menu-top" class="nav navbar-nav navbar-right">

                                <li><a href="index.php?action=home">Home</a></li>
                                <li><a href="index.php?action=login">Employee Login</a></li>
                                <li><a href="index.php?action=signup">Signup</a></li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

<?php } ?>