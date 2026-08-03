<?php

session_start();

require_once("../database/db.php");

if(!isset($_SESSION['user_id'])){

    header("Location: ../login.php");
    exit();

}

$userId=$_SESSION['user_id'];

/* ==========================================
GET USER DETAILS
========================================== */

$userQuery=mysqli_query(

$conn,

"SELECT *
FROM users
WHERE id='$userId'"

);

if(mysqli_num_rows($userQuery)==0){

    die("Candidate not found.");

}

$user=mysqli_fetch_assoc($userQuery);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Settings | CareerForge

</title>

<link
rel="stylesheet"
href="../assets/css/settings.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="container">

<!-- ==========================================
HEADER
========================================== -->

<header class="page-header">

<div class="header-left">

<h1>

<i class="fa-solid fa-gear"></i>

Account Settings

</h1>

<p>

Manage your CareerForge account settings.

</p>

</div>

<div class="header-right">

<img

src="../assets/images/profile/<?php

echo !empty($user['profile_photo'])

? htmlspecialchars($user['profile_photo'])

: "default.png";

?>"

alt="Profile">

<div>

<h3>

<?php echo htmlspecialchars($user['full_name']); ?>

</h3>

<p>

<?php

echo !empty($user['job_role'])

? htmlspecialchars($user['job_role'])

: "Candidate";

?>

</p>

</div>

</div>

</header>

<!-- ==========================================
SETTINGS FORM
========================================== -->

<form

action="update-settings.php"

method="POST"

enctype="multipart/form-data"

id="settingsForm">

<div class="settings-card">

<h2>

Profile Settings

</h2>

<div class="form-grid">

<div class="form-group">

<label>

Full Name

</label>

<input

type="text"

name="full_name"

value="<?php echo htmlspecialchars($user['full_name']); ?>"

required>

</div>

<div class="form-group">

<label>

Email Address

</label>

<input

type="email"

name="email"

value="<?php echo htmlspecialchars($user['email']); ?>"

required>

</div>

<div class="form-group">

<label>

Mobile Number

</label>

<input

type="text"

name="mobile"

value="<?php echo htmlspecialchars($user['mobile']); ?>"

required>

</div>

<div class="form-group">

<label>

Profile Photo

</label>

<input

type="file"

name="profile_photo"

accept="image/*">

</div>

<!-- ==========================================
NOTIFICATION SETTINGS
========================================== -->

<div class="settings-card">

<h2>

Notification Preferences

</h2>

<div class="checkbox-group">

<label>

<input
type="checkbox"
name="email_notifications"
checked>

Email Notifications

</label>

<label>

<input
type="checkbox"
name="job_notifications"
checked>

Job Alerts

</label>

<label>

<input
type="checkbox"
name="interview_notifications"
checked>

Interview Notifications

</label>

<label>

<input
type="checkbox"
name="exam_notifications"
checked>

Mock Test Notifications

</label>

</div>

</div>

<!-- ==========================================
CHANGE PASSWORD
========================================== -->

<div class="settings-card">

<h2>

Change Password

</h2>

<div class="form-grid">

<div class="form-group">

<label>

Current Password

</label>

<input

type="password"

name="current_password"

id="currentPassword"

placeholder="Enter current password">

</div>

<div class="form-group">

<label>

New Password

</label>

<input

type="password"

name="new_password"

id="newPassword"

placeholder="Enter new password">

</div>

<div class="form-group">

<label>

Confirm Password

</label>

<input

type="password"

name="confirm_password"

id="confirmPassword"

placeholder="Confirm new password">

</div>

</div>

</div>

<!-- ==========================================
BUTTONS
========================================== -->

<div class="button-group">

<button

type="submit"

class="save-btn">

<i class="fa-solid fa-floppy-disk"></i>

Save Changes

</button>

<a

href="../dashboard/dashboard.php"

class="dashboard-btn">

<i class="fa-solid fa-house"></i>

Back to Dashboard

</a>

</div>

</form>

<!-- ==========================================
FOOTER
========================================== -->

<footer class="page-footer">

<p>

© <?php echo date("Y"); ?>

CareerForge Recruitment Portal.

All Rights Reserved.

</p>

</footer>

</div>

<script src="../assets/js/settings.js"></script>

</body>

</html>