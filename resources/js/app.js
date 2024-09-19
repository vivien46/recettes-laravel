import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    var successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 5000); // Masquer après 5 secondes
    }
})
// Fonction pour basculer l'affichage du dropdown
window.toggleDropdown = function toggleDropdown(dropdownId){
    const dropdown = document.getElementById(dropdownId);
    //fermer tous les dropdowns avant d'ouvrir un nouveau
    document.querySelectorAll('.dropdown-content').forEach(function(content){
        if(content.id !== dropdownId){
            content.classList.add('hidden');
        }
    });
    // basculer l'affichage du dropdown
    dropdown.classList.toggle('hidden');
}

// Fermer le dropdown lorsqu'on clique en dehors
window.onclick = function(event) {
    const dropdowns = document.querySelectorAll('.dropdown-content');
    dropdowns.forEach(dropdown => {
        if (!dropdown.classList.contains('hidden') && !dropdown.contains(event.target) && !event.target.matches('button')) {
            dropdown.classList.add('hidden');
        }
    });
};