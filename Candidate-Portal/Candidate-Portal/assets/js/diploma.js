// ==========================
// Diploma Form Validation
// ==========================


document
.getElementById("diplomaForm")
.addEventListener("submit", function(e){


    e.preventDefault();



    let inputs = document.querySelectorAll(
        ".details-card input"
    );


    let college = inputs[0].value;

    let passoutYear = inputs[1].value;

    let percentage = inputs[2].value;



    let course = document.querySelector(
        ".details-card select"
    ).value;




    if(
        college === "" ||
        course === "" ||
        passoutYear === "" ||
        percentage === ""
    ){

        alert(
            "Please fill all Diploma details"
        );


        return;

    }




    // Store Diploma Data


    localStorage.setItem(
        "educationPath",
        "Diploma"
    );


    localStorage.setItem(
        "diplomaCollege",
        college
    );


    localStorage.setItem(
        "diplomaCourse",
        course
    );


    localStorage.setItem(
        "diplomaYear",
        passoutYear
    );


    localStorage.setItem(
        "diplomaPercentage",
        percentage
    );





    alert(
        "Diploma details saved successfully"
    );




    // Go to Graduation

    window.location.href =
    "graduation.html";



});