/* ==========================================
TEMPLATE 1
========================================== */

document.addEventListener("DOMContentLoaded", function () {

    console.log("Template 1 Loaded");

    /* ==========================================
    PRINT BUTTON
    ========================================== */

    const printBtn = document.querySelector(".print-btn");

    if (printBtn) {

        printBtn.addEventListener("click", function (e) {

            e.preventDefault();

            window.print();

        });

    }

    /* ==========================================
    SMOOTH SCROLL
    ========================================== */

    window.scrollTo({

        top: 0,

        behavior: "smooth"

    });

    /* ==========================================
    BUTTON HOVER EFFECT
    ========================================== */

    const buttons = document.querySelectorAll(".print-btn, .back-btn, .dashboard-btn");

    buttons.forEach(function(button){

        button.addEventListener("mouseenter", function(){

            this.style.transition = ".3s";

        });

    });

});