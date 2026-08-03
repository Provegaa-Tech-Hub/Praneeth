// ===============================
// After Graduation Flow
// ===============================


document
.getElementById("careerForm")
.addEventListener("submit", function(e){


e.preventDefault();




// Select Career Option


let career =
document.querySelector(
'input[name="career"]:checked'
);





if(!career){


alert(
"Please select your career option"
);


return;


}




let selectedCareer =
career.value;





// Save Career Choice


localStorage.setItem(
"afterGraduation",
selectedCareer
);






alert(
"Selection saved successfully"
);







// Redirect Based On Choice



if(selectedCareer === "Job"){



window.location.href =
"job-profile.html";



}





else if(selectedCareer === "M.Tech"){



window.location.href =
"mtech.html";



}





else if(selectedCareer === "MBA"){



window.location.href =
"mba.html";



}




});