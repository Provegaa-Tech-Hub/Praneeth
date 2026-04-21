// Task 1: Largest of 3 numbers
function largest() {
    let a = Number(document.getElementById("a").value);
    let b = Number(document.getElementById("b").value);
    let c = Number(document.getElementById("c").value);

    let max = a;
    if (b > max) max = b;
    if (c > max) max = c;

    document.getElementById("res1").innerText = "Largest: " + max;
}

// Task 2: Prime numbers
function primes() {
    let n = Number(document.getElementById("n").value);
    let output = "";

    for (let i = 2; i <= n; i++) {
        let isPrime = true;

        for (let j = 2; j < i; j++) {
            if (i % j === 0) {
                isPrime = false;
                break;
            }
        }

        if (isPrime) output += i + " ";
    }

    document.getElementById("res2").innerText = output;
}

// Task 3: Sum of numbers (1 to N)
function sumNumbers() {
    let n = Number(document.getElementById("num").value);
    let sum = 0;

    for (let i = 1; i <= n; i++) {
        sum += i;
    }

    document.getElementById("res3").innerText = "Sum: " + sum;
}

// Task 4: Right-aligned star pattern
function stars() {
    let rows = Number(document.getElementById("rows").value);
    let pattern = "";

    for (let i = 1; i <= rows; i++) {
        for (let j = 1; j <= rows - i; j++) {
            pattern += " ";
        }
        for (let k = 1; k <= i; k++) {
            pattern += "*";
        }
        pattern += "\n";
    }

    document.getElementById("res4").innerText = pattern;
}

// Task 5: Role Based Access
function checkAccess() {
    let role = document.getElementById("role").value;
    let message = "";

    if (role === "admin") {
        message = "Admin: Full Access";
    } 
    else if (role === "user") {
        message = "User: Limited Access";
    } 
    else if (role === "other") {
        message = "Others: View Only";
    } 
    else {
        message = "Please select a role";
    }

    document.getElementById("res5").innerText = message;
}