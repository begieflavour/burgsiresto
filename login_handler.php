<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    include 'dbconfig.php';

    $query = $db->prepare("SELECT id FROM users WHERE email = :email AND password = :password");
    $query->bindValue(':email', $email, SQLITE3_TEXT);
    $query->bindValue(':password', $password, SQLITE3_TEXT);

    $result = $query->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);

    if ($row) {
        $_SESSION['user_id'] = $row['id'];

        header('Location: index.php');
        exit();
    } else {
        echo "Incorrect email or password. Please try again.";
    }
} else {
    header('Location: login.php');
    exit();
}
?>
