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
GET EDUCATION DETAILS
========================================== */

$educationQuery = mysqli_query(
    $conn,
    "SELECT * FROM candidate_education WHERE user_id='$userId' LIMIT 1"
);

$education = mysqli_fetch_assoc($educationQuery);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Education Details | CareerForge</title>

<link rel="stylesheet" href="../assets/css/education.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="sidebar">

    <div class="logo">

        <i class="fa-solid fa-graduation-cap"></i>

        <h2>CareerForge</h2>

    </div>

    <ul>

        <li>
            <a href="../dashboard/dashboard.php">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>
        </li>

        <li class="active">
            <i class="fa-solid fa-user-graduate"></i>
            Education
        </li>

    </ul>

</div>

<div class="main-content">
    <?php

if(isset($_SESSION['education_success'])){

?>

<div class="success-message">

    <i class="fa-solid fa-circle-check"></i>

    <?php

    echo $_SESSION['education_success'];

    unset($_SESSION['education_success']);

    ?>

</div>

<?php

}

?>

    <div class="page-header">

        <h1>

            <i class="fa-solid fa-user-graduate"></i>

            Education Details

        </h1>

        <p>

            Complete your academic information accurately.

        </p>

    </div>

    <!-- Candidate Card -->

    <div class="candidate-card">

        <img src="../assets/images/profile/<?php echo !empty($user['profile_photo']) ? htmlspecialchars($user['profile_photo']) : 'default.png'; ?>" alt="Profile">

        <div>

            <h2><?php echo htmlspecialchars($user['full_name']); ?></h2>

            <p><?php echo htmlspecialchars($user['email']); ?></p>

        </div>

    </div>

    <!-- Education Form Starts -->

    <form action="update-education.php" method="POST" enctype="multipart/form-data">

        <div class="form-card">

            <div class="card-title">

                <i class="fa-solid fa-school"></i>

                <h2>10th Class Details</h2>

            </div>

            <div class="form-grid">

            <!-- ==========================================
10TH CLASS DETAILS
========================================== -->

<div class="form-group">

    <label>School Name</label>

    <input
        type="text"
        name="school_name"
        placeholder="Enter School Name"
        value="<?php echo htmlspecialchars($education['school_name'] ?? ''); ?>"
        required>

</div>

<div class="form-group">

    <label>Board</label>

    <select name="board" required>

        <option value="">Select Board</option>

        <option value="SSC" <?php if(($education['board'] ?? '')=="SSC") echo "selected"; ?>>SSC</option>

        <option value="CBSE" <?php if(($education['board'] ?? '')=="CBSE") echo "selected"; ?>>CBSE</option>

        <option value="ICSE" <?php if(($education['board'] ?? '')=="ICSE") echo "selected"; ?>>ICSE</option>

        <option value="State Board" <?php if(($education['board'] ?? '')=="State Board") echo "selected"; ?>>State Board</option>

        <option value="Others" <?php if(($education['board'] ?? '')=="Others") echo "selected"; ?>>Others</option>

    </select>

</div>

<div class="form-group">

    <label>Passing Year</label>

    <input
        type="number"
        name="tenth_year"
        min="1990"
        max="<?php echo date('Y'); ?>"
        value="<?php echo htmlspecialchars($education['tenth_year'] ?? ''); ?>"
        required>

</div>

<div class="form-group">

    <label>Percentage / CGPA</label>

    <input
        type="text"
        name="tenth_percentage"
        placeholder="Example: 92.5 or 9.4 CGPA"
        value="<?php echo htmlspecialchars($education['tenth_percentage'] ?? ''); ?>"
        required>

</div>

</div>

</div>

<!-- ==========================================
INTERMEDIATE / DIPLOMA DETAILS
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-book-open"></i>

        <h2>Intermediate / Diploma Details</h2>

    </div>

    <div class="form-grid">

    <!-- ==========================================
INTERMEDIATE / DIPLOMA DETAILS
========================================== -->

<div class="form-group">

    <label>Qualification</label>

    <select name="qualification" required>

        <option value="">Select Qualification</option>

        <option value="Intermediate" <?php if(($education['qualification'] ?? '')=="Intermediate") echo "selected"; ?>>Intermediate</option>

        <option value="Diploma" <?php if(($education['qualification'] ?? '')=="Diploma") echo "selected"; ?>>Diploma</option>

        <option value="ITI" <?php if(($education['qualification'] ?? '')=="ITI") echo "selected"; ?>>ITI</option>

    </select>

</div>

<div class="form-group">

    <label>College / Institution Name</label>

    <input
        type="text"
        name="college_name"
        placeholder="Enter College Name"
        value="<?php echo htmlspecialchars($education['college_name'] ?? ''); ?>"
        required>

</div>

<div class="form-group">

    <label>Course / Branch</label>

    <input
        type="text"
        name="course"
        placeholder="Example: MPC / CEC / Mechanical / Civil"
        value="<?php echo htmlspecialchars($education['course'] ?? ''); ?>"
        required>

</div>

<div class="form-group">

    <label>Passing Year</label>

    <input
        type="number"
        name="inter_year"
        min="1990"
        max="<?php echo date('Y'); ?>"
        value="<?php echo htmlspecialchars($education['inter_year'] ?? ''); ?>"
        required>

</div>

<div class="form-group">

    <label>Percentage / CGPA</label>

    <input
        type="text"
        name="inter_percentage"
        placeholder="Enter Percentage or CGPA"
        value="<?php echo htmlspecialchars($education['inter_percentage'] ?? ''); ?>"
        required>

</div>

<div class="form-group">

    <label>Medium of Study</label>

    <select name="medium">

        <option value="">Select Medium</option>

        <option value="English" <?php if(($education['medium'] ?? '')=="English") echo "selected"; ?>>English</option>

        <option value="Telugu" <?php if(($education['medium'] ?? '')=="Telugu") echo "selected"; ?>>Telugu</option>

        <option value="Hindi" <?php if(($education['medium'] ?? '')=="Hindi") echo "selected"; ?>>Hindi</option>

    </select>

</div>

</div>

</div>

<!-- ==========================================
GRADUATION DETAILS
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-user-graduate"></i>

        <h2>Graduation Details</h2>

    </div>

    <div class="form-grid">

    <!-- ==========================================
GRADUATION DETAILS
========================================== -->

<div class="form-group">

    <label>Degree</label>

    <select name="degree" required>

        <option value="">Select Degree</option>

        <option value="B.Tech" <?php if(($education['degree'] ?? '')=="B.Tech") echo "selected"; ?>>B.Tech</option>

        <option value="B.E" <?php if(($education['degree'] ?? '')=="B.E") echo "selected"; ?>>B.E</option>

        <option value="B.Sc" <?php if(($education['degree'] ?? '')=="B.Sc") echo "selected"; ?>>B.Sc</option>

        <option value="B.Com" <?php if(($education['degree'] ?? '')=="B.Com") echo "selected"; ?>>B.Com</option>

        <option value="BBA" <?php if(($education['degree'] ?? '')=="BBA") echo "selected"; ?>>BBA</option>

        <option value="BA" <?php if(($education['degree'] ?? '')=="BA") echo "selected"; ?>>BA</option>

        <option value="Other" <?php if(($education['degree'] ?? '')=="Other") echo "selected"; ?>>Other</option>

    </select>

</div>

<div class="form-group">

    <label>University / College</label>

    <input
        type="text"
        name="university"
        placeholder="Enter University / College Name"
        value="<?php echo htmlspecialchars($education['university'] ?? ''); ?>"
        required>

</div>

<div class="form-group">

    <label>Branch / Specialization</label>

    <input
        type="text"
        name="branch"
        placeholder="Example: Computer Science Engineering"
        value="<?php echo htmlspecialchars($education['branch'] ?? ''); ?>"
        required>

</div>

<div class="form-group">

    <label>Passing Year</label>

    <input
        type="number"
        name="graduation_year"
        min="1990"
        max="<?php echo date('Y'); ?>"
        value="<?php echo htmlspecialchars($education['graduation_year'] ?? ''); ?>"
        required>

</div>

<div class="form-group">

    <label>Percentage / CGPA</label>

    <input
        type="text"
        name="graduation_percentage"
        placeholder="Enter Percentage or CGPA"
        value="<?php echo htmlspecialchars($education['graduation_percentage'] ?? ''); ?>"
        required>

</div>

<div class="form-group">

    <label>Current Status</label>

    <select name="graduation_status" required>

        <option value="">Select Status</option>

        <option value="Completed" <?php if(($education['graduation_status'] ?? '')=="Completed") echo "selected"; ?>>Completed</option>

        <option value="Pursuing" <?php if(($education['graduation_status'] ?? '')=="Pursuing") echo "selected"; ?>>Pursuing</option>

    </select>

</div>

</div>

</div>

<!-- ==========================================
POST GRADUATION & CERTIFICATIONS
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-award"></i>

        <h2>Post Graduation & Certifications</h2>

    </div>

    <div class="form-grid">

    <!-- ==========================================
POST GRADUATION
========================================== -->

<div class="form-group">

    <label>Post Graduation (Optional)</label>

    <input
        type="text"
        name="post_graduation"
        placeholder="Example: M.Tech, MBA, MCA"
        value="<?php echo htmlspecialchars($education['post_graduation'] ?? ''); ?>">

</div>

<div class="form-group">

    <label>Post Graduation Percentage / CGPA</label>

    <input
        type="text"
        name="pg_percentage"
        placeholder="Enter Percentage or CGPA"
        value="<?php echo htmlspecialchars($education['pg_percentage'] ?? ''); ?>">

</div>

<!-- ==========================================
CERTIFICATIONS
========================================== -->

<div class="form-group full-width">

    <label>Certifications</label>

    <textarea
        name="certifications"
        rows="4"
        placeholder="Example: Java, Python, AWS, CCNA"><?php echo htmlspecialchars($education['certifications'] ?? ''); ?></textarea>

</div>

<!-- ==========================================
RESUME
========================================== -->

<div class="form-group full-width">

    <label>Upload Resume (PDF / DOC / DOCX)</label>

    <input
        type="file"
        name="resume"
        accept=".pdf,.doc,.docx">

<?php if(!empty($education['resume'])){ ?>

<div class="uploaded-file">

    Current Resume :

    <a href="../uploads/resume/<?php echo htmlspecialchars($education['resume']); ?>" target="_blank">

        View Resume

    </a>

</div>

<?php } ?>

</div>

</div>

</div>

<!-- ==========================================
BUTTONS
========================================== -->

<div class="button-group">

    <button type="submit" class="save-btn">

        <i class="fa-solid fa-floppy-disk"></i>

        Save Education

    </button>

    <button type="reset" class="reset-btn">

        <i class="fa-solid fa-rotate-left"></i>

        Reset

    </button>

    <a href="../dashboard/dashboard.php" class="dashboard-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back to Dashboard

    </a>

</div>

</form>

</div>

<script src="../assets/js/education.js"></script>

</body>

</html>