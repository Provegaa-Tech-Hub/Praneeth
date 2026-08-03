<?php
session_start();
include "database/db.php";

$message = "";

if (isset($_POST['register'])) {

    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    /* ==========================================
    PASSWORD CHECK
    ========================================== */

    if ($password != $confirm_password) {

        $message = "Passwords do not match!";

    } else {

        /* ==========================================
        CHECK EMAIL OR MOBILE
        ========================================== */

        $check = mysqli_query(

            $conn,

            "SELECT * FROM users
            WHERE email='$email'
            OR mobile='$mobile'"

        );

        if (mysqli_num_rows($check) > 0) {

            $message = "Email or Mobile already exists!";

        } else {

            /* ==========================================
            HASH PASSWORD
            ========================================== */

            $hashedPassword = password_hash(

                $password,

                PASSWORD_DEFAULT

            );

            /* ==========================================
            INSERT USER
            ========================================== */

            $insert = mysqli_query(

                $conn,

                "INSERT INTO users
                (full_name,email,mobile,password)

                VALUES

                ('$full_name','$email','$mobile','$hashedPassword')"

            );

            if ($insert) {

                /* ==========================================
                GET LAST INSERTED USER ID
                ========================================== */

                $userId = mysqli_insert_id($conn);

                /* ==========================================
                GENERATE REGISTRATION ID
                Example:
                CFG2026000001
                ========================================== */

                $registrationId =

                    "CFG"

                    .

                    date("Y")

                    .

                    str_pad($userId, 6, "0", STR_PAD_LEFT);

                /* ==========================================
                SAVE REGISTRATION ID
                ========================================== */

                mysqli_query(

                    $conn,

                    "UPDATE users

                    SET registration_id='$registrationId'

                    WHERE id='$userId'"

                );

                header("Location: login.php?registered=1");

                exit();

            } else {

                $message = "Registration Failed!";

            }

        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>CareerForge | Register</title>

<link
rel="stylesheet"
href="assets/css/register.css">

</head>

<body>

<div class="container">

    <div class="register-box">

        <h1>Create Account</h1>

        <?php

        if($message!=""){

            echo "<p class='error'>$message</p>";

        }

        ?>

        <form method="POST">

            <input

            type="text"

            name="full_name"

            placeholder="Full Name"

            required>

            <input

            type="email"

            name="email"

            placeholder="Email Address"

            required>

            <input

            type="text"

            name="mobile"

            placeholder="Mobile Number"

            maxlength="10"

            required>

            <input

            type="password"

            id="password"

            name="password"

            placeholder="Password"

            required>

            <input

            type="password"

            id="confirm_password"

            name="confirm_password"

            placeholder="Confirm Password"

            required>

            <button

            type="submit"

            name="register">

                Register

            </button>

        </form>

        <p>

            Already have an account?

            <a href="login.php">

                Login

            </a>

        </p>

    </div>

</div>

<script src="assets/js/register.js"></script>

</body>

</html>