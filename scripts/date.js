const arrivalDate = document.querySelector('#arrivalDate');
const departureDate = document.querySelector('#departureDate');

// Prevent departureDate to be before arrivalDate by updating min value
arrivalDate.addEventListener('change', (e) => {
    departureDate.min = e.target.value;
});
