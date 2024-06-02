<?php
include 'dbconfig.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $result = $stmt->execute();

    if ($result) {
        header('Location: login.php');
        exit();
    } else {
        $error_message = "Error creating user account.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Sign Up</h1>
        <?php if (isset($error_message)) : ?>
            <div class="notification is-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="field">
                <label class="label" for="email">Email:</label>
                <div class="control">
                    <input class="input" type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="field">
                <label class="label" for="password">Password:</label>
                <div class="control">
                    <input class="input" type="password" id="password" name="password" required>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button class="button is-primary" type="submit">Sign Up</button>
                </div>
            </div>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
