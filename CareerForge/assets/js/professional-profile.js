// ==========================================
// CareerForge Professional Profile
// professional-profile.js
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    initializeProfile();

    profileTypeToggle();

    formAnimation();

    resumePreview();

    autoResizeTextarea();

    revealCards();

});

// ==========================================
// INITIALIZE PROFILE
// ==========================================

function initializeProfile() {

    const fresher = document.getElementById("fresherRadio");
    const experienced = document.getElementById("experiencedRadio");

    const fresherSection = document.getElementById("fresherSection");
    const experiencedSection = document.getElementById("experiencedSection");

    const categoryCard = document.getElementById("categoryCard");

    if (fresher && fresher.checked) {

        if (fresherSection)
            fresherSection.style.display = "block";

        if (experiencedSection)
            experiencedSection.style.display = "none";

        if (categoryCard)
            categoryCard.style.display = "block";

    }

    else if (experienced && experienced.checked) {

        if (experiencedSection)
            experiencedSection.style.display = "block";

        if (fresherSection)
            fresherSection.style.display = "none";

        if (categoryCard)
            categoryCard.style.display = "block";

    }

    else {

        if (fresherSection)
            fresherSection.style.display = "none";

        if (experiencedSection)
            experiencedSection.style.display = "none";

        if (categoryCard)
            categoryCard.style.display = "none";

    }

}

// ==========================================
// PROFILE TYPE TOGGLE
// ==========================================

function profileTypeToggle() {

    const fresher = document.getElementById("fresherRadio");
    const experienced = document.getElementById("experiencedRadio");

    if (fresher) {

        fresher.addEventListener("change", function () {

            showFresher();

            showCategory();

        });

    }

    if (experienced) {

        experienced.addEventListener("change", function () {

            showExperienced();

            showCategory();

        });

    }

}

// ==========================================
// SHOW FRESHER
// ==========================================

function showFresher() {

    const fresherSection = document.getElementById("fresherSection");
    const experiencedSection = document.getElementById("experiencedSection");

    if (fresherSection) {

        fresherSection.style.display = "block";
        fresherSection.classList.add("active");

    }

    if (experiencedSection) {

        experiencedSection.style.display = "none";
        experiencedSection.classList.remove("active");

    }

}

// ==========================================
// SHOW EXPERIENCED
// ==========================================

function showExperienced() {

    const fresherSection = document.getElementById("fresherSection");
    const experiencedSection = document.getElementById("experiencedSection");

    if (experiencedSection) {

        experiencedSection.style.display = "block";
        experiencedSection.classList.add("active");

    }

    if (fresherSection) {

        fresherSection.style.display = "none";
        fresherSection.classList.remove("active");

    }

}

// ==========================================
// SHOW IT / NON-IT CARD
// ==========================================

function showCategory() {

    const fresher = document.getElementById("fresherRadio");
    const experienced = document.getElementById("experiencedRadio");

    const categoryCard = document.getElementById("categoryCard");

    if (!categoryCard) return;

    if ((fresher && fresher.checked) ||
        (experienced && experienced.checked)) {

        categoryCard.style.display = "block";

    } else {

        categoryCard.style.display = "none";

    }

}

// ==========================================
// FORM ANIMATION
// ==========================================

function formAnimation() {

    const cards = document.querySelectorAll(".form-card");

    cards.forEach((card, index) => {

        card.style.opacity = "0";
        card.style.transform = "translateY(25px)";

        setTimeout(() => {

            card.style.transition = ".4s ease";
            card.style.opacity = "1";
            card.style.transform = "translateY(0px)";

        }, index * 150);

    });

}


// ==========================================
// RESUME FILE PREVIEW
// ==========================================

function resumePreview() {

    const resumeInput = document.querySelector('input[name="resume"]');

    if (!resumeInput) return;

    resumeInput.addEventListener("change", function () {

        if (this.files.length > 0) {

            const file = this.files[0];

            alert("Selected Resume : " + file.name);

        }

    });

}

// ==========================================
// AUTO RESIZE TEXTAREA
// ==========================================

function autoResizeTextarea() {

    const textareas = document.querySelectorAll("textarea");

    textareas.forEach(textarea => {

        textarea.addEventListener("input", function () {

            this.style.height = "auto";
            this.style.height = this.scrollHeight + "px";

        });

    });

}

// ==========================================
// FORM VALIDATION
// ==========================================

const profileForm = document.querySelector("form");

if (profileForm) {

    profileForm.addEventListener("submit", function (e) {

        const selected = document.querySelector(
            'input[name="professional_type"]:checked'
        );

        if (!selected) {

            alert("Please select Fresher or Experienced.");

            e.preventDefault();

            return;

        }

        if (selected.value === "Fresher") {

            const skills = document.querySelector(
                'input[name="technical_skills"]'
            );

            if (skills && skills.value.trim() === "") {

                alert("Please enter Technical Skills.");

                skills.focus();

                e.preventDefault();

                return;

            }

        }

        if (selected.value === "Experienced") {

            const company = document.querySelector(
                'input[name="current_company"]'
            );

            if (company && company.value.trim() === "") {

                alert("Please enter Current Company.");

                company.focus();

                e.preventDefault();

                return;

            }

        }

    });

}

// ==========================================
// RESET CONFIRMATION
// ==========================================

const resetBtn = document.querySelector(".reset-btn");

if (resetBtn) {

    resetBtn.addEventListener("click", function (e) {

        const ok = confirm(
            "Are you sure you want to reset all entered information?"
        );

        if (!ok) {

            e.preventDefault();

        }

    });

}

// ==========================================
// SUCCESS MESSAGE AUTO HIDE
// ==========================================

const successBox = document.querySelector(".success-message");

if (successBox) {

    setTimeout(function () {

        successBox.style.display = "none";

    }, 4000);

}

// ==========================================
// SCROLL REVEAL
// ==========================================

function revealCards() {

    const cards = document.querySelectorAll(".form-card");

    cards.forEach(function (card) {

        const top = card.getBoundingClientRect().top;

        if (top < window.innerHeight - 80) {

            card.style.opacity = "1";
            card.style.transform = "translateY(0px)";

        }

    });

}

window.addEventListener("scroll", revealCards);

window.addEventListener("load", revealCards);

// ==========================================
// PROFESSIONAL CATEGORY CHANGE
// ==========================================

const category = document.getElementById("professionalCategory");

if (category) {

    category.addEventListener("change", function () {

        console.log("Category Selected :", this.value);

    });

}

// ==========================================
// CONSOLE
// ==========================================

console.log(
    "%cProfessional Profile Loaded Successfully",
    "color:#2563EB;font-size:18px;font-weight:bold;"
);

// ==========================================
// END OF FILE
// ==========================================