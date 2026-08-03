// ==========================================
// Profile Page
// ==========================================

window.onload = function () {

    // Load Registration Details

    document.getElementById("fullName").value =
    localStorage.getItem("fullName") || "";

    document.getElementById("email").value =
    localStorage.getItem("email") || "";

    document.getElementById("mobile").value =
    localStorage.getItem("mobile") || "";

    // Load Saved Profile

    document.getElementById("dob").value =
    localStorage.getItem("dob") || "";

    document.getElementById("gender").value =
    localStorage.getItem("gender") || "";

    document.getElementById("aadhaar").value =
    localStorage.getItem("aadhaar") || "";

    document.getElementById("pan").value =
    localStorage.getItem("pan") || "";

    document.getElementById("address").value =
    localStorage.getItem("address") || "";

    document.getElementById("city").value =
    localStorage.getItem("city") || "";

    document.getElementById("state").value =
    localStorage.getItem("state") || "";

    document.getElementById("pincode").value =
    localStorage.getItem("pincode") || "";

    document.getElementById("linkedin").value =
    localStorage.getItem("linkedin") || "";

    document.getElementById("github").value =
    localStorage.getItem("github") || "";

    // Load Profile Image

    let image = localStorage.getItem("profileImage");

    if(image){

        document.getElementById("profilePreview").src = image;

    }

};



// ==========================================
// Profile Image Preview
// ==========================================

document.getElementById("profileImage").addEventListener("change",function(){

    let file = this.files[0];

    if(file){

        let reader = new FileReader();

        reader.onload = function(e){

            document.getElementById("profilePreview").src =
            e.target.result;

            localStorage.setItem(
                "profileImage",
                e.target.result
            );

        }

        reader.readAsDataURL(file);

    }

});



// ==========================================
// Save Profile
// ==========================================

document.getElementById("profileForm").addEventListener("submit",function(e){

    e.preventDefault();

    localStorage.setItem(
        "fullName",
        document.getElementById("fullName").value
    );

    localStorage.setItem(
        "email",
        document.getElementById("email").value
    );

    localStorage.setItem(
        "mobile",
        document.getElementById("mobile").value
    );

    localStorage.setItem(
        "dob",
        document.getElementById("dob").value
    );

    localStorage.setItem(
        "gender",
        document.getElementById("gender").value
    );

    localStorage.setItem(
        "aadhaar",
        document.getElementById("aadhaar").value
    );

    localStorage.setItem(
        "pan",
        document.getElementById("pan").value
    );

    localStorage.setItem(
        "address",
        document.getElementById("address").value
    );

    localStorage.setItem(
        "city",
        document.getElementById("city").value
    );

    localStorage.setItem(
        "state",
        document.getElementById("state").value
    );

    localStorage.setItem(
        "pincode",
        document.getElementById("pincode").value
    );

    localStorage.setItem(
        "linkedin",
        document.getElementById("linkedin").value
    );

    localStorage.setItem(
        "github",
        document.getElementById("github").value
    );

    alert("Profile Saved Successfully");

    window.location.href="candidate-dashboard.html";

});



// ==========================================
// Console
// ==========================================

console.log("Profile Page Loaded Successfully");