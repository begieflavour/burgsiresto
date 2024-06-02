<?php
session_start();


if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>

    <div class="container">
        <h1 class="title">Login</h1>

        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>

        <form method="post" action="login_handler.php">
            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="text" name="email" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Password</label>
                <div class="control">
                    <input class="input" type="password" name="password" required>
                </div>
            </div>
            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-link" type="submit">Login</button>
                </div>
            </div>
        </form>

    </div>

</body>
</html>
