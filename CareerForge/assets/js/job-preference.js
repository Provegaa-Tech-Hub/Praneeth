// ==========================================
// CareerForge Job Preference
// job-preference.js
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    const fresherRadio = document.getElementById("jobFresher");
    const experiencedRadio = document.getElementById("jobExperienced");
    const experienceSection = document.getElementById("experienceSection");

    // ==========================================
    // SHOW / HIDE EXPERIENCE SECTION
    // ==========================================

    function toggleExperience() {

        if (!experienceSection) return;

        if (experiencedRadio && experiencedRadio.checked) {

            experienceSection.style.display = "block";

        } else {

            experienceSection.style.display = "none";

        }

    }

    if (fresherRadio)
        fresherRadio.addEventListener("change", toggleExperience);

    if (experiencedRadio)
        experiencedRadio.addEventListener("change", toggleExperience);

    toggleExperience();

    // ==========================================
    // INPUT ANIMATION
    // ==========================================

    document.querySelectorAll("input, textarea, select").forEach(function (field) {

        field.addEventListener("focus", function () {

            this.style.borderColor = "#2563EB";
            this.style.boxShadow = "0 0 10px rgba(37,99,235,.2)";

        });

        field.addEventListener("blur", function () {

            this.style.borderColor = "#CBD5E1";
            this.style.boxShadow = "none";

        });

    });

    // ==========================================
    // FILE VALIDATION
    // ==========================================

    const resume = document.querySelector('input[name="resume"]');

    if (resume) {

        resume.addEventListener("change", function () {

            if (this.files.length === 0) return;

            const file = this.files[0];

            const size = file.size / 1024 / 1024;

            const allowed = [

                "application/pdf",

                "application/msword",

                "application/vnd.openxmlformats-officedocument.wordprocessingml.document"

            ];

            if (!allowed.includes(file.type)) {

                alert("Only PDF, DOC and DOCX files are allowed.");

                this.value = "";

                return;

            }

            if (size > 5) {

                alert("Resume size should not exceed 5 MB.");

                this.value = "";

                return;

            }

        });

    }

    // ==========================================
    // CHARACTER COUNTER
    // ==========================================

    document.querySelectorAll("textarea").forEach(function (textarea) {

        const counter = document.createElement("small");

        counter.style.display = "block";
        counter.style.marginTop = "6px";
        counter.style.color = "#64748B";

        textarea.parentNode.appendChild(counter);

        function updateCounter() {

            counter.innerHTML =
                textarea.value.length + " Characters";

        }

        updateCounter();

        textarea.addEventListener("input", updateCounter);

    });

    // ==========================================
    // FORM VALIDATION
    // ==========================================

    const form = document.querySelector("form");

    if (form) {

        form.addEventListener("submit", function (e) {

            const role = document.querySelector('input[name="job_role"]');

            if (role && role.value.trim() === "") {

                alert("Please enter Preferred Job Role.");

                role.focus();

                e.preventDefault();

                return;

            }

            if (!fresherRadio.checked && !experiencedRadio.checked) {

                alert("Please select Fresher or Experienced.");

                e.preventDefault();

                return;

            }

            const button = document.querySelector(".save-btn");

            if (button) {

                button.innerHTML =
                    '<i class="fa-solid fa-spinner fa-spin"></i> Saving...';

                button.disabled = true;

            }

        });

    }

    // ==========================================
    // CARD HOVER EFFECT
    // ==========================================

    document.querySelectorAll(".form-card").forEach(function (card) {

        card.addEventListener("mouseenter", function () {

            this.style.transform = "translateY(-5px)";

        });

        card.addEventListener("mouseleave", function () {

            this.style.transform = "translateY(0px)";

        });

    });

    // ==========================================
    // SCROLL REVEAL
    // ==========================================

    function revealCards() {

        const cards = document.querySelectorAll(".form-card");

        cards.forEach(function (card) {

            const top = card.getBoundingClientRect().top;

            if (top < window.innerHeight - 100) {

                card.style.opacity = "1";
                card.style.transform = "translateY(0px)";

            }

        });

    }

    document.querySelectorAll(".form-card").forEach(function (card) {

        card.style.opacity = "0";
        card.style.transform = "translateY(25px)";
        card.style.transition = ".5s";

    });

    revealCards();

    window.addEventListener("scroll", revealCards);

    // ==========================================
    // SUCCESS MESSAGE AUTO HIDE
    // ==========================================

    const success = document.querySelector(".success-message");

    if (success) {

        setTimeout(function () {

            success.style.opacity = "0";

            setTimeout(function () {

                success.remove();

            }, 500);

        }, 4000);

    }

    // ==========================================
    // END
    // ==========================================

    console.log("CareerForge Job Preference Loaded Successfully");

});