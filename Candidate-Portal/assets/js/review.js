// ===============================
// Review & Print Page
// ===============================

function getValue(key) {
    return localStorage.getItem(key) || "Not Available";
}

// ===============================
// Personal Details
// ===============================

document.getElementById("name").textContent =
    getValue("fullName");

document.getElementById("email").textContent =
    getValue("email");

document.getElementById("mobile").textContent =
    getValue("mobile");


// ===============================
// 10th Details
// ===============================

document.getElementById("school").textContent =
    getValue("schoolName");

document.getElementById("schoolYear").textContent =
    getValue("schoolPassoutYear");

document.getElementById("schoolPercentage").textContent =
    getValue("schoolPercentage");


// ===============================
// Intermediate / Diploma / ITI
// ===============================

// ===============================
// Intermediate / Diploma / ITI
// ===============================

const educationPath =
getValue("educationPath");

document.getElementById("qualification").textContent =
educationPath;



if(educationPath==="Diploma"){

    document.getElementById("course").textContent =
    getValue("diplomaCourse");

    document.getElementById("college").textContent =
    getValue("diplomaCollege");

    document.getElementById("interYear").textContent =
    getValue("diplomaYear");

    document.getElementById("interPercentage").textContent =
    getValue("diplomaPercentage");

}

else if(educationPath==="Intermediate"){

    document.getElementById("course").textContent =
    getValue("interCourse");

    document.getElementById("college").textContent =
    getValue("interCollege");

    document.getElementById("interYear").textContent =
    getValue("interYear");

    document.getElementById("interPercentage").textContent =
    getValue("interPercentage");

}

else if(educationPath==="ITI"){

    document.getElementById("course").textContent =
    getValue("itiTrade");

    document.getElementById("college").textContent =
    getValue("itiCollege");

    document.getElementById("interYear").textContent =
    getValue("itiYear");

    document.getElementById("interPercentage").textContent =
    getValue("itiPercentage");

}

// ===============================
// Graduation
// ===============================

document.getElementById("degree").textContent =
    getValue("degree");

document.getElementById("branch").textContent =
    getValue("courseBranch");

document.getElementById("gradCollege").textContent =
    getValue("graduationCollege");

document.getElementById("university").textContent =
    getValue("university");

document.getElementById("gradYear").textContent =
    getValue("graduationYear");

document.getElementById("gradPercentage").textContent =
    getValue("graduationPercentage");


// ===============================
// Career Details
// ===============================

document.getElementById("career").textContent =
    getValue("careerChoice");

document.getElementById("experience").textContent =
    getValue("experience");

document.getElementById("jobRole").textContent =
    getValue("jobRole");

document.getElementById("skills").textContent =
    getValue("skills");

document.getElementById("location").textContent =
    getValue("preferredLocation");

document.getElementById("salary").textContent =
    getValue("expectedSalary");


// ===============================
// Finish Button
// ===============================

document
.getElementById("finishBtn")
.addEventListener("click", function () {

    alert("Application submitted successfully!");

    window.location.href = "candidate-dashboard.html";

});