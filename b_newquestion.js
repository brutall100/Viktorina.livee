//  Funkcija didinanti Klausimas: area
const resizable = document.querySelector(".question-resizable")
resizable.addEventListener("input", function () {
  this.style.height = "auto"
  if (this.scrollHeight < 235) {
    this.style.height = this.scrollHeight + "px"
  } else {
    this.style.height = "235px"
  }
})



// Info zenkliuko JS
function showInfoText() {
  document.getElementById("info-text").style.display = "block";
}

function hideInfoText() {
  document.getElementById("info-text").style.display = "none";
}


