// ==========================================
// CareerForge Exam
// ==========================================

document.addEventListener("DOMContentLoaded", function () {

    const questions =
        document.querySelectorAll(".question-card");

    const prevBtn =
        document.getElementById("prevBtn");

    const nextBtn =
        document.getElementById("nextBtn");

    const submitBtn =
        document.getElementById("submitBtn");

    const progressFill =
        document.getElementById("progressFill");

    const timer =
        document.getElementById("timer");

    const form =
        document.getElementById("examForm");

    let currentQuestion = 0;

    /* ==========================================
       SHOW QUESTION
    ========================================== */

    function showQuestion(index){

        questions.forEach(function(question){

            question.style.display = "none";

        });

        questions[index].style.display = "block";

        updateButtons();

        updateProgress();

    }

    /* ==========================================
       UPDATE BUTTONS
    ========================================== */

    function updateButtons(){

        prevBtn.style.display =
            currentQuestion === 0
            ? "none"
            : "inline-block";

        if(currentQuestion === questions.length - 1){

            nextBtn.style.display = "none";

            submitBtn.style.display = "inline-block";

        }else{

            nextBtn.style.display = "inline-block";

            submitBtn.style.display = "none";

        }

    }

    /* ==========================================
       PROGRESS BAR
    ========================================== */

    function updateProgress(){

        let percent =
            ((currentQuestion + 1) / questions.length) * 100;

        progressFill.style.width =
            percent + "%";

    }

    showQuestion(currentQuestion);

        /* ==========================================
       NEXT BUTTON
    ========================================== */

    nextBtn.addEventListener("click", function(){

        if(currentQuestion < questions.length - 1){

            currentQuestion++;

            showQuestion(currentQuestion);

        }

    });

    /* ==========================================
       PREVIOUS BUTTON
    ========================================== */

    prevBtn.addEventListener("click", function(){

        if(currentQuestion > 0){

            currentQuestion--;

            showQuestion(currentQuestion);

        }

    });

    /* ==========================================
       TIMER
    ========================================== */

    let totalSeconds = EXAM_DURATION * 60;

    function startTimer(){

        const interval = setInterval(function(){

            let minutes = Math.floor(totalSeconds / 60);

            let seconds = totalSeconds % 60;

            timer.innerHTML =
                String(minutes).padStart(2,"0")
                + ":"
                + String(seconds).padStart(2,"0");

            if(totalSeconds <= 0){

                clearInterval(interval);

                alert("Time is over. Your exam will be submitted automatically.");

                form.submit();

            }

            totalSeconds--;

        },1000);

    }

    startTimer();
        /* ==========================================
       SUBMIT BUTTON
    ========================================== */

    form.addEventListener("submit", function () {

        submitBtn.disabled = true;

        submitBtn.innerHTML =
            '<i class="fa-solid fa-spinner fa-spin"></i> Submitting...';

    });

    /* ==========================================
       SAVE ANSWERS
    ========================================== */

    const options =
        document.querySelectorAll('input[type="radio"]');

    options.forEach(function(option){

        option.addEventListener("change", function(){

            localStorage.setItem(

                this.name,

                this.value

            );

        });

        const saved =
            localStorage.getItem(option.name);

        if(saved === option.value){

            option.checked = true;

        }

    });

    /* ==========================================
       CLEAR SAVED ANSWERS AFTER SUBMIT
    ========================================== */

    form.addEventListener("submit", function(){

        options.forEach(function(option){

            localStorage.removeItem(option.name);

        });

    });

    /* ==========================================
       PREVENT PAGE LEAVE
    ========================================== */

    window.addEventListener("beforeunload", function(e){

        e.preventDefault();

        e.returnValue =
        "Your exam is still in progress.";

    });

    /* ==========================================
       REMOVE WARNING AFTER SUBMIT
    ========================================== */

    form.addEventListener("submit", function(){

        window.onbeforeunload = null;

    });

});