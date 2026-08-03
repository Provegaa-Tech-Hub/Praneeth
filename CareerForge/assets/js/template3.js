// ==========================================
// TEMPLATE 3
// CareerForge
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    console.log("Executive Resume Loaded");

    /* ==========================================
    PRINT BUTTON
    ========================================== */

    const printBtn = document.querySelector(".print-btn");

    if (printBtn) {

        printBtn.addEventListener("click", function () {

            window.print();

        });

    }

    /* ==========================================
    CARD ANIMATION
    ========================================== */

    const cards = document.querySelectorAll(

        ".timeline-content, .card-box, .experience-box, .skill-box"

    );

    cards.forEach((card, index) => {

        card.style.opacity = "0";
        card.style.transform = "translateY(30px)";

        setTimeout(() => {

            card.style.transition = "all .5s ease";
            card.style.opacity = "1";
            card.style.transform = "translateY(0)";

        }, index * 120);

    });

    /* ==========================================
    SECTION ANIMATION
    ========================================== */

    const sections = document.querySelectorAll(".resume-section");

    sections.forEach((section, index) => {

        section.style.opacity = "0";

        setTimeout(() => {

            section.style.transition = "opacity .6s ease";
            section.style.opacity = "1";

        }, index * 100);

    });

    /* ==========================================
    SMOOTH SCROLL
    ========================================== */

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {

        anchor.addEventListener("click", function (e) {

            e.preventDefault();

            const target = document.querySelector(this.getAttribute("href"));

            if (target) {

                target.scrollIntoView({

                    behavior: "smooth",
                    block: "start"

                });

            }

        });

    });

    /* ==========================================
    IMAGE FALLBACK
    ========================================== */

    const profileImage = document.querySelector(".profile-photo img");

    if (profileImage) {

        profileImage.onerror = function () {

            this.src = "../assets/images/profile/default.png";

        };

    }

    /* ==========================================
    CURRENT YEAR
    ========================================== */

    const year = document.getElementById("currentYear");

    if (year) {

        year.textContent = new Date().getFullYear();

    }

});