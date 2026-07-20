// ===================================
// MBA Form Validation
// ===================================

document
.getElementById("mbaForm")
.addEventListener("submit", function(e){

    e.preventDefault();

    // ==========================
    // MBA Specialization
    // ==========================

    let specialization = document.querySelector(
        'input[name="specialization"]:checked'
    );

    if(!specialization){

        alert("Please select MBA specialization.");

        return;

    }

    // ==========================
    // Input Fields
    // ==========================

    let inputs = document.querySelectorAll(".details-card input");

    let college = inputs[0].value.trim();
    let university = inputs[1].value.trim();
    let year = inputs[2].value.trim();
    let percentage = inputs[3].value.trim();

    if(
        college === "" ||
        university === "" ||
        year === "" ||
        percentage === ""
    ){

        alert("Please fill all MBA details.");

        return;

    }

    // ==========================
    // Save to Local Storage
    // ==========================

    localStorage.setItem("careerChoice","MBA");

    localStorage.setItem(
        "mbaSpecialization",
        specialization.value
    );

    localStorage.setItem(
        "mbaCollege",
        college
    );

    localStorage.setItem(
        "mbaUniversity",
        university
    );

    localStorage.setItem(
        "mbaPassoutYear",
        year
    );

    localStorage.setItem(
        "mbaPercentage",
        percentage
    );

    // ==========================
    // Success
    // ==========================

    alert("MBA details saved successfully.");

    // Go to Review Page

    window.location.href = "review.html";

});