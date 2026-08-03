// ==========================================
// CareerForge Dashboard
// dashboard.js
// ==========================================

document.addEventListener("DOMContentLoaded", () => {

    greeting();

    liveDate();

    liveTime();

   

    progressCircle();

    counterAnimation();

    cardAnimation();

    notificationAnimation();

recentActivityAnimation();


});

// ==========================================
// GOOD MORNING / AFTERNOON / EVENING
// ==========================================

function greeting() {

    const greetingText = document.getElementById("greeting");

    if (!greetingText) return;

    const hour = new Date().getHours();

    let text = "";

    if (hour < 12) {

        text = "🌅 Good Morning";

    } else if (hour < 17) {

        text = "☀️ Good Afternoon";

    } else if (hour < 21) {

        text = "🌇 Good Evening";

    } else {

        text = "🌙 Good Night";

    }

    greetingText.innerHTML = text;

}

// ==========================================
// LIVE DATE
// ==========================================

function liveDate() {

    const date = document.getElementById("currentDate");

    if (!date) return;

    const today = new Date();

    date.innerHTML = today.toLocaleDateString("en-IN", {

        weekday: "long",

        day: "numeric",

        month: "long",

        year: "numeric"

    });

}

// ==========================================
// LIVE TIME
// ==========================================

function liveTime() {

    const time = document.getElementById("currentTime");

    if (!time) return;

    function updateClock() {

        const now = new Date();

        time.innerHTML = now.toLocaleTimeString("en-IN", {

            hour: "2-digit",

            minute: "2-digit",

            second: "2-digit"

        });

    }

    updateClock();

    setInterval(updateClock, 1000);

}
// ==========================================
// PROFILE COMPLETION
// DATABASE VALUE DISPLAY
// ==========================================

function profileCompletion() {


    const progress = document.getElementById("profileCompletion");

    const progressValue = document.getElementById("progressValue");


    if(progress && progress.dataset.value){

        progress.innerHTML = progress.dataset.value + "%";

    }


    if(progressValue && progressValue.dataset.value){

        progressValue.innerHTML = progressValue.dataset.value + "%";

    }


}
// ==========================================
// PROGRESS CIRCLE
// ==========================================

function progressCircle() {

    const circle = document.querySelector(".outer");

    const value = document.getElementById("progressValue");

    if (!circle || !value) return;

    let progress = parseInt(value.innerText) || 0;

    let current = 0;

    const timer = setInterval(() => {

        if (current >= progress) {

            clearInterval(timer);

        } else {

            current++;

            value.innerHTML = current + "%";

            circle.style.background =
                `conic-gradient(#2563EB ${current * 3.6}deg,#E2E8F0 0deg)`;

        }

    }, 15);

}

// ==========================================
// COUNTER ANIMATION
// ==========================================

function counterAnimation() {

    const counters = document.querySelectorAll(

        ".stat-content h3,.card-details h2"

    );

    counters.forEach(counter => {

        let text = counter.innerText;

        let target = parseInt(text);

        if (isNaN(target)) return;

        let current = 0;

        let speed = Math.max(1, Math.ceil(target / 50));

        const timer = setInterval(() => {

            current += speed;

            if (current >= target) {

                current = target;

                clearInterval(timer);

            }

            counter.innerHTML = current;

        }, 20);

    });

}

// ==========================================
// CARD HOVER EFFECT
// ==========================================

function cardAnimation() {

    const cards = document.querySelectorAll(

        ".dashboard-card,.action-card,.stat-box,.performance-card,.badge-card"

    );

    cards.forEach(card => {

        card.addEventListener("mouseenter", () => {

            card.style.transform = "translateY(-8px)";

        });

        card.addEventListener("mouseleave", () => {

            card.style.transform = "translateY(0px)";

        });

    });

}

// ==========================================
// NOTIFICATION EFFECT
// ==========================================

function notificationAnimation() {

    const notifications = document.querySelectorAll(

        ".notification-item"

    );

    notifications.forEach((item, index) => {

        item.style.opacity = "0";

        item.style.transform = "translateX(40px)";

        setTimeout(() => {

            item.style.transition = ".5s";

            item.style.opacity = "1";

            item.style.transform = "translateX(0px)";

        }, index * 250);

    });

}

// ==========================================
// RECENT ACTIVITY
// ==========================================

function recentActivityAnimation() {

    const activities = document.querySelectorAll(

        ".activity-item"

    );

    activities.forEach((item, index) => {

        item.style.opacity = "0";

        item.style.transform = "translateY(20px)";

        setTimeout(() => {

            item.style.transition = ".4s";

            item.style.opacity = "1";

            item.style.transform = "translateY(0px)";

        }, index * 180);

    });

}

// ==========================================
// SCROLL REVEAL ANIMATION
// ==========================================

function revealOnScroll() {

    const elements = document.querySelectorAll(

        ".dashboard-card,.summary-card,.action-card,.stat-box,.performance-card,.notification-item,.badge-card,.activity-item,.recent-jobs,.progress-card"

    );

    const windowHeight = window.innerHeight;

    elements.forEach(element => {

        const top = element.getBoundingClientRect().top;

        if (top < windowHeight - 80) {

            element.style.opacity = "1";

            element.style.transform = "translateY(0px)";

        }

    });

}

window.addEventListener("scroll", revealOnScroll);

window.addEventListener("load", revealOnScroll);

// ==========================================
// SIDEBAR ACTIVE MENU
// ==========================================

const sidebarItems = document.querySelectorAll(".sidebar ul li");

sidebarItems.forEach(item => {

    item.addEventListener("click", function () {

        sidebarItems.forEach(i => i.classList.remove("active"));

        this.classList.add("active");

    });

});

// ==========================================
// SMOOTH SCROLL
// ==========================================

document.querySelectorAll('a[href^="#"]').forEach(anchor => {

    anchor.addEventListener("click", function (e) {

        e.preventDefault();

        const target = document.querySelector(this.getAttribute("href"));

        if (target) {

            target.scrollIntoView({

                behavior: "smooth"

            });

        }

    });

});

// ==========================================
// SEARCH FILTER
// ==========================================

const searchInput = document.getElementById("dashboardSearch");

if (searchInput) {

    searchInput.addEventListener("keyup", function () {

        const value = this.value.toLowerCase();

        document.querySelectorAll(".action-card").forEach(card => {

            card.style.display =

                card.innerText.toLowerCase().includes(value)

                ? "block"

                : "none";

        });

    });

}

// ==========================================
// PRINT PROFILE
// ==========================================

const printBtn = document.getElementById("printProfile");

if (printBtn) {

    printBtn.addEventListener("click", () => {

        window.print();

    });

}

// ==========================================
// DOWNLOAD RESUME
// ==========================================

const downloadBtn = document.getElementById("downloadResume");

if (downloadBtn) {

    downloadBtn.addEventListener("click", () => {

        alert("Resume download started...");

    });

}

// ==========================================
// DASHBOARD LOADER
// ==========================================

window.addEventListener("load", () => {

    document.body.classList.add("loaded");

});

// ==========================================
// AUTO REFRESH TIME
// ==========================================

setInterval(() => {

    liveTime();

}, 1000);

// ==========================================
// WELCOME CONSOLE
// ==========================================

console.log("%cCareerForge Dashboard Loaded Successfully",

"color:#2563EB;font-size:18px;font-weight:bold;");


// ==========================================
// PROFILE IMAGE UPLOAD
// ==========================================

function profileImageUpload(){


    const imageInput = document.getElementById("dashboardPhoto");


    if(!imageInput) return;



    imageInput.addEventListener("change", function(){


        const form = this.closest("form");


        if(form){

            form.submit();

        }


    });


}

// ==========================================
// END OF FILE
// ==========================================