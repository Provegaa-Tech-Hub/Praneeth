// ===============================
// M.Tech Form Validation
// ===============================


document
.getElementById("mtechForm")
.addEventListener("submit", function(e){


e.preventDefault();






// Specialization Selection


let specialization =
document.querySelector(
'input[name="specialization"]:checked'
);





if(!specialization){


alert(
"Please select M.Tech specialization"
);


return;


}




let selectedSpecialization =
specialization.value;







// Details


let inputs =
document.querySelectorAll(
".details-card input"
);



let college =
inputs[0].value;



let university =
inputs[1].value;



let year =
inputs[2].value;





let gate =
document.querySelector(
".details-card select"
).value;







if(

college === "" ||
university === "" ||
year === "" ||
gate === ""

){


alert(
"Please fill all M.Tech details"
);


return;


}







// Save Data



localStorage.setItem(
"careerChoice",
"M.Tech"
);



localStorage.setItem(
"mtechSpecialization",
selectedSpecialization
);



localStorage.setItem(
"mtechCollege",
college
);



localStorage.setItem(
"mtechUniversity",
university
);



localStorage.setItem(
"mtechYear",
year
);



localStorage.setItem(
"gateQualified",
gate
);







alert(
"M.Tech details saved successfully"
);







// Next Page


window.location.href = "review.html";



});