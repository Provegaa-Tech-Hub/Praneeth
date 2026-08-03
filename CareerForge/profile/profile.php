<?php

session_start();

require_once("../database/db.php");


// ======================================
// CHECK LOGIN
// ======================================

if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");
    exit();

}


$userId = $_SESSION['user_id'];


// ======================================
// FETCH USER
// ======================================

$query = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE id='$userId'"
);


if(!$query || mysqli_num_rows($query)==0){

    die("User not found.");

}


$user = mysqli_fetch_assoc($query);



// ======================================
// PROFILE PHOTO
// ======================================

$profilePhoto = "../assets/images/profile/default.png";


if(
    !empty($user['profile_photo']) &&
    file_exists("../assets/images/profile/".$user['profile_photo'])
){

    $profilePhoto =
    "../assets/images/profile/".$user['profile_photo'];

}



// ======================================
// DATE
// ======================================

$dob="";


if(
    !empty($user['dob']) &&
    $user['dob']!="0000-00-00"
){

    $dob=$user['dob'];

}



?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width,initial-scale=1.0">


<title>
My Profile | CareerForge
</title>


<link rel="stylesheet"
href="../assets/css/profile.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


</head>


<body>



<!-- ==============================
SIDEBAR
============================== -->


<aside class="sidebar">


<div class="logo">

<i class="fa-solid fa-graduation-cap"></i>

<h2>
CareerForge
</h2>

</div>



<ul>


<li onclick="location.href='../dashboard/dashboard.php'">

<i class="fa-solid fa-house"></i>

<span>
Dashboard
</span>

</li>



<li class="active">

<i class="fa-solid fa-user"></i>

<span>
My Profile
</span>

</li>



<li onclick="location.href='../education/education.php'">

<i class="fa-solid fa-school"></i>

<span>
Education
</span>

</li>



<li onclick="location.href='../professional/professional-profile.php'">

<i class="fa-solid fa-user-tie"></i>

<span>
Professional Profile
</span>

</li>



<li onclick="location.href='../jobs/available-jobs.php'">

<i class="fa-solid fa-briefcase"></i>

<span>
Available Jobs
</span>

</li>



<li onclick="location.href='../mock-exams/index.php'">

<i class="fa-solid fa-book-open"></i>

<span>
Mock Exams
</span>

</li>



<li onclick="location.href='../jobs/available-jobs.php'">

<i class="fa-solid fa-building"></i>

<span>
Available Jobs
</span>

</li>



<li onclick="location.href='../logout.php'">

<i class="fa-solid fa-right-from-bracket"></i>

<span>
Logout
</span>

</li>


</ul>


</aside>




<!-- ==============================
MAIN CONTENT
============================== -->


<div class="main-content">



<div class="page-header">


<h1>

<i class="fa-solid fa-user"></i>

My Profile

</h1>


<p>
Manage your profile information.
</p>


</div>






<form
action="update-photo.php"
method="POST"
enctype="multipart/form-data">


<label for="profileImage" class="change-photo">

<i class="fa-solid fa-camera"></i>

Change Photo

</label>


<input
type="file"
id="profileImage"
name="profile_image"
accept="image/*"
hidden
onchange="this.form.submit()">


</form>





<form
action="update-profile.php"
method="POST"
enctype="multipart/form-data">


<div class="profile-card">


<!-- PROFILE IMAGE -->


<div class="photo-section">


<img

id="profilePreview"

src="<?php echo $profilePhoto; ?>"

alt="Profile Photo">








</div>

<!-- ======================================
PROFILE DETAILS
====================================== -->


<div class="profile-form">


<h2>

<i class="fa-solid fa-id-card"></i>

Personal Information

</h2>



<div class="form-grid">



<div class="form-group">

<label>
Full Name
</label>

<input

type="text"

name="full_name"

value="<?php echo htmlspecialchars($user['full_name'] ?? ''); ?>"

required>

</div>




<div class="form-group">

<label>
Email Address
</label>


<input

type="email"

name="email"

value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>"

required>

</div>




<div class="form-group">

<label>
Mobile Number
</label>


<input

type="text"

name="mobile"

maxlength="10"

value="<?php echo htmlspecialchars($user['mobile'] ?? ''); ?>">

</div>




<div class="form-group">

<label>
Date of Birth
</label>


<input

type="date"

name="dob"

value="<?php echo $dob; ?>">

</div>




<div class="form-group">

<label>
Gender
</label>


<select name="gender">


<option value="">
Select Gender
</option>


<option value="Male"
<?php if(($user['gender'] ?? '')=="Male") echo "selected"; ?>>
Male
</option>


<option value="Female"
<?php if(($user['gender'] ?? '')=="Female") echo "selected"; ?>>
Female
</option>


<option value="Other"
<?php if(($user['gender'] ?? '')=="Other") echo "selected"; ?>>
Other
</option>


</select>


</div>




<div class="form-group">

<label>
Blood Group
</label>


<select name="blood_group">


<option value="">
Select
</option>


<?php

$groups=[
"A+","A-",
"B+","B-",
"AB+","AB-",
"O+","O-"
];


foreach($groups as $group){


$selected="";


if(($user['blood_group'] ?? '')==$group){

$selected="selected";

}


echo "<option value='$group' $selected>$group</option>";

}


?>


</select>


</div>




<div class="form-group">

<label>
Marital Status
</label>


<select name="marital_status">


<option value="">
Select
</option>


<option value="Single"
<?php if(($user['marital_status'] ?? '')=="Single") echo "selected"; ?>>
Single
</option>


<option value="Married"
<?php if(($user['marital_status'] ?? '')=="Married") echo "selected"; ?>>
Married
</option>


</select>


</div>




<div class="form-group">


<label>
Nationality
</label>


<input

type="text"

name="nationality"

value="<?php echo htmlspecialchars($user['nationality'] ?? 'Indian'); ?>">


</div>



</div>





<hr>




<!-- CONTACT INFORMATION -->


<h2>

<i class="fa-solid fa-address-book"></i>

Contact Information

</h2>




<div class="form-grid">



<div class="form-group">

<label>
Father's Name
</label>


<input

type="text"

name="father_name"

value="<?php echo htmlspecialchars($user['father_name'] ?? ''); ?>">


</div>




<div class="form-group">

<label>
Mother's Name
</label>


<input

type="text"

name="mother_name"

value="<?php echo htmlspecialchars($user['mother_name'] ?? ''); ?>">


</div>




<div class="form-group">

<label>
Emergency Contact
</label>


<input

type="text"

name="emergency_contact"

maxlength="10"

value="<?php echo htmlspecialchars($user['emergency_contact'] ?? ''); ?>">


</div>




<div class="form-group">

<label>
Alternate Mobile
</label>


<input

type="text"

name="alternate_mobile"

maxlength="10"

value="<?php echo htmlspecialchars($user['alternate_mobile'] ?? ''); ?>">


</div>



</div>





<hr>





<!-- ADDRESS -->


<h2>

<i class="fa-solid fa-location-dot"></i>

Address Information

</h2>




<div class="form-grid">



<div class="form-group full-width">

<label>
Address
</label>


<textarea

name="address"

rows="4">

<?php echo htmlspecialchars($user['address'] ?? ''); ?>

</textarea>


</div>




<div class="form-group">

<label>
City
</label>


<input

type="text"

name="city"

value="<?php echo htmlspecialchars($user['city'] ?? ''); ?>">


</div>




<div class="form-group">

<label>
State
</label>


<input

type="text"

name="state"

value="<?php echo htmlspecialchars($user['state'] ?? ''); ?>">


</div>




<div class="form-group">

<label>
Pincode
</label>


<input

type="text"

name="pincode"

maxlength="6"

value="<?php echo htmlspecialchars($user['pincode'] ?? ''); ?>">


</div>




<div class="form-group">

<label>
Country
</label>


<input

type="text"

name="country"

value="<?php echo htmlspecialchars($user['country'] ?? 'India'); ?>">


</div>



</div>





<hr>


<!-- IDENTITY DETAILS -->

<h2>

<i class="fa-solid fa-id-card"></i>

Identity Details

</h2>


<div class="form-grid">



<!-- AADHAAR -->

<div class="form-group">


<label>
Aadhaar Number
</label>



<div class="aadhaar-boxes">


<?php

$aadhaar = preg_replace('/\D/', '', $user['aadhaar'] ?? '');

$aadhaar = str_pad($aadhaar,12," ");



for($i=0;$i<12;$i++){

?>

<input
type="text"
maxlength="1"
class="aadhaar-input small-box"
value="<?php echo trim($aadhaar[$i]); ?>">


<?php

}

?>


</div>



<input

type="hidden"

id="aadhaar"

name="aadhaar"

value="<?php echo htmlspecialchars($user['aadhaar'] ?? ''); ?>">



</div>





<!-- PAN -->

<div class="form-group">


<label>
PAN Number
</label>



<div class="pan-boxes">


<?php


$pan = strtoupper($user['pan'] ?? '');

$pan = str_pad($pan,10," ");



for($i=0;$i<10;$i++){


?>


<input

type="text"

maxlength="1"

class="pan-input small-box"

value="<?php echo trim($pan[$i]); ?>">


<?php

}

?>


</div>



<input

type="hidden"

id="pan"

name="pan"

value="<?php echo htmlspecialchars($user['pan'] ?? ''); ?>">



</div>



</div>

<hr>

<!-- ======================================
SOCIAL PROFILES
====================================== -->

<h2>

<i class="fa-solid fa-share-nodes"></i>

Social Profiles

</h2>

<div class="form-grid">

    <!-- LinkedIn -->

    <div class="form-group">

        <label>LinkedIn Profile</label>

        <input
            type="url"
            name="linkedin"
            placeholder="https://www.linkedin.com/in/username"
            value="<?php echo htmlspecialchars($user['linkedin'] ?? ''); ?>">

    </div>

    <!-- GitHub -->

    <div class="form-group">

        <label>GitHub Profile</label>

        <input
            type="url"
            name="github"
            placeholder="https://github.com/username"
            value="<?php echo htmlspecialchars($user['github'] ?? ''); ?>">

    </div>

    <!-- Instagram -->

    <div class="form-group">

        <label>Instagram Profile</label>

        <input
            type="url"
            name="instagram"
            placeholder="https://instagram.com/username"
            value="<?php echo htmlspecialchars($user['instagram'] ?? ''); ?>">

    </div>

    <!-- Portfolio -->

    <div class="form-group">

        <label>Portfolio Website</label>

        <input
            type="url"
            name="portfolio"
            placeholder="https://yourportfolio.com"
            value="<?php echo htmlspecialchars($user['portfolio'] ?? ''); ?>">

    </div>

</div>
<!-- ======================================
END PROFILE FORM
====================================== -->


<div class="button-group">


<button 
type="submit"
class="save-btn">

<i class="fa-solid fa-floppy-disk"></i>

Save Profile

</button>




<button 
type="reset"
class="reset-btn">

<i class="fa-solid fa-rotate-left"></i>

Reset

</button>




<a href="../dashboard/dashboard.php"
class="cancel-btn">

<i class="fa-solid fa-arrow-left"></i>

Back to Dashboard

</a>



</div>



</div>

</div>


</form>




<!-- SUCCESS MESSAGE -->

<?php if(isset($_GET['success'])){ ?>

<div class="alert success">

<i class="fa-solid fa-circle-check"></i>

Profile Updated Successfully.

</div>

<?php } ?>




<?php if(isset($_GET['error'])){ ?>

<div class="alert error">

<i class="fa-solid fa-circle-xmark"></i>

Something went wrong.

</div>

<?php } ?>






<!-- PROFILE COMPLETION -->


<div class="profile-progress-card">


<h3>

<i class="fa-solid fa-chart-line"></i>

Profile Completion

</h3>



<div class="progress-bar">

<div 
class="progress-fill"
id="progressFill">

</div>

</div>



<h2 id="progressText">
0%
</h2>



<p>

Complete your profile to unlock more opportunities.

</p>



</div>






<!-- PROFILE SUMMARY -->


<div class="profile-summary">



<div class="summary-box">

<h4>

<i class="fa-solid fa-user"></i>

Candidate ID

</h4>


<p>

CF-<?php echo str_pad($userId,6,"0",STR_PAD_LEFT); ?>

</p>


</div>





<div class="summary-box">

<h4>

<i class="fa-solid fa-envelope"></i>

Email

</h4>


<p>

<?php echo htmlspecialchars($user['email'] ?? ''); ?>

</p>


</div>





<div class="summary-box">

<h4>

<i class="fa-solid fa-phone"></i>

Mobile

</h4>


<p>

<?php echo htmlspecialchars($user['mobile'] ?? ''); ?>

</p>


</div>





<div class="summary-box">

<h4>

<i class="fa-solid fa-location-dot"></i>

Location

</h4>


<p>


<?php

echo htmlspecialchars(

($user['city'] ?? '') .

(!empty($user['state']) ? ", ".$user['state'] : "")

);


?>


</p>


</div>



</div>






<footer class="profile-footer">


<p>

© <?php echo date("Y"); ?>

CareerForge Candidate Portal.

All Rights Reserved.

</p>


</footer>



</div>







<script>


// ================================
// IMAGE PREVIEW
// ================================


document
.getElementById("profileImage")
.addEventListener("change",function(e){


let reader=new FileReader();


reader.onload=function(){

document
.getElementById("profilePreview")
.src=reader.result;


}


reader.readAsDataURL(e.target.files[0]);


});





// ================================
// AADHAAR BOX MERGE
// ================================


let aadhaarBoxes =
document.querySelectorAll(".aadhaar-input");


aadhaarBoxes.forEach((box,index)=>{


box.addEventListener("input",()=>{


if(box.value.length==1 && index<11){

aadhaarBoxes[index+1].focus();

}


let value="";


aadhaarBoxes.forEach(b=>{

value += b.value;

});


document.getElementById("aadhaar").value=value;


});


});







// ================================
// PAN BOX MERGE
// ================================


let panBoxes =
document.querySelectorAll(".pan-input");


panBoxes.forEach((box,index)=>{


box.addEventListener("input",()=>{


if(box.value.length==1 && index<9){

panBoxes[index+1].focus();

}



let value="";


panBoxes.forEach(b=>{

value += b.value;

});


document.getElementById("pan").value=value;


});


});





</script>



<script src="../assets/js/profile.js"></script>



</body>

</html>