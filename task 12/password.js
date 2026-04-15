let passwordInput = document.getElementById("password");
let toggle = document.getElementById("togglePassword");

toggle.addEventListener("change", () => {
  if (toggle.checked) {
    passwordInput.type = "text";   // show password
  } else {
    passwordInput.type = "password"; // hide password
  }
});