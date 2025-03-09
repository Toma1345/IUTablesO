function showModal() {
    var modal = document.getElementById("successModal");
    modal.style.display = "block";
}

function closeModal() {
    var modal = document.getElementById("successModal");
    modal.style.display = "none";
}

function showErrorModal() {
    var modal = document.getElementById("errorModal");
    modal.style.display = "block";
}

function closeErrorModal() {
    var modal = document.getElementById("errorModal");
    modal.style.display = "none";
}

// Ferme les pop-ups si l'utilisateur clique en dehors
window.onclick = function(event) {
    var successModal = document.getElementById("successModal");
    var errorModal = document.getElementById("errorModal");

    if (event.target == successModal) {
        successModal.style.display = "none";
    }

    if (event.target == errorModal) {
        errorModal.style.display = "none";
    }
}