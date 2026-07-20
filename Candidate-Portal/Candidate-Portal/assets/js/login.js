// ==========================
// Password Show / Hide
// ==========================

const passwordInput = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");

togglePassword.addEventListener("click", function () {

    if (passwordInput.type === "password") {

        passwordInput.type = "text";

        togglePassword.classList.remove("fa-eye");
        togglePassword.classList.add("fa-eye-slash");

    } else {

        passwordInput.type = "password";

        togglePassword.classList.remove("fa-eye-slash");
        togglePassword.classList.add("fa-eye");

    }

});


// ==========================
// Login
// ==========================

document.querySelector("form").addEventListener("submit", function (e) {

    e.preventDefault();

    let email = document.querySelector('input[type="email"]').value.trim();

    let password = document.getElementById("password").value;

    if (email === "" || password === "") {

        alert("Please enter Email and Password");
        return;

    }

    // Registered Details

    let savedEmail = localStorage.getItem("email");
    let savedPassword = localStorage.getItem("password");

    if (email === savedEmail && password === savedPassword) {

        localStorage.setItem("isLoggedIn", "true");

        alert("Login Successful");

        window.location.href = "pages/candidate-dashboard.html";

    } else {

        alert("Invalid Email or Password");

    }

});