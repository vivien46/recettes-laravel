import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    var successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 5000); // Masquer après 5 secondes
    }

    // ================== Gestion des étapes dynamiques ==================
    // Récupérer les éléments HTML nécessaires
    const stepsContainer = document.getElementById('steps-container');
    const addStepButton = document.getElementById('add-step');

    // compteur pour suivre le nombre d'étapes
    let stepCount = 1;

    // Fonction pour ajouter une nouvelle étape
    addStepButton.addEventListener('click', function() {
        // Incrémenter le compteur
        const stepNumber = stepCount++;

        // Créer une div pour l'étape
        const stepDiv = document.createElement('div');
        stepDiv.classList.add('step', 'mb-4', 'p-5', 'bg-blue-100', 'rounded-lg', 'relative');

        // Ajouter une zone de texte pour décrire l'étape et son titre dynamique
        stepDiv.innerHTML = `
            <h4 class="font-bold mb-2">Étape N°${stepNumber}</h4>
            <input type="hidden" name="order[]" value="${stepNumber}">
            <textarea name="steps[]" class="w-full p-2 border border-gray-300 rounded-lg max-w-xl" placeholder="Décrivez l'étape ${stepNumber} de la recette" required></textarea>
            <!-- Bouton pour supprimer l'étape -->
            <button type="button" class="bg-red-500 text-white rounded-md p-1 hover:bg-red-600 absolute top-2 right-2 remove-step" onclick="this.parentElement.remove()">X</button>
            </button>
        `;

        // Ajouter la nouvelle étape au conteneur
        stepsContainer.appendChild(stepDiv);

        // Attacher un événement de suppression à chaque bouton de suppression
        stepDiv.querySelector('.remove-step').addEventListener('click', function() {
            stepDiv.remove();
            renumberSteps();
        });
        });

        // Fonction pour renuméroter les étapes après la suppression
        function renumberSteps() {
            const stepElements = stepsContainer.querySelectorAll('.step');
            stepCount = 1;

            stepElements.forEach(step => {
                const stepHeader = step.querySelector('h4');
                const hiddenInput = step.querySelector('input[name="order[]"]');
                const stepDescription = step.querySelector('textarea[name="steps[]"]');

                stepHeader.textContent = `Étape N°${stepCount}`;
                hiddenInput.value = stepCount;
                stepDescription.placeholder = `Décrivez l'étape ${stepCount} de la recette`;
                stepCount++;
            });
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
                        ingredientCard.classList.add('ingredient-card', 'p-2', 'bg-gray-300', 'rounded', 'mb-2', 'cursor-pointer');

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
        ingredientDiv.classList.add('selected-ingredient', 'p-4', 'bg-green-100', 'rounded', 'mb-2');
        
        // Ajoute le nom de l'ingrédient
        ingredientDiv.innerHTML = `
        <span>${ingredientName}</span>
        <input type="hidden" name="ingredients[]" value="${ingredientId}">
        <input type="text" name="quantities[${ingredientId}]" placeholder="Quantité" class="ml-4 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <select name="unites[${ingredientId}]" class="ml-4 p-2 text-center border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500">
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
        <button type="button" class="ml-2 px-2 button-md bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200" title="Supprimer l'ingrédient" onclick="this.parentElement.remove()">X</button>
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