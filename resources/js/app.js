import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    var successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 5000); // Masquer après 5 secondes
    }

    //variable pour la recherche d'ingrédients
    const searchInput = document.getElementById('search-ingredient');
    const searchResults = document.getElementById('search-results');
    const selectedIngredientsContainer = document.getElementById('selected-ingredients');

    // Événement d'écoute pour la saisie de la recherche d'ingrédients
    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value;

        // Si la recherche est vide, masquer les résultats
        if (searchTerm === '') {
            searchResults.innerHTML = '';
            return;
        }

        // si la recherche n'est pas vide fait une requête AJAX
        if(searchTerm.length > 1){
            // Fait une requête AJAX vers la route Laravel pour obtenir les ingrédients correspondants
            fetch(`/ingredients/search?q=${searchTerm}`)
                .then(response => response.json())
                .then(data => {
                    //vide les résultats de la recherche précédente
                    searchResults.innerHTML = '';

                    // Affiche les nouveaux résultats sous forme de mini-carte
                    data.forEach(ingredient => {
                        const ingredientCard = document.createElement('div');
                        ingredientCard.classList.add('ingredient-card', 'p-2', 'bg-gray-100', 'rounded', 'mb-2', 'cursor-pointer');

                        // Afficher le nom de l'ingrédient
                        ingredientCard.textContent = ingredient.nom;

                        // Ajout d'un événement pour sélectionner l'ingrédient
                        ingredientCard.addEventListener('click', function() {
                            addIngredient(ingredient);
                        });

                        searchResults.appendChild(ingredientCard);
                    });
                })
                .catch(error => console.error('Erreur lors de la recherche des ingrédients:', error));
        } else {
            // si la saisie est inférieure à 2 caractères, vide les résultats
            searchResults.innerHTML = '';
        }
    });

    // Fonction pour ajouter un ingrédient sélectionné à la liste des ingrédients
    function addIngredient(ingredient) {
        const ingredientId = ingredient.id;
        const ingredientName = ingredient.nom;

        // Créer un élément dans la liste des ingrédients sélectionnés
        const ingredientDiv = document.createElement('div');
        ingredientDiv.classList.add('selected-ingredient', 'p-2', 'bg-green-100', 'rounded', 'mb-2');
        
        // Ajoute le nom de l'ingrédient
        ingredientDiv.innerHTML = `
        <span>${ingredientName}</span>
        <input type="hidden" name="ingredients[]" value="${ingredientId}">
        <input type="text" name="quantities[${ingredientId}]" placeholder="Quantité" class="ml-4 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <select name="unites[${ingredientId}]" class="ml-4 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500">
            <option value="g">g</option>
            <option value="kg">kg</option>
            <option value="ml">ml</option>
            <option value="cl">cl</option>
            <option value="l">l</option>
            <option value="cuillère à soupe">cuillère à soupe</option>
            <option value="cuillère à café">cuillère à café</option>
            <option value="unité">unité</option>
            <option value="feuille">feuille</option>
            <option value="tranche">tranche</option>
        </select>
    `;
    
    selectedIngredientsContainer.appendChild(ingredientDiv);

    // vider les résultats de la recherche et de l'intput
    searchResults.innerHTML = '';
    searchInput.value = '';
    }
});

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