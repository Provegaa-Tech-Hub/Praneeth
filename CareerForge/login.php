<?php
session_start();
include "database/db.php";

$message = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$username' OR mobile='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['email'] = $row['email'];

            header("Location: dashboard/dashboard.php");
            exit();

        } else {
            $message = "Invalid Password!";
        }

    } else {
        $message = "Account not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CareerForge | Login</title>

<link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

<div class="container">

    <div class="login-box">

        <h1>CareerForge</h1>

        <h2>Candidate Login</h2>

        <?php
        if($message!=""){
            echo "<div class='error'>$message</div>";
        }

        if(isset($_GET['registered'])){
            echo "<div class='success'>Registration Successful. Please Login.</div>";
        }
        ?>

        <form method="POST">

            <input
                type="text"
                name="username"
                placeholder="Email or Mobile Number"
                required>

            <div class="password-box">

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Password"
                    required>

                <span id="togglePassword">👁</span>

            </div>

            <button
                type="submit"
                name="login">
                Login
            </button>

        </form>

        <div class="links">

            <a href="forgot-password.php">
                Forgot Password?
            </a>

            <br><br>

            <a href="register.php">
                Create New Account
            </a>

        </div>

    </div>

</div>

<script src="assets/js/login.js"></script>

</body>

</html>