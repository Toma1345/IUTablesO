document.getElementById('searchbar').addEventListener('input', function () {
    const inputValue = this.value;
    document.getElementById('result').textContent = inputValue;
});

function updateSelectedOptions(containerSelector, outputSelector) {
    const checkboxes = document.querySelectorAll(`${containerSelector} input[type="checkbox"]`);
    const outputElement = document.querySelector(outputSelector);

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const checkedNames = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.name);

            outputElement.textContent = checkedNames.length > 0
                ? `Sélection : ${checkedNames.join(', ')}`
                : 'Aucune option sélectionnée.';
        });
    });
}

updateSelectedOptions('.types', '#selected-types');
updateSelectedOptions('.cuisine', '#selected-cuisines');

const toggles = document.querySelectorAll('.toggle-checkbox');
const result = document.getElementById('toggle-result');

function updateToggleResult() {
    const activeToggles = Array.from(toggles)
        .filter(toggle => toggle.checked)
        .map(toggle => toggle.name);

    result.textContent = activeToggles.length > 0
        ? `Toggles activés : ${activeToggles.join(', ')}`
        : 'Aucun toggle activé.';
}

toggles.forEach(toggle => {
    toggle.addEventListener('change', updateToggleResult);
});
