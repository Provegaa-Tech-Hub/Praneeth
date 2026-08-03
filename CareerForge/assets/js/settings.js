// ==========================================
// CareerForge
// Settings
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    console.log("Settings Loaded");

    /* ==========================================
    PROFILE PHOTO PREVIEW
    ========================================== */

    const photoInput = document.querySelector('input[name="profile_photo"]');
    const profileImage = document.querySelector(".header-right img");

    if (photoInput && profileImage) {

        photoInput.addEventListener("change", function () {

            if (this.files && this.files[0]) {

                const file = this.files[0];

                if (!file.type.startsWith("image/")) {

                    alert("Please select a valid image.");

                    this.value = "";

                    return;

                }

                if (file.size > 2 * 1024 * 1024) {

                    alert("Profile photo must be less than 2 MB.");

                    this.value = "";

                    return;

                }

                const reader = new FileReader();

                reader.onload = function (e) {

                    profileImage.src = e.target.result;

                };

                reader.readAsDataURL(file);

            }

        });

    }

    /* ==========================================
    PASSWORD VALIDATION
    ========================================== */

    const form = document.getElementById("settingsForm");

    if (form) {

        form.addEventListener("submit", function (e) {

            const currentPassword = document.getElementById("currentPassword");
            const newPassword = document.getElementById("newPassword");
            const confirmPassword = document.getElementById("confirmPassword");

            if (

                newPassword.value !== "" ||

                confirmPassword.value !== "" ||

                currentPassword.value !== ""

            ) {

                if (currentPassword.value.trim() === "") {

                    alert("Enter your current password.");

                    currentPassword.focus();

                    e.preventDefault();

                    return;

                }

                if (newPassword.value.length < 6) {

                    alert("New password must contain at least 6 characters.");

                    newPassword.focus();

                    e.preventDefault();

                    return;

                }

                if (newPassword.value !== confirmPassword.value) {

                    alert("New password and Confirm Password do not match.");

                    confirmPassword.focus();

                    e.preventDefault();

                    return;

                }

            }

        });

    }

    /* ==========================================
    CARD ANIMATION
    ========================================== */

    const cards = document.querySelectorAll(".settings-card");

    cards.forEach(function (card, index) {

        card.style.opacity = "0";
        card.style.transform = "translateY(25px)";

        setTimeout(function () {

            card.style.transition = "all .5s ease";

            card.style.opacity = "1";

            card.style.transform = "translateY(0)";

        }, index * 150);

    });

    /* ==========================================
    INPUT FOCUS EFFECT
    ========================================== */

    const inputs = document.querySelectorAll("input");

    inputs.forEach(function (input) {

        input.addEventListener("focus", function () {

            this.parentElement.style.transform = "scale(1.02)";

        });

        input.addEventListener("blur", function () {

            this.parentElement.style.transform = "scale(1)";

        });

    });

});