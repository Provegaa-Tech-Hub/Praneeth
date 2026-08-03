// ==========================================
// CareerForge
// Upload Resume
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    console.log("Upload Resume Loaded");

    /* ==========================================
    FILE INPUT
    ========================================== */

    const resumeInput = document.getElementById("resume");

    const fileName = document.getElementById("fileName");

    if (resumeInput) {

        resumeInput.addEventListener("change", function () {

            if (this.files.length > 0) {

                const file = this.files[0];

                const allowed = [

                    "application/pdf",

                    "application/msword",

                    "application/vnd.openxmlformats-officedocument.wordprocessingml.document"

                ];

                /* ==========================================
                FILE TYPE
                ========================================== */

                if (!allowed.includes(file.type)) {

                    alert("Only PDF, DOC and DOCX files are allowed.");

                    this.value = "";

                    fileName.innerHTML = "No file selected";

                    return;

                }

                /* ==========================================
                FILE SIZE
                ========================================== */

                if (file.size > 5 * 1024 * 1024) {

                    alert("Maximum file size is 5 MB.");

                    this.value = "";

                    fileName.innerHTML = "No file selected";

                    return;

                }

                fileName.innerHTML =

                    '<i class="fa-solid fa-file"></i> ' +

                    file.name +

                    " (" +

                    (file.size / 1024 / 1024).toFixed(2) +

                    " MB)";

            }

        });

    }

    /* ==========================================
    FORM VALIDATION
    ========================================== */

    const form = document.getElementById("resumeForm");

    if (form) {

        form.addEventListener("submit", function (e) {

            if (!resumeInput.value) {

                e.preventDefault();

                alert("Please select your resume.");

                return false;

            }

        });

    }

    /* ==========================================
    DELETE CONFIRMATION
    ========================================== */

    const deleteBtn = document.querySelector(".delete-btn");

    if (deleteBtn) {

        deleteBtn.addEventListener("click", function (e) {

            if (!confirm("Delete your uploaded resume?")) {

                e.preventDefault();

            }

        });

    }

    /* ==========================================
    CARD ANIMATION
    ========================================== */

    const cards = document.querySelectorAll(

        ".upload-card,.resume-card,.guidelines"

    );

    cards.forEach(function (card, index) {

        card.style.opacity = "0";

        card.style.transform = "translateY(25px)";

        setTimeout(function () {

            card.style.transition = "all .5s ease";

            card.style.opacity = "1";

            card.style.transform = "translateY(0)";

        }, index * 150);

    });

});