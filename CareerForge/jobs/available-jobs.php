<?php
session_start();

require_once("../database/db.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");

    exit();

}

$userId = $_SESSION['user_id'];

/* ==========================================
GET USER DETAILS
========================================== */

$userQuery = mysqli_query(

    $conn,

    "SELECT * FROM users WHERE id='$userId'"

);

$user = mysqli_fetch_assoc($userQuery);

/* ==========================================
SEARCH & FILTER
========================================== */

$search = "";

$location = "";

if(isset($_GET['search'])){

    $search = mysqli_real_escape_string(

        $conn,

        trim($_GET['search'])

    );

}

if(isset($_GET['location'])){

    $location = mysqli_real_escape_string(

        $conn,

        trim($_GET['location'])

    );

}

/* ==========================================
FETCH JOBS
========================================== */

$sql = "SELECT * FROM jobs WHERE status='Open'";

if($search!=""){

$sql .= " AND (

job_title LIKE '%$search%'

OR company_name LIKE '%$search%'

OR skills_required LIKE '%$search%'

)";

}

if($location!=""){

$sql .= " AND location='$location'";

}

$sql .= " ORDER BY created_at DESC";

$jobs = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Available Jobs | CareerForge

</title>

<link
rel="stylesheet"
href="../assets/css/available-jobs.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="container">

<!-- ==========================================
PAGE HEADER
========================================== -->

<header class="page-header">

<div class="header-left">

<h1>

<i class="fa-solid fa-briefcase"></i>

Available Jobs

</h1>

<p>

Find your dream job and apply online.

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

<?php

echo htmlspecialchars($user['full_name']);

?>

</h3>

<p>

<?php

echo !empty($user['career_choice'])

? htmlspecialchars($user['career_choice'])

: "Candidate";

?>

</p>

</div>

</div>

</header>

<!-- ==========================================
SEARCH SECTION
========================================== -->

<form method="GET" class="search-section">

    <div class="search-box">

        <i class="fa-solid fa-magnifying-glass"></i>

        <input
            type="text"
            name="search"
            placeholder="Search by Job Title, Company or Skills..."
            value="<?php echo htmlspecialchars($search); ?>">

    </div>

    <select name="location">

        <option value="">All Locations</option>

        <option value="Hyderabad" <?php if($location=="Hyderabad") echo "selected"; ?>>Hyderabad</option>

        <option value="Bangalore" <?php if($location=="Bangalore") echo "selected"; ?>>Bangalore</option>

        <option value="Chennai" <?php if($location=="Chennai") echo "selected"; ?>>Chennai</option>

        <option value="Pune" <?php if($location=="Pune") echo "selected"; ?>>Pune</option>

        <option value="Mumbai" <?php if($location=="Mumbai") echo "selected"; ?>>Mumbai</option>

        <option value="Delhi" <?php if($location=="Delhi") echo "selected"; ?>>Delhi</option>

        <option value="Remote" <?php if($location=="Remote") echo "selected"; ?>>Remote</option>

    </select>

    <button type="submit">

        <i class="fa-solid fa-filter"></i>

        Search

    </button>

</form>

<!-- ==========================================
JOBS GRID
========================================== -->

<div class="jobs-grid">

<?php

if(mysqli_num_rows($jobs) > 0){

while($job = mysqli_fetch_assoc($jobs)){

$logo = !empty($job['company_logo'])

? "../assets/images/companies/".$job['company_logo']

: "../assets/images/companies/default-company.png";

?>

<div class="job-card">

    <div class="company-header">

        <img
            src="<?php echo $logo; ?>"
            alt="Company Logo">

        <div class="company-info">

            <h2>

                <?php echo htmlspecialchars($job['job_title']); ?>

            </h2>

            <h4>

                <?php echo htmlspecialchars($job['company_name']); ?>

            </h4>

        </div>

    </div>
        <!-- ==========================================
    JOB DETAILS
    ========================================== -->

    <div class="job-details">

        <div class="detail-item">

            <i class="fa-solid fa-location-dot"></i>

            <span>

                <?php echo htmlspecialchars($job['location']); ?>

            </span>

        </div>

        <div class="detail-item">

            <i class="fa-solid fa-money-bill-wave"></i>

            <span>

                <?php echo htmlspecialchars($job['salary']); ?>

            </span>

        </div>

        <div class="detail-item">

            <i class="fa-solid fa-briefcase"></i>

            <span>

                <?php echo htmlspecialchars($job['experience_required']); ?>

            </span>

        </div>

        <div class="detail-item">

            <i class="fa-solid fa-graduation-cap"></i>

            <span>

                <?php echo htmlspecialchars($job['education_required']); ?>

            </span>

        </div>

        <div class="detail-item">

            <i class="fa-solid fa-users"></i>

            <span>

                <?php echo $job['vacancies']; ?> Vacancies

            </span>

        </div>

        <div class="detail-item">

            <i class="fa-solid fa-calendar-days"></i>

            <span>

                Last Date :
                <?php echo date("d M Y", strtotime($job['last_date'])); ?>

            </span>

        </div>

    </div>

    <!-- ==========================================
    JOB DESCRIPTION
    ========================================== -->

    <div class="job-description">

        <?php

        echo substr(

            strip_tags($job['job_description']),

            0,

            150

        );

        ?>

        ...

    </div>

    <!-- ==========================================
    CATEGORY
    ========================================== -->

    <div class="job-category">

        <span class="category">

            <?php echo htmlspecialchars($job['job_category']); ?>

        </span>

        <span class="employment">

            <?php echo htmlspecialchars($job['employment_type']); ?>

        </span>

    </div>

        <!-- ==========================================
    REQUIRED SKILLS
    ========================================== -->

    <div class="skills">

<?php

$skills = explode(",", $job['skills_required']);

foreach($skills as $skill){

?>

        <span>

            <?php echo htmlspecialchars(trim($skill)); ?>

        </span>

<?php

}

?>

    </div>

    <!-- ==========================================
    ACTION BUTTONS
    ========================================== -->

    <div class="job-footer">

        <a
        href="job-details.php?id=<?php echo $job['id']; ?>"
        class="details-btn">

            <i class="fa-solid fa-eye"></i>

            View Details

        </a>

        <a
        href="application-form.php?id=<?php echo $job['id']; ?>"
        class="apply-btn">

            <i class="fa-solid fa-paper-plane"></i>

            Apply Now

        </a>

    </div>

</div>

<?php

}

?>

<?php

}else{

?>

<div class="no-jobs">

    <i class="fa-solid fa-briefcase"></i>

    <h2>

        No Jobs Available

    </h2>

    <p>

        Sorry! There are currently no open jobs matching your search.

    </p>

</div>

<?php

}

?>

</div>

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

<!-- ==========================================
JAVASCRIPT
========================================== -->

<script src="../assets/js/available-jobs.js"></script>

</body>

</html>