// ======================================
// 10th Details Form
// ======================================

document.getElementById("tenthForm").addEventListener("submit", function(e){

    e.preventDefault();

    let schoolName =
    document.getElementById("schoolName").value.trim();

    let board =
    document.getElementById("board").value;

    let hallTicket =
    document.getElementById("hallTicket").value.trim();

    let schoolLocation =
    document.getElementById("schoolLocation").value.trim();

    let passoutYear =
    document.getElementById("schoolPassoutYear").value.trim();

    let percentage =
    document.getElementById("schoolPercentage").value.trim();



    // Validation

    if(

        schoolName==="" ||

        board==="" ||

        hallTicket==="" ||

        schoolLocation==="" ||

        passoutYear==="" ||

        percentage===""

    ){

        alert("Please fill all 10th details.");

        return;

    }



    // Save to Local Storage

    localStorage.setItem(

        "schoolName",

        schoolName

    );



    localStorage.setItem(

        "schoolBoard",

        board

    );



    localStorage.setItem(

        "hallTicket",

        hallTicket

    );



    localStorage.setItem(

        "schoolLocation",

        schoolLocation

    );



    localStorage.setItem(

        "schoolPassoutYear",

        passoutYear

    );



    localStorage.setItem(

        "schoolPercentage",

        percentage

    );



    alert("10th Details Saved Successfully!");



    // Redirect

    window.location.href="after10th.html";

});



// ======================================
// Console
// ======================================

console.log("10th Details Loaded Successfully");