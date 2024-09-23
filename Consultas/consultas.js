document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.card');
    const animalSelect = document.getElementById('animal');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const animalType = card.getAttribute('data-animal');
            animalSelect.value = animalType;
        });
    });
});
