function showIDForm() {
  document.getElementById("idFormSection").style.display = "block";
}

function generateID(e) {
  e.preventDefault();
  const role = document.getElementById("userRole").value;
  const brgy = document.getElementById("barangay").value;

  document.getElementById("idRole").innerText = "Role: " + role;
  document.getElementById("idBarangay").innerText = "Barangay: " + brgy;

  document.getElementById("idPreview").style.display = "block";
}

function downloadID() {
  const card = document.getElementById("idCardCanvas");
  html2canvas(card).then(canvas => {
    const link = document.createElement("a");
    link.download = "ProyektoK_ID.png";
    link.href = canvas.toDataURL();
    link.click();
  });
}
document.getElementById("userPhoto").addEventListener("change", function (e) {
  const reader = new FileReader();
  reader.onload = function (event) {
    document.getElementById("previewPhoto").src = event.target.result;
  };
  reader.readAsDataURL(e.target.files[0]);
});

function showIDForm() {
  document.getElementById("idFormSection").style.display = "block";
}

