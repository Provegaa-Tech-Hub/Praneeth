// ==========================================
// Applications Page
// ==========================================

window.onload = function(){

    loadApplication();

};


// ==========================================
// Load Application
// ==========================================

function loadApplication(){

    let jobRole =
    localStorage.getItem("jobRole") ||
    "Software Developer";

    let location =
    localStorage.getItem("preferredLocation") ||
    "Hyderabad";

    let salary =
    localStorage.getItem("expectedSalary") ||
    "5 LPA";

    let status =
    localStorage.getItem("applicationStatus") ||
    "Applied";

    let company =
    localStorage.getItem("companyName") ||
    "Career Portal Pvt Ltd";


    // First Card

    let firstCard =
    document.querySelector(".application-card");

    if(firstCard){

        firstCard.querySelector("h2").innerHTML =
        jobRole;

        firstCard.querySelector(".card-top p").innerHTML =
        company;

        let details =
        firstCard.querySelectorAll(".job-details p");

        details[0].innerHTML =
        "<strong>Location :</strong> " + location;

        details[1].innerHTML =
        "<strong>Salary :</strong> " + salary;

        details[2].innerHTML =
        "<strong>Applied :</strong> " +
        new Date().toLocaleDateString();

        let badge =
        firstCard.querySelector(".status");

        badge.innerHTML = status;

        badge.className =
        "status " + status.toLowerCase();

    }

}



// ==========================================
// Search Jobs
// ==========================================

const searchBox =
document.getElementById("searchJob");

if(searchBox){

searchBox.addEventListener("keyup",function(){

let search =
this.value.toLowerCase();

let cards =
document.querySelectorAll(".application-card");

cards.forEach(function(card){

let title =
card.querySelector("h2").innerHTML.toLowerCase();

if(title.indexOf(search)>-1){

card.style.display="block";

}

else{

card.style.display="none";

}

});

});

}



// ==========================================
// Filter Buttons
// ==========================================

let filterButtons =
document.querySelectorAll(".filters button");

filterButtons.forEach(function(button){

button.addEventListener("click",function(){

filterButtons.forEach(function(btn){

btn.classList.remove("active");

});

this.classList.add("active");

let value =
this.innerHTML.toLowerCase();

let cards =
document.querySelectorAll(".application-card");

cards.forEach(function(card){

let status =
card.querySelector(".status")
.innerHTML.toLowerCase();

if(value=="all"){

card.style.display="block";

}

else if(status==value){

card.style.display="block";

}

else{

card.style.display="none";

}

});

});

});



// ==========================================
// View Details
// ==========================================

let viewButtons =
document.querySelectorAll(".view-btn");

viewButtons.forEach(function(button){

button.addEventListener("click",function(){

let card =
this.closest(".application-card");

let role =
card.querySelector("h2").innerHTML;

let company =
card.querySelector(".card-top p").innerHTML;

let status =
card.querySelector(".status").innerHTML;

alert(

"Job Role : " + role +

"\n\nCompany : " + company +

"\n\nStatus : " + status +

"\n\nThank you for applying."

);

});

});



// ==========================================
// Print
// ==========================================

function printApplication(){

window.print();

}



// ==========================================
// Dashboard
// ==========================================

function goDashboard(){

window.location.href="candidate-dashboard.html";

}



// ==========================================
// Console
// ==========================================

console.log("Applications Loaded Successfully");