<?php

session_start();

/* ==========================================
DESTROY SESSION
========================================== */

$_SESSION = [];

session_unset();

session_destroy();

/* ==========================================
CLEAR SESSION COOKIE
========================================== */

if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(

        session_name(),

        '',

        time() - 42000,

        $params["path"],

        $params["domain"],

        $params["secure"],

        $params["httponly"]

    );

}

/* ==========================================
REDIRECT TO LOGIN
========================================== */

header("Location: login.php");

exit();

?>