<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php?action=home">
                <img src="public/img/logo.png" />
            </a>
        </div>

        <div class="right-div">
            <a href="index.php?action=logout" class="btn btn-danger pull-right">LOG OUT</a>
        </div>
    </div>
</div>
<!-- LOGO HEADER END-->
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
                                <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="add-request.php">Add
                                        Book</a></li> -->
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
                                        href="index.php?action=inventory_req">Inventory
                                        Request</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                        href="index.php?action=manage-inventory_req">Manage Inventory Request</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                        href="index.php?action=manage-sales">Sales</a>
                                </li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                        href="index.php?action=manage-purchases">Purchases</a></li>
                            </ul>
                        </li>
                        <li><a href="index.php?action=reg-users">Reg User</a></li>

                        <li><a href="index.php?action=admin-change-password">Change Password</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>