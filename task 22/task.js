// ================= LEAD MANAGEMENT =================

// Save Lead
function saveLead(lead) {
    let leads = JSON.parse(localStorage.getItem("leads")) || [];
    leads.push(lead);
    localStorage.setItem("leads", JSON.stringify(leads));
}

// Add Lead
function addLead() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;

    if (name === "" || email === "") return;

    let lead = {
        name: name,
        email: email,
        status: "New"
    };

    saveLead(lead);
    displayLeads();

    document.getElementById("name").value = "";
    document.getElementById("email").value = "";
}

// Display Leads
function displayLeads() {
    let leads = JSON.parse(localStorage.getItem("leads")) || [];
    let search = document.getElementById("search").value.toLowerCase();

    let output = "";

    leads.forEach((lead, index) => {
        if (
            lead.name.toLowerCase().includes(search) ||
            lead.email.toLowerCase().includes(search)
        ) {
            output += `
                <li>
                    ${lead.name} - ${lead.email} 
                    [${lead.status}]
                    <button onclick="updateStatus(${index})">Update</button>
                    <button onclick="deleteLead(${index})">Delete</button>
                </li>
            `;
        }
    });

    document.getElementById("leadList").innerHTML = output;
}

// Update Status
function updateStatus(index) {
    let leads = JSON.parse(localStorage.getItem("leads")) || [];

    if (leads[index].status === "New") {
        leads[index].status = "Contacted";
    } else {
        leads[index].status = "New";
    }

    localStorage.setItem("leads", JSON.stringify(leads));
    displayLeads();
}

// Delete Lead
function deleteLead(index) {
    let leads = JSON.parse(localStorage.getItem("leads")) || [];
    leads.splice(index, 1);
    localStorage.setItem("leads", JSON.stringify(leads));
    displayLeads();
}


// ================= TASK MANAGER =================

// Add Task
function addTask() {
    let taskInput = document.getElementById("taskInput").value;
    if (taskInput === "") return;

    let tasks = JSON.parse(localStorage.getItem("tasks")) || [];

    tasks.push({
        text: taskInput,
        completed: false
    });

    localStorage.setItem("tasks", JSON.stringify(tasks));
    displayTasks();

    document.getElementById("taskInput").value = "";
}

// Display Tasks
function displayTasks(filter = "all") {
    let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
    let output = "";

    tasks.forEach((task, index) => {

        if (
            filter === "all" ||
            (filter === "completed" && task.completed) ||
            (filter === "pending" && !task.completed)
        ) {
            output += `
                <li>
                    <span style="text-decoration:${task.completed ? "line-through" : "none"}">
                        ${task.text}
                    </span>
                    <button onclick="toggleTask(${index})">✔</button>
                    <button onclick="deleteTask(${index})">❌</button>
                </li>
            `;
        }
    });

    document.getElementById("taskList").innerHTML = output;
}

// Toggle Complete
function toggleTask(index) {
    let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
    tasks[index].completed = !tasks[index].completed;
    localStorage.setItem("tasks", JSON.stringify(tasks));
    displayTasks();
}

// Delete Task
function deleteTask(index) {
    let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
    tasks.splice(index, 1);
    localStorage.setItem("tasks", JSON.stringify(tasks));
    displayTasks();
}

// Filter Tasks
function filterTasks(type) {
    displayTasks(type);
}


// ================= LOAD DATA =================
displayLeads();
displayTasks();