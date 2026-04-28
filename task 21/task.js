/* ===== TASK 1: Shopping Cart ===== */
function calculateTotal() {
    let price1 = 100;
    let price2 = 200;
    let price3 = 300;

    let q1 = document.getElementById("q1").value;
    let q2 = document.getElementById("q2").value;
    let q3 = document.getElementById("q3").value;

    let total = (price1 * q1) + (price2 * q2) + (price3 * q3);

    document.getElementById("totalResult").innerText =
        "Total Price: ₹" + total;
}

/* ===== TASK 2: Remove Duplicates ===== */
function removeDuplicates() {
    let arr = [1, 2, 2, 3, 4, 4, 5];

    let uniqueArr = [...new Set(arr)];

    document.getElementById("duplicateResult").innerText =
        "Unique Array: " + uniqueArr;
}

/* ===== TASK 3: Debounce Search ===== */
function debounce(func, delay) {
    let timer;

    return function() {
        clearTimeout(timer);

        timer = setTimeout(() => {
            func();
        }, delay);
    };
}

function handleSearch() {
    let value = document.getElementById("searchBox").value;

    document.getElementById("searchResult").innerText =
        "Searching for: " + value;
}

// Apply debounce
let debouncedSearch = debounce(handleSearch, 500);

// Wait for DOM to load before adding event
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("searchBox")
        .addEventListener("input", debouncedSearch);
});