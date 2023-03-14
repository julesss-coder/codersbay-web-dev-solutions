let navIcon = document.getElementById("menu-icon");
let nav = document.querySelector("nav");

navIcon.addEventListener('click', function() {
  nav.classList.toggle("responsive");
});

let submitButton = document.querySelector("#submit-btn");
submitButton.addEventListener('mouseover', (event) => {
  if (event.target.nodeName === 'INPUT') {
    submitButton.classList.toggle("reverse");
  }
});