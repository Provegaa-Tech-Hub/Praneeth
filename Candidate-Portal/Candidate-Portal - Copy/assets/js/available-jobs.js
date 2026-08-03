// ==========================================
// Available Jobs
// ==========================================

// Search Jobs
const searchBox = document.getElementById("searchJob");

if (searchBox) {

    searchBox.addEventListener("keyup", function () {

        let search = this.value.toLowerCase();

        let cards = document.querySelectorAll(".job-card");

        cards.forEach(function (card) {

            let role = card.querySelector("h2").textContent.toLowerCase();

            let company = card.querySelector(".company p").textContent.toLowerCase();

            if (role.includes(search) || company.includes(search)) {

                card.style.display = "block";

            } else {

                card.style.display = "none";

            }

        });

    });

}



// ==========================================
// Filter Jobs
// ==========================================

let filterButtons = document.querySelectorAll(".filters button");

filterButtons.forEach(function (button) {

    button.addEventListener("click", function () {

        filterButtons.forEach(btn => btn.classList.remove("active"));

        this.classList.add("active");

        let filter = this.textContent.toLowerCase();

        let cards = document.querySelectorAll(".job-card");

        cards.forEach(function (card) {

            let role = card.querySelector("h2").textContent.toLowerCase();

            if (filter === "all") {

                card.style.display = "block";

            }

            else if (role.includes(filter)) {

                card.style.display = "block";

            }

            else {

                card.style.display = "none";

            }

        });

    });

});



// ==========================================
// Apply Job
// ==========================================

let applyButtons = document.querySelectorAll(".apply-btn");

applyButtons.forEach(function (button) {

    button.addEventListener("click", function () {

        let card = this.closest(".job-card");

        let role = card.querySelector("h2").textContent.trim();

        let company = card.querySelector(".company p").textContent.trim();

        let details = card.querySelectorAll(".details p");

        let location = details[0].textContent.replace("📍", "").trim();

        let salary = details[1].textContent.replace("₹", "").trim();

        let experience = details[2].textContent.trim();

        let skills = details[3].textContent.trim();



        let applications = JSON.parse(localStorage.getItem("applications")) || [];



        // Prevent Duplicate Application

        let exists = applications.some(function (job) {

            return job.role === role && job.company === company;

        });

        if (exists) {

            alert("You have already applied for this job.");

            return;

        }



        let application = {

            id: Date.now(),

            role: role,

            company: company,

            location: location,

            salary: salary,

            experience: experience,

            skills: skills,

            status: "Applied",

            appliedDate: new Date().toLocaleDateString()

        };



        applications.push(application);

        localStorage.setItem("applications", JSON.stringify(applications));



        alert("Application Submitted Successfully!");

    });

});



// ==========================================
// View Details
// ==========================================

let detailButtons = document.querySelectorAll(".details-btn");

detailButtons.forEach(function (button) {

    button.addEventListener("click", function () {

        let card = this.closest(".job-card");

        let role = card.querySelector("h2").textContent;

        let company = card.querySelector(".company p").textContent;

        let details = card.querySelectorAll(".details p");



        alert(

            "Job Role : " + role +

            "\n\nCompany : " + company +

            "\n\n" + details[0].textContent +

            "\n" + details[1].textContent +

            "\n" + details[2].textContent +

            "\n" + details[3].textContent

        );

    });

});



// ==========================================
// Console
// ==========================================

console.log("Available Jobs Loaded Successfully");