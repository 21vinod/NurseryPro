<?php
$login_message = isset($login_message) ? $login_message : "You must login to view this page; login";
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="view/main.css" />
    <title>CS5130 Online Shop</title>
</head>

<body>
    <header>
        <h1>CS5130 Online Shop</h1>
    </header>
    <main>
        <h1>Login</h1>

        <form action="." method="post" id="login_form" class="aligned">
            <input type="hidden" name="action" value="login">

            <label for="email">Email:</label>
            <input type="email" class="text" id="email" name="email" placeholder="Email" autocomplete="off">
            <br>

            <label for="password">Password:</label>
            <input type="password" class="text" id="password" name="password" placeholder="Password">
            <br>

            <label for="submit"> &nbsp;</label>
            <input type="submit" id="submit" value="Login">

        </form>

        <p>
            <?php echo $login_message;
            unset($login_message); ?>
        </p>
    </main>
</body>

</html>