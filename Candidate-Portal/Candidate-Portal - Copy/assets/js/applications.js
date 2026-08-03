// =====================================
// My Applications
// Part 1
// =====================================


// Load Page

window.onload = function(){

    loadApplications();

};




// =====================================
// Load Applications
// =====================================

function loadApplications(){


    let applications =

    JSON.parse(

    localStorage.getItem("applications")

    ) || [];



    calculateStatistics(applications);



    displayApplications(applications);

}






// =====================================
// Statistics
// =====================================

function calculateStatistics(applications){



    let total = applications.length;



    let applied =

    applications.filter(function(job){

        return job.status === "Applied";

    }).length;



    let review =

    applications.filter(function(job){

        return job.status === "Review";

    }).length;



    let interview =

    applications.filter(function(job){

        return job.status === "Interview";

    }).length;



    let selected =

    applications.filter(function(job){

        return job.status === "Selected";

    }).length;



    let rejected =

    applications.filter(function(job){

        return job.status === "Rejected";

    }).length;





    document.getElementById(

    "totalApplications"

    ).innerHTML = total;



    document.getElementById(

    "appliedApplications"

    ).innerHTML = applied;



    document.getElementById(

    "reviewApplications"

    ).innerHTML = review;



    document.getElementById(

    "interviewApplications"

    ).innerHTML = interview;



    document.getElementById(

    "selectedApplications"

    ).innerHTML = selected;



    document.getElementById(

    "rejectedApplications"

    ).innerHTML = rejected;

}






// =====================================
// Display Applications
// =====================================

function displayApplications(applications){



    let container =

    document.getElementById(

    "applicationsContainer"

    );



    container.innerHTML = "";





    if(applications.length===0){



        container.innerHTML =

        `

        <div class="empty-box">

            <i class="fa-solid fa-folder-open"></i>

            <h2>No Applications Found</h2>

            <p>

            You haven't applied for any jobs yet.

            </p>

        </div>

        `;



        return;

    }






    applications.forEach(function(job){



        let card =

        `

<div class="application-card">



<div class="card-top">

<div>

<h2>${job.role}</h2>

<p>${job.company}</p>

</div>

<span class="status ${job.status.toLowerCase()}">

${job.status}

</span>

</div>



<div class="job-details">

<p>

<strong>Location :</strong>

${job.location}

</p>



<p>

<strong>Salary :</strong>

${job.salary}

</p>



<p>

<strong>Experience :</strong>

${job.experience}

</p>



<p>

<strong>Skills :</strong>

${job.skills}

</p>



<p>

<strong>Applied Date :</strong>

${job.appliedDate}

</p>

</div>



<div class="buttons">

<button
class="view-btn"
data-id="${job.id}">

View Details

</button>



<button
class="print-btn"
onclick="printApplication()">

Print

</button>

</div>



</div>

        `;



        container.innerHTML += card;



    });

}






// =====================================
// Print
// =====================================

function printApplication(){

    window.print();

}



console.log("Applications Loaded");
// =====================================
// Search Applications
// =====================================

const searchInput = document.getElementById("searchJob");

if(searchInput){

    searchInput.addEventListener("keyup", function(){

        let searchText = this.value.toLowerCase();

        let applications =
        JSON.parse(localStorage.getItem("applications")) || [];

        let filteredApplications =
        applications.filter(function(job){

            return (

                job.role.toLowerCase().includes(searchText) ||

                job.company.toLowerCase().includes(searchText) ||

                job.location.toLowerCase().includes(searchText)

            );

        });

        displayApplications(filteredApplications);

    });

}



// =====================================
// Filter Applications
// =====================================

let filterButtons =
document.querySelectorAll(".filters button");

filterButtons.forEach(function(button){

    button.addEventListener("click", function(){

        filterButtons.forEach(function(btn){

            btn.classList.remove("active");

        });

        this.classList.add("active");

        let filter =
        this.innerText;

        let applications =
        JSON.parse(localStorage.getItem("applications")) || [];

        if(filter=="All"){

            displayApplications(applications);

            return;

        }

        let filteredApplications =
        applications.filter(function(job){

            return job.status===filter;

        });

        displayApplications(filteredApplications);

    });

});



// =====================================
// View Details
// =====================================

document.addEventListener("click", function(e){

    if(e.target.classList.contains("view-btn")){

        let id =
        Number(e.target.dataset.id);

        let applications =
        JSON.parse(localStorage.getItem("applications")) || [];

        let job =
        applications.find(function(item){

            return item.id===id;

        });

        if(!job){

            return;

        }

        alert(

            "Job Role : " + job.role +

            "\n\nCompany : " + job.company +

            "\n\nLocation : " + job.location +

            "\n\nSalary : " + job.salary +

            "\n\nExperience : " + job.experience +

            "\n\nSkills : " + job.skills +

            "\n\nApplied Date : " + job.appliedDate +

            "\n\nStatus : " + job.status

        );

    }

});



// =====================================
// Withdraw Application
// =====================================

function withdrawApplication(id){

    if(!confirm("Do you want to withdraw this application?")){

        return;

    }

    let applications =
    JSON.parse(localStorage.getItem("applications")) || [];

    applications =
    applications.filter(function(job){

        return job.id!=id;

    });

    localStorage.setItem(

        "applications",

        JSON.stringify(applications)

    );

    loadApplications();

}

// =====================================
// Print Application
// =====================================

function printApplication(){

    window.print();

}



// =====================================
// Download Application
// =====================================

function downloadApplication(){

    window.print();

}



// =====================================
// Refresh Dashboard Statistics
// =====================================

function refreshApplications(){

    loadApplications();

}



// =====================================
// Status Badge Colors
// =====================================

function updateStatusColors(){

    let statusBadges =
    document.querySelectorAll(".status");

    statusBadges.forEach(function(badge){

        let status =
        badge.innerHTML;

        badge.classList.remove(

            "applied",
            "review",
            "interview",
            "selected",
            "rejected"

        );

        if(status=="Applied"){

            badge.classList.add("applied");

        }

        else if(status=="Review"){

            badge.classList.add("review");

        }

        else if(status=="Interview"){

            badge.classList.add("interview");

        }

        else if(status=="Selected"){

            badge.classList.add("selected");

        }

        else if(status=="Rejected"){

            badge.classList.add("rejected");

        }

    });

}



// =====================================
// Auto Refresh
// =====================================

window.addEventListener("load",function(){

    updateStatusColors();

});



// =====================================
// Empty Message
// =====================================

function checkEmptyApplications(){

    let applications =
    JSON.parse(localStorage.getItem("applications")) || [];

    if(applications.length==0){

        document.getElementById("applicationsContainer").innerHTML=

        `

        <div class="empty-box">

        <i class="fa-solid fa-folder-open"></i>

        <h2>No Applications Yet</h2>

        <p>

        Apply for jobs from the Available Jobs page.

        </p>

        </div>

        `;

    }

}



// =====================================
// Initialize
// =====================================

window.onload=function(){

    loadApplications();

    updateStatusColors();

    checkEmptyApplications();

};



// =====================================
// Console
// =====================================

console.log("Career Portal Applications Loaded Successfully");