<?php

require_once('model/pdo.php');

// Fetch user data from the database
$stmt = $conn->query('SELECT * FROM users');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="view/main.css" />
    <title>CS5130 Online Shop Manager</title>
</head>

<body>
    <header>
        <h1>CS5130 Online Shop Manager</h1>
    </header>
    <main>
        <h1>User Manager</h1>
        <h2>Users</h2>

        <!-- Users table -->
        <table border="2">4
            <tr>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?php echo $user['email']; ?>
                    </td>
                    <td>
                        <?php echo $user['password']; ?>
                    </td>

                    <td>
                        <form action="index.php?action=delete_user" method="post">
                            <input type="hidden" name="userID" value="<?php echo $user['userID']; ?>">
                            <input type="submit" value="Del">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Add users -->
        <h2>Add User</h2>
        <form action="index.php?action=add_user" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" autocomplete="off">
            <label for="password">Password</label>
            <input type="password" name="password" id="password"><br>
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" id="firstname" autocomplete="given-name">
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" id="lastname" autocomplete="family-name">
            <input type="submit">
        </form>
        <p><a href="index.php?action=show_admin_menu">Admin Menu</a></p>
        <p><a href="index.php?action=show_product">Product</a></p>
        <p><a href="index.php?action=logout">Logout</a></p>
    </main>
</body>

</html>