<?php
require 'config.php';  // includes $conn

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if user exists in admin table
    $sql = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // If passwords are not hashed
        if ($password === $user['password']) {
            $_SESSION['admin'] = $username;
            header("Location: dashboard/home.php");
            exit;
        } 
        // If passwords are hashed (optional)
        elseif (password_verify($password, $user['password'])) {
            $_SESSION['admin'] = $username;
            header("Location: dashboard/home.php");
            exit;
        } 
        else {
            echo "<script>alert('❌ Incorrect password!'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('❌ Username not found!'); window.location.href='index.php';</script>";
    }
} else {
    header("Location: index.php");
    exit;
}
?>
