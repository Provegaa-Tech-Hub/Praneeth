// ==========================================
// CareerForge Mock Exams
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    const examCards = document.querySelectorAll(".exam-card");

    const startButtons = document.querySelectorAll(".start-btn");

    const resultButtons = document.querySelectorAll(".result-btn");

    /* ==========================================
       CARD HOVER EFFECT
    ========================================== */

    examCards.forEach(function(card){

        card.addEventListener("mouseenter", function(){

            card.style.transform = "translateY(-8px)";

        });

        card.addEventListener("mouseleave", function(){

            card.style.transform = "translateY(0px)";

        });

    });

    /* ==========================================
       START EXAM BUTTON
    ========================================== */

    startButtons.forEach(function(button){

        button.addEventListener("click", function(){

            button.innerHTML =
            '<i class="fa-solid fa-spinner fa-spin"></i> Starting...';

            button.style.pointerEvents = "none";

        });

    });

    /* ==========================================
       RESULT BUTTON
    ========================================== */

    resultButtons.forEach(function(button){

        button.addEventListener("click", function(){

            button.innerHTML =
            '<i class="fa-solid fa-spinner fa-spin"></i> Loading...';

            button.style.pointerEvents = "none";

        });

    });

        /* ==========================================
       PAGE FADE IN
    ========================================== */

    document.body.style.opacity = "0";

    window.addEventListener("load", function(){

        document.body.style.transition = "opacity .5s ease";

        document.body.style.opacity = "1";

    });

    /* ==========================================
       SCROLL REVEAL ANIMATION
    ========================================== */

    function revealCards(){

        examCards.forEach(function(card){

            const top = card.getBoundingClientRect().top;

            const trigger = window.innerHeight - 80;

            if(top < trigger){

                card.classList.add("show-card");

            }

        });

    }

    window.addEventListener("scroll", revealCards);

    revealCards();

    /* ==========================================
       RIPPLE EFFECT
    ========================================== */

    const buttons = document.querySelectorAll(".start-btn, .result-btn");

    buttons.forEach(function(btn){

        btn.addEventListener("mousedown", function(){

            btn.style.transform = "scale(0.97)";

        });

        btn.addEventListener("mouseup", function(){

            btn.style.transform = "scale(1)";

        });

        btn.addEventListener("mouseleave", function(){

            btn.style.transform = "scale(1)";

        });

    });

    /* ==========================================
       TOOLTIP
    ========================================== */

    startButtons.forEach(function(button){

        button.title = "Click to start this mock exam";

    });

    resultButtons.forEach(function(button){

        button.title = "View your previous exam result";

    });

});