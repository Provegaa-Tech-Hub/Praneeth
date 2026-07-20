// ==========================
// Show / Hide Password
// ==========================

const password = document.getElementById("regPassword");
const showPassword = document.getElementById("showPassword");

showPassword.addEventListener("click", function () {

    if (password.type === "password") {

        password.type = "text";

        showPassword.classList.remove("fa-eye");
        showPassword.classList.add("fa-eye-slash");

    } else {

        password.type = "password";

        showPassword.classList.remove("fa-eye-slash");
        showPassword.classList.add("fa-eye");

    }

});


// ==========================
// Registration Validation
// ==========================

document.querySelector("form").addEventListener("submit", function (e) {

    e.preventDefault();

    let name = document.querySelector(
        'input[placeholder="Full Name"]'
    ).value.trim();

    let email = document.querySelector(
        'input[placeholder="Email Address"]'
    ).value.trim();

    let mobile = document.querySelector(
        'input[placeholder="Mobile Number"]'
    ).value.trim();

    let pass = document.getElementById("regPassword").value;

    let confirmPass = document.getElementById("confirmPassword").value;

    if (name === "" || email === "" || mobile === "" || pass === "") {

        alert("Please fill all details");
        return;

    }

    if (pass !== confirmPass) {

        alert("Password and Confirm Password are not matching");
        return;

    }

    // ==========================
    // Save Candidate Details
    // ==========================

    localStorage.setItem("fullName", name);
    localStorage.setItem("email", email);
    localStorage.setItem("mobile", mobile);
    localStorage.setItem("password", pass);

    // ==========================
    // Registration Success
    // ==========================

    alert("Registration Successful");

    // Redirect

    window.location.href = "candidate-dashboard.html";

});