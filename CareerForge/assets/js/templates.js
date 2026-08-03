/* ==========================================
CAREERFORGE
RESUME TEMPLATES
========================================== */

document.addEventListener("DOMContentLoaded", function () {

    const useButtons = document.querySelectorAll(".use-btn");

    const previewButtons = document.querySelectorAll(".preview-btn");

    /* ==========================================
    USE TEMPLATE
    ========================================== */

    useButtons.forEach(function(button){

        button.addEventListener("click", function(e){

            const confirmSelection = confirm(
                "Do you want to use this resume template?"
            );

            if(!confirmSelection){

                e.preventDefault();

            }

        });

    });

    /* ==========================================
    PREVIEW EFFECT
    ========================================== */

    previewButtons.forEach(function(button){

        button.addEventListener("mouseenter", function(){

            this.style.transform = "translateY(-2px)";

        });

        button.addEventListener("mouseleave", function(){

            this.style.transform = "translateY(0)";

        });

    });

    /* ==========================================
    TEMPLATE CARD HOVER
    ========================================== */

    const cards = document.querySelectorAll(".template-card");

    cards.forEach(function(card){

        card.addEventListener("mouseenter", function(){

            this.style.transition = ".35s";

        });

    });

});