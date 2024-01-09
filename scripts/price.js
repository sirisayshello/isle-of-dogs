const inputRooms = document.querySelectorAll('.room-input');
const inputFeatures = document.querySelectorAll('.feature-input');
const priceContainer = document.querySelector('.total-price');
let roomPrice = 0;
let featurePrice = 0;
let roomName = 'No room chosen';
let featureName = '';

const updatePrice = () => {
    priceContainer.textContent = roomPrice + featurePrice;
};

const chosenRoom = document.querySelector('.room-name');
const chosenFeature = document.querySelector('.feature-name');

const updateRoomName = () => {
    chosenRoom.textContent = roomName;
};

inputRooms.forEach((inputRoom) => {
    inputRoom.addEventListener('change', (e) => {
        roomPrice = parseInt(inputRoom.dataset.price);
        updatePrice();
    });

    inputRoom.addEventListener('change', (e) => {
        roomName = inputRoom.dataset.name;
        updateRoomName();
    });
});

inputFeatures.forEach((inputFeature) => {
    inputFeature.addEventListener('change', (e) => {
        if (e.target.checked) {
            featurePrice += parseInt(inputFeature.dataset.price);
        } else {
            featurePrice -= parseInt(inputFeature.dataset.price);
        }
        updatePrice();
    });

    inputFeature.addEventListener('change', (e) => {
        // if there is a space in the id, we need to replace it with a '-'
        const elementId = inputFeature.id.replace(' ', '-') + '-price-info';

        if (e.target.checked) {
            const featureElement = document.createElement('p');
            featureElement.id = elementId;
            const textnode = document.createTextNode(inputFeature.dataset.name);
            featureElement.appendChild(textnode);
            chosenFeature.appendChild(featureElement);
        } else {
            const featureElement = document.querySelector('#' + elementId);
            chosenFeature.removeChild(featureElement);
        }
    });
});
