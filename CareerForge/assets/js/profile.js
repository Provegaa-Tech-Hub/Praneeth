// ======================================
// PROFILE PHOTO PREVIEW
// ======================================

const profileImage = document.getElementById("profileImage");
const profilePreview = document.getElementById("profilePreview");

if (profileImage) {

    profileImage.addEventListener("change", function () {

        if (this.files.length > 0) {

            const reader = new FileReader();

            reader.onload = function (e) {

                profilePreview.src = e.target.result;

            };

            reader.readAsDataURL(this.files[0]);

        }

    });

}


// ======================================
// AADHAAR BOXES
// ======================================

const aadhaarBoxes = document.querySelectorAll(".aadhaar-input");
const aadhaarHidden = document.getElementById("aadhaar");

function updateAadhaar() {

    let number = "";

    aadhaarBoxes.forEach(box => {

        number += box.value;

    });

    if (aadhaarHidden) {

        aadhaarHidden.value = number;

    }

}

aadhaarBoxes.forEach((box, index) => {

    box.addEventListener("input", function () {

        this.value = this.value.replace(/\D/g, "");

        updateAadhaar();

        if (this.value !== "" && index < aadhaarBoxes.length - 1) {

            aadhaarBoxes[index + 1].focus();

        }

    });

    box.addEventListener("keydown", function (e) {

        if (e.key === "Backspace" && this.value === "" && index > 0) {

            aadhaarBoxes[index - 1].focus();

        }

    });

});

if (aadhaarBoxes.length > 0) {

    aadhaarBoxes[0].addEventListener("paste", function (e) {

        e.preventDefault();

        let text = (e.clipboardData || window.clipboardData)
            .getData("text")
            .replace(/\D/g, "")
            .substring(0, 12);

        aadhaarBoxes.forEach((box, i) => {

            box.value = text[i] || "";

        });

        updateAadhaar();

    });

}


// ======================================
// PAN BOXES
// ======================================

const panBoxes = document.querySelectorAll(".pan-input");
const panHidden = document.getElementById("pan");

function updatePan() {

    let pan = "";

    panBoxes.forEach(box => {

        pan += box.value.toUpperCase();

    });

    if (panHidden) {

        panHidden.value = pan;

    }

}

panBoxes.forEach((box, index) => {

    box.addEventListener("input", function () {

        let value = this.value.toUpperCase();

        if (index < 5 || index === 9) {

            value = value.replace(/[^A-Z]/g, "");

        } else {

            value = value.replace(/\D/g, "");

        }

        this.value = value;

        updatePan();

        if (value !== "" && index < panBoxes.length - 1) {

            panBoxes[index + 1].focus();

        }

    });

    box.addEventListener("keydown", function (e) {

        if (e.key === "Backspace" && this.value === "" && index > 0) {

            panBoxes[index - 1].focus();

        }

    });

});

if (panBoxes.length > 0) {

    panBoxes[0].addEventListener("paste", function (e) {

        e.preventDefault();

        let text = (e.clipboardData || window.clipboardData)
            .getData("text")
            .toUpperCase()
            .replace(/[^A-Z0-9]/g, "")
            .substring(0, 10);

        panBoxes.forEach((box, i) => {

            box.value = text[i] || "";

        });

        updatePan();

    });

}


// ======================================
// PROFILE COMPLETION
// ======================================

const form = document.querySelector("form");
const progressFill = document.getElementById("progressFill");
const progressText = document.getElementById("progressText");

function calculateProfile() {

    if (!form) return;

    const fields = form.querySelectorAll(
        "input[type='text'], input[type='email'], input[type='date'], textarea, select"
    );

    let total = 0;
    let filled = 0;

    fields.forEach(field => {

        if (
            field.classList.contains("aadhaar-input") ||
            field.classList.contains("pan-input")
        ) {
            return;
        }

        total++;

        if (field.value.trim() !== "") {

            filled++;

        }

    });

    let percent = Math.round((filled / total) * 100);

    if (progressFill) {

        progressFill.style.width = percent + "%";

    }

    if (progressText) {

        progressText.innerHTML = percent + "%";

    }

}

if (form) {

    form.addEventListener("input", calculateProfile);

    calculateProfile();

}


// ======================================
// BEFORE SUBMIT
// ======================================

if (form) {

    form.addEventListener("submit", function () {

        updateAadhaar();
        updatePan();

    });

}