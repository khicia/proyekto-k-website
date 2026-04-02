// main.js
function openRegister() {
  window.location.href = "register.php"; // Step 2 will build this
}
// Expand Card Section
function expandCard(btn) {
  const card = btn.closest('.card');
  card.classList.toggle('expanded');
  btn.textContent = card.classList.contains('expanded') ? "See Less" : "See More";
}

// Show Sign Up Modal after 20 seconds
setTimeout(() => {
  showSignupModal();
}, 20000);

// Show Modal if scroll past 500px
let scrolled = false;
window.addEventListener('scroll', () => {
  if (!scrolled && window.scrollY > 500) {
    showSignupModal();
    scrolled = true;
  }
});

function showSignupModal() {
  const modal = document.getElementById("signupModal");
  if (modal) modal.style.display = "flex";
}

function closeSignupModal() {
  const modal = document.getElementById("signupModal");
  if (modal) modal.style.display = "none";
}

