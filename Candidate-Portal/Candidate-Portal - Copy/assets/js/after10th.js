// ==========================
// After 10th Selection Flow
// ==========================


document
.getElementById("educationForm")
.addEventListener("submit", function(e){


    e.preventDefault();



    let selectedOption = document.querySelector(
        'input[name="education"]:checked'
    );



    if(!selectedOption){


        alert(
            "Please select your education path after 10th"
        );


        return;


    }



    let choice = selectedOption.value;



    if(choice === "intermediate"){


        window.location.href =
        "intermediate.html";


    }



    else if(choice === "diploma"){


        window.location.href =
        "diploma.html";


    }



    else if(choice === "iti"){


        window.location.href =
        "iti.html";


    }



});