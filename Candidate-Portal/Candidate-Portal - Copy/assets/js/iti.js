// ==========================
// ITI Form Validation
// ==========================


document
.getElementById("itiForm")
.addEventListener("submit", function(e){


    e.preventDefault();



    let inputs = document.querySelectorAll(
        ".details-card input"
    );



    let institute = inputs[0].value;

    let passoutYear = inputs[1].value;

    let percentage = inputs[2].value;




    let selects = document.querySelectorAll(
        ".details-card select"
    );



    let trade = selects[0].value;

    let duration = selects[1].value;





    if(

        institute === "" ||
        trade === "" ||
        duration === "" ||
        passoutYear === "" ||
        percentage === ""

    ){


        alert(
            "Please fill all ITI details"
        );


        return;


    }





    // Save ITI Data


    localStorage.setItem(
        "educationPath",
        "ITI"
    );



    localStorage.setItem(
        "itiInstitute",
        institute
    );



    localStorage.setItem(
        "itiTrade",
        trade
    );



    localStorage.setItem(
        "itiDuration",
        duration
    );



    localStorage.setItem(
        "itiYear",
        passoutYear
    );



    localStorage.setItem(
        "itiPercentage",
        percentage
    );






    alert(
        "ITI details saved successfully"
    );





    // Move to Graduation

    window.location.href =
    "graduation.html";



});