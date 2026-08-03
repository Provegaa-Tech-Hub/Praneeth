// ==========================================
// CareerForge Login JavaScript
// ==========================================

document.addEventListener("DOMContentLoaded", () => {

    const password = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");
    const form = document.querySelector("form");
    const username = document.querySelector("input[name='username']");

    // ==========================
    // Show / Hide Password
    // ==========================

    togglePassword.addEventListener("click", () => {

        if (password.type === "password") {
            password.type = "text";
            togglePassword.innerHTML = "🙈";
        } else {
            password.type = "password";
            togglePassword.innerHTML = "👁";
        }

    });

    // ==========================
    // Username Validation
    // ==========================

    username.addEventListener("input", function () {
        this.value = this.value.trim();
    });

    // ==========================
    // Form Validation
    // ==========================

    form.addEventListener("submit", function (e) {

        if (username.value === "") {
            alert("Please enter Email or Mobile Number");
            username.focus();
            e.preventDefault();
            return;
        }

        if (password.value === "") {
            alert("Please enter Password");
            password.focus();
            e.preventDefault();
            return;
        }

    });

    // ==========================
    // Enter Key Support
    // ==========================

    document.addEventListener("keydown", function (e) {

        if (e.key === "Enter") {
            form.requestSubmit();
        }

    });

});