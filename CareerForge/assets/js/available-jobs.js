// ==========================================
// CareerForge
// Available Jobs JavaScript
// Database Version
// ==========================================


// ================================
// JOB CARD ANIMATION
// ================================

document.addEventListener("DOMContentLoaded",()=>{


    const cards = document.querySelectorAll(".job-card");


    cards.forEach((card,index)=>{


        card.style.opacity="0";


        card.style.transform="translateY(20px)";


        setTimeout(()=>{


            card.style.transition="0.4s";


            card.style.opacity="1";


            card.style.transform="translateY(0)";


        },index*100);



    });


});



// ================================
// CONFIRM APPLY
// ================================


const applyButtons = document.querySelectorAll(".apply-btn");


applyButtons.forEach(button=>{


    button.addEventListener("click",function(e){


        let confirmApply = confirm(
            "Do you want to apply for this job?"
        );


        if(!confirmApply){


            e.preventDefault();


        }


    });


});



// ================================
// SAVE VIEWED JOB
// ================================


const detailButtons = document.querySelectorAll(".details-btn");


detailButtons.forEach(button=>{


    button.addEventListener("click",function(){


        let jobLink=this.getAttribute("href");


        sessionStorage.setItem(
            "lastViewedJob",
            jobLink
        );


    });


});



// ================================
// SEARCH INPUT EFFECT
// ================================


const searchInput=document.querySelector(
    ".search-box input"
);


if(searchInput){


searchInput.addEventListener(
"focus",
()=>{


    searchInput.parentElement.style.boxShadow =
    "0 0 12px rgba(37,99,235,.20)";


});


searchInput.addEventListener(
"blur",
()=>{


    searchInput.parentElement.style.boxShadow =
    "none";


});


}