// ==========================================
// CareerForge Education
// education.js
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    initializeEducation();

    educationProgress();

    yearValidation();

    filePreview();

    formAnimation();

});

// ==========================================
// SHOW/HIDE EDUCATION SECTIONS
// ==========================================

function initializeEducation() {

    const educationPath = document.getElementById("educationPath");

    if (!educationPath) return;

    function toggleSections() {

        const value = educationPath.value;

        const inter = document.getElementById("intermediateSection");
        const diploma = document.getElementById("diplomaSection");
        const iti = document.getElementById("itiSection");

        if (inter) inter.style.display = "none";
        if (diploma) diploma.style.display = "none";
        if (iti) iti.style.display = "none";

        if (value === "Intermediate") {

            if (inter) inter.style.display = "block";

        }

        if (value === "Diploma") {

            if (diploma) diploma.style.display = "block";

        }

        if (value === "ITI") {

            if (iti) iti.style.display = "block";

        }

    }

    toggleSections();

    educationPath.addEventListener("change", toggleSections);

}

// ==========================================
// EDUCATION COMPLETION
// ==========================================

function educationProgress() {

    const inputs = document.querySelectorAll(

        "input[type=text],input[type=number],select,textarea"

    );

    let filled = 0;

    inputs.forEach(input => {

        if (input.value.trim() !== "") {

            filled++;

        }

    });

    const total = inputs.length;

    const percentage = Math.round((filled / total) * 100);

    const progress = document.getElementById("educationProgress");

    if (progress) {

        progress.innerHTML = percentage + "%";

    }

}

// ==========================================
// AUTO UPDATE PROGRESS
// ==========================================

document.querySelectorAll(

    "input,select,textarea"

).forEach(field => {

    field.addEventListener("input", educationProgress);

    field.addEventListener("change", educationProgress);

});

// ==========================================
// YEAR VALIDATION
// ==========================================

function yearValidation() {

    const years = document.querySelectorAll(

        "input[type=number]"

    );

    years.forEach(input => {

        input.addEventListener("blur", function () {

            const current = new Date().getFullYear();

            if (

                this.value !== "" &&

                (this.value < 1990 || this.value > current + 5)

            ) {

                alert("Please enter a valid passing year.");

                this.focus();

            }

        });

    });

}


// ==========================================
// FILE NAME PREVIEW
// ==========================================

function filePreview() {

    const files = document.querySelectorAll("input[type=file]");

    files.forEach(file => {

        file.addEventListener("change", function () {

            if (this.files.length > 0) {

                const fileName = this.files[0].name;

                let info = this.parentElement.querySelector(".selected-file");

                if (!info) {

                    info = document.createElement("p");

                    info.className = "selected-file";

                    info.style.marginTop = "8px";

                    info.style.color = "#2563EB";

                    info.style.fontWeight = "600";

                    this.parentElement.appendChild(info);

                }

                info.innerHTML =
                    '<i class="fa-solid fa-file"></i> ' + fileName;

            }

        });

    });

}

// ==========================================
// FORM CARD ANIMATION
// ==========================================

function formAnimation() {

    const cards = document.querySelectorAll(".form-card");

    cards.forEach((card, index) => {

        card.style.opacity = "0";

        card.style.transform = "translateY(30px)";

        setTimeout(() => {

            card.style.transition = ".5s ease";

            card.style.opacity = "1";

            card.style.transform = "translateY(0)";

        }, index * 150);

    });

}

// ==========================================
// FORM SUBMIT CONFIRMATION
// ==========================================

const educationForm = document.querySelector("form");

if (educationForm) {

    educationForm.addEventListener("submit", function (e) {

        const requiredFields = document.querySelectorAll(

            "input[required], select[required], textarea[required]"

        );

        let valid = true;

        requiredFields.forEach(field => {

            if (field.value.trim() === "") {

                valid = false;

                field.style.border = "2px solid red";

            } else {

                field.style.border = "";

            }

        });

        if (!valid) {

            e.preventDefault();

            alert("Please fill all required fields.");

            return;

        }

        alert("Education details saved successfully.");

    });

}

// ==========================================
// RESET CONFIRMATION
// ==========================================

const resetBtn = document.querySelector(".reset-btn");

if (resetBtn) {

    resetBtn.addEventListener("click", function (e) {

        if (!confirm("Are you sure you want to reset the form?")) {

            e.preventDefault();

        }

    });

}

// ==========================================
// SCROLL REVEAL
// ==========================================

function revealCards() {

    const cards = document.querySelectorAll(".form-card");

    const trigger = window.innerHeight - 80;

    cards.forEach(card => {

        const top = card.getBoundingClientRect().top;

        if (top < trigger) {

            card.style.opacity = "1";

            card.style.transform = "translateY(0)";

        }

    });

}

window.addEventListener("scroll", revealCards);

window.addEventListener("load", revealCards);

// ==========================================
// AUTO FOCUS FIRST INPUT
// ==========================================

window.addEventListener("load", () => {

    const firstInput = document.querySelector("input, select, textarea");

    if (firstInput) {

        firstInput.focus();

    }

});

// ==========================================
// CONSOLE MESSAGE
// ==========================================

console.log(

    "%cCareerForge Education Module Loaded Successfully",

    "color:#2563EB;font-size:16px;font-weight:bold;"

);

// ==========================================
// END OF FILE
// ==========================================