// ===============================
// Graduation Form Validation
// ===============================


document
.getElementById("graduationForm")
.addEventListener("submit", function(e){


e.preventDefault();




// Degree Selection

let degree =
document.querySelector(
'input[name="degree"]:checked'
);



if(!degree){


alert(
"Please select your graduation degree"
);


return;


}




let selectedDegree =
degree.value;






// Course / Branch Selection


let branch =
document.querySelector(
'input[name="branch"]:checked'
);




if(!branch){


alert(
"Please select your course / branch"
);


return;


}




let selectedBranch =
branch.value;








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



let percentage =
inputs[3].value;







if(

college==="" ||
university==="" ||
year==="" ||
percentage===""

){


alert(
"Please fill all graduation details"
);


return;


}









// Save Data



localStorage.setItem(
"educationLevel",
"Graduation"
);



localStorage.setItem(
"degree",
selectedDegree
);



localStorage.setItem(
"courseBranch",
selectedBranch
);



localStorage.setItem(
"graduationCollege",
college
);



localStorage.setItem(
"university",
university
);



localStorage.setItem(
"graduationYear",
year
);



localStorage.setItem(
"graduationPercentage",
percentage
);








alert(
"Graduation details saved successfully"
);






// Next Page


window.location.href =
"after-graduation.html";



});