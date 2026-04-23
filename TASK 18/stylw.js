// 1. Phone Cleaning
function cleanPhone() {
    let phone = document.getElementById("phone").value;
    let cleaned = phone.replace(/\D/g, '');
    document.getElementById("phoneResult").innerText = cleaned;
}

// 2. Password Strength
function checkPassword() {
    let pass = document.getElementById("password").value;
    let strength = "Weak";

    if (pass.length >= 8 &&
        /[A-Z]/.test(pass) &&
        /[0-9]/.test(pass) &&
        /[!@#$%^&*]/.test(pass)) {
        strength = "Strong";
    } else if (pass.length >= 6) {
        strength = "Medium";
    }

    document.getElementById("passResult").innerText = strength;
}

// 3. Highlight Keyword
function highlightText() {
    let text = document.getElementById("text").value;
    let keyword = document.getElementById("keyword").value;

    if (!keyword) return;

    let regex = new RegExp(`(${keyword})`, "gi");
    let result = text.replace(regex, "<span class='highlight'>$1</span>");

    document.getElementById("highlightResult").innerHTML = result;
}

// 4. Clock
function updateClock() {
    let now = new Date();
    document.getElementById("clock").innerText = now.toLocaleTimeString();
}
setInterval(updateClock, 1000);

// 5. Date Formatting
function formatDate() {
    let input = document.getElementById("dateInput").value;
    if (!input) return;

    let date = new Date(input);
    document.getElementById("dateResult").innerText = date.toDateString();
}