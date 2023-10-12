// Get the modal
const modal = document.getElementById('myModal');

// Get the button that opens the modal
const openModal = document.getElementsByClassName("open-modale")[0];
console.log (openModale)

// Get the <span> element that closes the modal
const span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
openModal.addEventListener ("click", function() {

    modal.style.display = "block";
    console.log ("OK")
})
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}



