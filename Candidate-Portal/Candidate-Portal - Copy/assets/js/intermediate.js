// ==========================
// Intermediate Form Validation
// ==========================


document
.getElementById("interForm")
.addEventListener("submit", function(e){


    e.preventDefault();



    // Get Selected Stream

    let selectedStream = document.querySelector(
        'input[name="stream"]:checked'
    );



    if(!selectedStream){


        alert(
            "Please select your Intermediate stream"
        );


        return;

    }



    let stream = selectedStream.value;



    // Get Input Values

    let inputs = document.querySelectorAll(
        ".details-card input"
    );



    let college = inputs[0].value;

    let board = inputs[1].value;

    let year = inputs[2].value;

    let percentage = inputs[3].value;



    if(
        college === "" ||
        board === "" ||
        year === "" ||
        percentage === ""
    ){


        alert(
            "Please fill all Intermediate details"
        );


        return;


    }




    // Save Data Temporarily

    localStorage.setItem(
        "interStream",
        stream
    );


    localStorage.setItem(
        "interCollege",
        college
    );


    localStorage.setItem(
        "interBoard",
        board
    );


    localStorage.setItem(
        "interYear",
        year
    );


    localStorage.setItem(
        "interPercentage",
        percentage
    );





    alert(
        "Intermediate details saved successfully"
    );



    // Move to Graduation

    window.location.href =
    "graduation.html";



});