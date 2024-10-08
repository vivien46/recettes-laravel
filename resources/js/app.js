import './bootstrap';
import './dashboardCharts';

document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 5000); // Masquer après 5 secondes
    }

    // ================== Gestion des étapes dynamiques ==================
    const stepsContainer = document.getElementById('steps-container');
    const addStepButton = document.getElementById('add-step');

    if (stepsContainer && addStepButton) {
        let stepCount = stepsContainer.querySelectorAll('.step').length + 1;

        // Fonction pour ajouter une nouvelle étape
        function addStep() {
            const stepNumber = stepCount++;

            const stepDiv = document.createElement('div');
            stepDiv.classList.add('step', 'mb-4', 'p-5', 'bg-blue-100', 'rounded-lg', 'relative');

            stepDiv.innerHTML = `
                <h4 class="font-bold mb-2">Étape N°${stepNumber}</h4>
                <input type="hidden" name="order[]" value="${stepNumber}">
                <textarea name="steps[]" class="w-full p-2 border border-gray-300 rounded-lg max-w-xl" placeholder="Décrivez l'étape ${stepNumber} de la recette" required></textarea>
                <button type="button" class="bg-red-500 text-white rounded-md p-1 hover:bg-red-600 absolute top-2 right-2 remove-step">X</button>
            `;

            stepsContainer.appendChild(stepDiv);

            // Attacher un événement de suppression au bouton
            stepDiv.querySelector('.remove-step').addEventListener('click', () => {
                stepDiv.remove();
                renumberSteps();
            });
        }

        // Attacher l'événement au bouton d'ajout d'étape
        addStepButton.addEventListener('click', addStep);

        // Fonction pour renuméroter les étapes après suppression
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
    } 

    // ================== Recherche d'ingrédients dynamiques ==================
    const searchInput = document.getElementById('search-ingredient');
    const searchResults = document.getElementById('search-results');
    const selectedIngredientsContainer = document.getElementById('selected-ingredients');

    if (searchInput && searchResults && selectedIngredientsContainer) {
        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.trim();

            if (searchTerm.length < 2) {
                searchResults.innerHTML = '';
                return;
            }

            // Requête AJAX pour chercher les ingrédients
            fetch(`/ingredients/search?q=${searchTerm}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    data.forEach(ingredient => {
                        const ingredientCard = document.createElement('div');
                        ingredientCard.classList.add('ingredient-card', 'p-2', 'bg-gray-300', 'rounded', 'mb-2', 'cursor-pointer');
                        ingredientCard.textContent = ingredient.nom;

                        ingredientCard.addEventListener('click', () => {
                            addIngredient(ingredient);
                        });

                        searchResults.appendChild(ingredientCard);
                    });
                })
                .catch(error => console.error('Erreur lors de la recherche des ingrédients:', error));
        });

        // Fonction pour ajouter un ingrédient sélectionné à la liste des ingrédients
        function addIngredient(ingredient) {
            const ingredientId = ingredient.id;
            const ingredientName = ingredient.nom;

            const ingredientDiv = document.createElement('div');
            ingredientDiv.classList.add('selected-ingredient', 'p-4', 'bg-green-100', 'rounded', 'mb-2');

            ingredientDiv.innerHTML = `
                <span>${ingredientName}</span>
                <input type="hidden" name="ingredients[]" value="${ingredientId}">
                <input type="text" name="quantites[${ingredientId}]" placeholder="Quantité" class="ml-4 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
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
                <button type="button" class="ml-2 px-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200" title="Supprimer l'ingrédient" onclick="this.parentElement.remove()">X</button>
            `;

            selectedIngredientsContainer.appendChild(ingredientDiv);
            searchResults.innerHTML = '';
            searchInput.value = '';
        }
    } else {
        console.warn("Éléments de recherche d'ingrédients non trouvés dans le DOM.");
    }

    // ================== Gestion du dropdown ==================
    window.toggleDropdown = function(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        if (dropdown) {
            document.querySelectorAll('.dropdown-content').forEach(content => {
                if (content.id !== dropdownId) {
                    content.classList.add('hidden');
                }
            });
            dropdown.classList.toggle('hidden');
        }
    }

    window.onclick = function(event) {
        const dropdowns = document.querySelectorAll('.dropdown-content');
        dropdowns.forEach(dropdown => {
            if (!dropdown.classList.contains('hidden') && !dropdown.contains(event.target) && !event.target.matches('button')) {
                dropdown.classList.add('hidden');
            }
        });
    };
});

// ================== Gestion du menu Administration ==================
document.addEventListener('DOMContentLoaded', function () {
    // Menu principal "Administration"
    const adminMenuButton = document.getElementById('adminMenuButton');
    const adminMenuDropdown = document.getElementById('adminMenuDropdown');
    
    if (adminMenuButton && adminMenuDropdown) {
        adminMenuButton.addEventListener('click', function (e) {
            e.stopPropagation(); // Empêche la propagation pour ne pas fermer immédiatement le menu
            adminMenuDropdown.classList.toggle('hidden');
        });
    }

    // Gérer le clic en dehors pour fermer le menu principal
    window.addEventListener('click', function (e) {
        if (!adminMenuButton.contains(e.target) && !adminMenuDropdown.contains(e.target)) {
            adminMenuDropdown.classList.add('hidden');
        }
    });

    // Gestion des sous-menus dans le menu Administration
    const subMenuToggles = document.querySelectorAll('.subMenuToggle');

    subMenuToggles.forEach(button => {
        const subMenuContent = button.nextElementSibling; // Sélectionne le menu associé
        button.addEventListener('click', function (e) {
            e.stopPropagation(); // Empêche la fermeture immédiate du menu
            subMenuContent.classList.toggle('hidden');
        });
    });

    // Ferme tous les sous-menus quand on clique en dehors
    window.addEventListener('click', function (e) {
        subMenuToggles.forEach(button => {
            const subMenuContent = button.nextElementSibling;
            if (!button.contains(e.target) && !subMenuContent.contains(e.target)) {
                subMenuContent.classList.add('hidden');
            }
        });
    });
});

