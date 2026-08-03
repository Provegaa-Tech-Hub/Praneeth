// =====================================
// Candidate Dashboard
// =====================================

window.onload = function () {

    // ==========================
    // Candidate Information
    // ==========================

    let fullName = localStorage.getItem("fullName") || "Candidate";
    let email = localStorage.getItem("email") || "Not Available";
    let mobile = localStorage.getItem("mobile") || "Not Available";
    let degree = localStorage.getItem("degree") || "Not Selected";
    let career = localStorage.getItem("careerChoice") || "Not Selected";
    let location = localStorage.getItem("preferredLocation") || "Not Selected";

    // Welcome Name

    document.getElementById("candidateName").innerHTML = fullName;

    // Summary

    document.getElementById("summaryName").innerHTML = fullName;
    document.getElementById("summaryEmail").innerHTML = email;
    document.getElementById("summaryMobile").innerHTML = mobile;
    document.getElementById("summaryDegree").innerHTML = degree;
    document.getElementById("summaryCareer").innerHTML = career;

    // Cards

    document.getElementById("degree").innerHTML = degree;
    document.getElementById("careerChoice").innerHTML = career;
    document.getElementById("location").innerHTML = location;

    // Greeting

    let hour = new Date().getHours();

    let greeting = "Welcome";

    if(hour < 12){

        greeting = "Good Morning";

    }

    else if(hour < 17){

        greeting = "Good Afternoon";

    }

    else{

        greeting = "Good Evening";

    }

    document.querySelector(".top-header h1").innerHTML =
    greeting + ", <span id='candidateName'>" + fullName + "</span> 👋";

};



// =====================================
// Profile
// =====================================

function openProfile(){

    window.location.href="profile.html";

}



// =====================================
// Education
// =====================================

function openEducation(){

    window.location.href="education.html";

}



// =====================================
// Experience
// =====================================

function openExperience(){

    window.location.href="experience.html";

}



// =====================================
// Skills
// =====================================

function openSkills(){

    window.location.href="skills.html";

}



// =====================================
// Resume
// =====================================

function openResume(){

    window.location.href="upload-resume.html";

}



// =====================================
// Applications
// =====================================

function openApplications(){

    window.location.href="applications.html";

}



// =====================================
// Notifications
// =====================================

function openNotifications(){

    window.location.href="notifications.html";

}



// =====================================
// Settings
// =====================================

function openSettings(){

    window.location.href="settings.html";

}



// =====================================
// Print Profile
// =====================================

function printProfile(){

    window.print();

}



// =====================================
// Logout
// =====================================

function logout(){

    let logoutConfirm = confirm("Are you sure you want to Logout?");

    if(logoutConfirm){

        // Remove only login session

        localStorage.removeItem("isLoggedIn");

        alert("Logout Successful");

        // Redirect to Login Page

        window.location.href = "../login.html";

    }

}



// =====================================
// Console
// =====================================

console.log("Candidate Dashboard Loaded Successfully");