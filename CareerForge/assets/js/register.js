// ==========================================
// CareerForge Registration JavaScript
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");

    const fullName = document.querySelector("input[name='full_name']");
    const email = document.querySelector("input[name='email']");
    const mobile = document.querySelector("input[name='mobile']");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");

    // ==========================
    // Mobile Number Validation
    // ==========================

    mobile.addEventListener("input", function () {
        this.value = this.value.replace(/\D/g, "");

        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });

    // ==========================
    // Password Strength
    // ==========================

    password.addEventListener("input", function () {

        let value = this.value;

        if (value.length < 6) {
            this.style.borderColor = "#ef4444";
        }
        else if (value.length < 8) {
            this.style.borderColor = "#f59e0b";
        }
        else {
            this.style.borderColor = "#22c55e";
        }

    });

    // ==========================
    // Form Validation
    // ==========================

    form.addEventListener("submit", function (e) {

        if (fullName.value.trim() === "") {
            alert("Please enter Full Name");
            fullName.focus();
            e.preventDefault();
            return;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email.value)) {
            alert("Enter a valid Email Address");
            email.focus();
            e.preventDefault();
            return;
        }

        if (mobile.value.length !== 10) {
            alert("Mobile Number must contain exactly 10 digits");
            mobile.focus();
            e.preventDefault();
            return;
        }

        if (password.value.length < 6) {
            alert("Password should contain at least 6 characters");
            password.focus();
            e.preventDefault();
            return;
        }

        if (password.value !== confirmPassword.value) {
            alert("Passwords do not match");
            confirmPassword.focus();
            e.preventDefault();
            return;
        }

    });

});
