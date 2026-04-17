// Calculator
function calc(type) {
    let a = parseFloat(document.getElementById("num1").value) || 0;
    let b = parseFloat(document.getElementById("num2").value) || 0;
    let res = 0;

    if (type === 'add') res = a + b;
    else if (type === 'sub') res = a - b;
    else if (type === 'mul') res = a * b;
    else if (type === 'div') {
        if (b === 0) {
            alert("Cannot divide by zero");
            return;
        }
        res = a / b;
    }
    else if (type === 'mod') res = a % b;

    document.getElementById("result").innerText = "Result: " + res;
}

// Add list item
function addItem() {
    let input = document.getElementById("listInput");

    if (input.value.trim() === "") return;

    let li = document.createElement("li");
    li.innerText = input.value;

    document.getElementById("list").appendChild(li);
    input.value = "";
}

// Toggle color
function toggleColor() {
    let box = document.getElementById("box");

    box.style.backgroundColor =
        box.style.backgroundColor === "green" ? "" : "green";
}

// Todo list
function addTodo() {
    let input = document.getElementById("todoInput");

    if (input.value.trim() === "") return;

    let li = document.createElement("li");

    let text = document.createTextNode(input.value);

    let btn = document.createElement("button");
    btn.innerText = "Delete";

    btn.onclick = function () {
        li.remove();
    };

    li.appendChild(text);
    li.appendChild(btn);

    document.getElementById("todoList").appendChild(li);
    input.value = "";
}