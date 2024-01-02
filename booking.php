<?php

declare(strict_types=1);

require __DIR__ . '/roomFunctions.php';

$arrivalDate = $_POST['arrivalDate'];
$departureDate = $_POST['departureDate'];
$roomId = $_POST['room'];
$transferCode = $_POST['transferCode'];


// var_dump($_POST);

// var_dump($transferCode);

// Check available dates
$availableRooms = availableRooms($arrivalDate, $departureDate);
$isAvailable = isRoomAvailable($roomId, $availableRooms);


if (!$isAvailable) {
    echo 'Room is not available';
}



// Check if a transferCode is valid and unused
$validateTransferCode = isValidUuid($transferCode);
if (!$validateTransferCode) {
    echo 'Not a valid transferCode';
}


// header("Location: /confirmation.php");
