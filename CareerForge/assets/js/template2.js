// ==========================================
// TEMPLATE 2
// CareerForge
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    console.log("Template 2 Loaded");

    /* ==========================================
    PRINT
    ========================================== */

    const printBtn = document.querySelector(".print-btn");

    if (printBtn) {

        printBtn.addEventListener("click", function () {

            window.print();

        });

    }

    /* ==========================================
    SMOOTH SCROLL
    ========================================== */

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {

        anchor.addEventListener("click", function (e) {

            e.preventDefault();

            document.querySelector(this.getAttribute("href")).scrollIntoView({

                behavior: "smooth"

            });

        });

    });

    /* ==========================================
    ANIMATION
    ========================================== */

    const sections = document.querySelectorAll(".resume-section");

    sections.forEach((section, index) => {

        section.style.opacity = "0";

        section.style.transform = "translateY(20px)";

        setTimeout(() => {

            section.style.transition = "all .5s ease";

            section.style.opacity = "1";

            section.style.transform = "translateY(0)";

        }, index * 150);

    });

});