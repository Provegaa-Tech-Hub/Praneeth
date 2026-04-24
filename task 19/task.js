// 1. OTP TIMER
let time = 30;
let interval;

function startTimer() {
    document.getElementById("startBtn").disabled = true;

    interval = setInterval(() => {
        if (time > 0) {
            time--;
            document.getElementById("timer").innerText = time;
        } else {
            clearInterval(interval);
            document.getElementById("resendBtn").disabled = false;
        }
    }, 1000);
}

// 2. FORM VALIDATION
document.getElementById("email").addEventListener("keyup", validateForm);
document.getElementById("phone").addEventListener("keyup", validateForm);
document.getElementById("password").addEventListener("keyup", validateForm);

function validateForm() {
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let pass = document.getElementById("password").value;

    document.getElementById("emailErr").innerText =
        /\S+@\S+\.\S+/.test(email) ? "Valid Email" : "Invalid Email";

    document.getElementById("phoneErr").innerText =
        /^[0-9]{10}$/.test(phone) ? "Valid Phone" : "Enter 10 digits";

    document.getElementById("passErr").innerText =
        pass.length >= 6 ? "Valid Password" : "Min 6 characters";
}

// 3. EVENT TRACKER
function trackClick() {
    let time = new Date().toLocaleTimeString();
    document.getElementById("eventResult").innerText = "Clicked at: " + time;
}

document.getElementById("inputBox").addEventListener("input", () => {
    document.getElementById("eventResult").innerText = "Typing...";
});

window.addEventListener("scroll", () => {
    document.getElementById("eventResult").innerText = "Scrolling...";
});

// 4. INVOICE GENERATOR
let count = 1;

function generateInvoice() {
    let name = document.getElementById("custName").value;

    let id = "INV-" + String(count).padStart(5, '0');
    let date = new Date().toLocaleDateString();

    document.getElementById("invoiceResult").innerText =
        "ID: " + id + " | Date: " + date + " | Name: " + name;

    count++;
}