// ==========================================
// CareerForge
// Application Form
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");

    const resumeInput = document.querySelector('input[name="resume"]');

    const declaration = document.querySelector(
        'input[type="checkbox"]'
    );

    const submitBtn = document.querySelector(".submit-btn");

    // ==========================================
    // Resume Validation
    // ==========================================

    function validateResume() {

        if (!resumeInput.files.length) {

            return true;

        }

        const file = resumeInput.files[0];

        const allowedTypes = [

            "application/pdf",

            "application/msword",

            "application/vnd.openxmlformats-officedocument.wordprocessingml.document"

        ];

        const maxSize = 5 * 1024 * 1024; // 5MB

        if (!allowedTypes.includes(file.type)) {

            alert("Only PDF, DOC and DOCX files are allowed.");

            resumeInput.value = "";

            return false;

        }

        if (file.size > maxSize) {

            alert("Resume size must be less than 5 MB.");

            resumeInput.value = "";

            return false;

        }

        return true;

    }

    resumeInput.addEventListener("change", validateResume);

        // ==========================================
    // Form Submit Validation
    // ==========================================

    form.addEventListener("submit", function (e) {

        const coverLetter =
            document.querySelector(
                'textarea[name="cover_letter"]'
            );

        const joiningTime =
            document.querySelector(
                'select[name="joining_time"]'
            );

        // Cover Letter

        if (coverLetter.value.trim().length < 30) {

            e.preventDefault();

            alert(
                "Please write a cover letter with at least 30 characters."
            );

            coverLetter.focus();

            return;

        }

        // Joining Time

        if (joiningTime.value === "") {

            e.preventDefault();

            alert("Please select your joining availability.");

            joiningTime.focus();

            return;

        }

        // Resume

        if (!validateResume()) {

            e.preventDefault();

            return;

        }

        // Declaration

        if (!declaration.checked) {

            e.preventDefault();

            alert("Please accept the declaration.");

            return;

        }

        // Loading State

        submitBtn.disabled = true;

        submitBtn.innerHTML =
            '<i class="fa-solid fa-spinner fa-spin"></i> Submitting Application...';

    });

        // ==========================================
    // Expected CTC Validation
    // ==========================================

    const expectedCTC =
        document.querySelector(
            'input[name="expected_ctc"]'
        );

    if (expectedCTC) {

        expectedCTC.addEventListener("input", function () {

            this.value = this.value.replace(
                /[^0-9A-Za-z.,\s-]/g,
                ""
            );

        });

    }

    // ==========================================
    // Auto Resize Cover Letter
    // ==========================================

    const textarea =
        document.querySelector(
            'textarea[name="cover_letter"]'
        );

    if (textarea) {

        textarea.addEventListener("input", function () {

            this.style.height = "auto";

            this.style.height = this.scrollHeight + "px";

        });

    }

});