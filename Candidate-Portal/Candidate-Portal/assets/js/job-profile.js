// =====================================
// Show / Hide Experience Details
// =====================================

const experienceOptions =
document.querySelectorAll('input[name="experience"]');

const experienceBox =
document.getElementById("experienceDetails");

experienceOptions.forEach(function(option){

    option.addEventListener("change", function(){

        if(this.value==="Experienced"){

            experienceBox.style.display="block";

        }

        else{

            experienceBox.style.display="none";

        }

    });

});



// =====================================
// Save Job Profile
// =====================================

document.getElementById("jobForm").addEventListener("submit",function(e){

    e.preventDefault();



    let experience =
    document.querySelector('input[name="experience"]:checked');

    if(!experience){

        alert("Please select Experience.");

        return;

    }



    let jobRole =
    document.getElementById("jobRole").value.trim();

    let skills =
    document.getElementById("skills").value.trim();

    let location =
    document.getElementById("location").value.trim();

    let salary =
    document.getElementById("salary").value.trim();



    if(jobRole=="" || skills=="" || location=="" || salary==""){

        alert("Please fill all job profile details.");

        return;

    }



    // Save Basic Details

    localStorage.setItem("experience",experience.value);

    localStorage.setItem("careerChoice",jobRole);

    localStorage.setItem("skills",skills);

    localStorage.setItem("preferredLocation",location);

    localStorage.setItem("expectedSalary",salary);



    // Save Experienced Details

    if(experience.value==="Experienced"){

        localStorage.setItem(

            "currentCompany",

            document.getElementById("currentCompany").value

        );



        localStorage.setItem(

            "previousCompany",

            document.getElementById("previousCompany").value

        );



        localStorage.setItem(

            "experienceYears",

            document.getElementById("experienceYears").value

        );



        localStorage.setItem(

            "currentCTC",

            document.getElementById("currentCTC").value

        );



        localStorage.setItem(

            "expectedCTC",

            document.getElementById("expectedCTC").value

        );



        localStorage.setItem(

            "noticePeriod",

            document.getElementById("noticePeriod").value

        );

    }



    alert("Job Profile Saved Successfully!");



    // Redirect

    window.location.href="review.html";

});