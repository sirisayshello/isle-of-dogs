<?php

declare(strict_types=1);

require __DIR__ . '/roomFunctions.php';
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/bookingFunctions.php';

if (!isset($_POST['arrivalDate'], $_POST['departureDate'], $_POST['firstName'], $_POST['lastName'], $_POST['room'], $_POST['transferCode'])) {
    echo 'Something went wrong';
    die();
}

// TODO: sanitize and trim the values from the user
$arrivalDate = $_POST['arrivalDate'];
$departureDate = $_POST['departureDate'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$roomId = intval($_POST['room']);
$transferCode = $_POST['transferCode'];
if (isset($_POST['features'])) {
    $featureIds = $_POST['features'];
}




// Check available dates
$availableRooms = availableRooms($arrivalDate, $departureDate);
$isAvailable = isRoomAvailable($roomId, $availableRooms);


if (!$isAvailable) {
    echo 'Room is not available';
    die();
}


// check if correct format
$isValidTransferCode = isValidUuid($transferCode);
if (!$isValidTransferCode) {
    echo 'Not a valid transferCode';
    die();
}

// get total price
$features = getFeaturesByIds($featureIds);
$featuresCost = 0;

foreach ($features as $feature) {
    $featuresCost += $feature['price'];
}

$roomInfo = getRoom($roomId);
$numberOfDays = numberOfDays($arrivalDate, $departureDate);
$roomPrice = $roomInfo['price'];
$totalCost = $numberOfDays * $roomPrice + $featuresCost;

// Check if a transferCode is valid and unused
$isValidPayment = validatePayment($transferCode, $totalCost);

if (!$isValidPayment) {
    echo "Boho, you're poor";
    die();
}



// Insert booking into db
$bookingId = registerBooking($arrivalDate, $departureDate, $firstName, $lastName, $roomId, $totalCost, $transferCode);

foreach ($featureIds as $featureId) {
    registerFeature(intval($featureId), $bookingId);
}


depositTransfercode($transferCode);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Belmond Cockapoo Palace</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>

<header class="header">
    <div class="title">
        <h1>BELMOND COCKAPOO PALACE</h1>
        <h2>(NOT) A BELMOND HOTEL</h2>
        <H3>ISLE OF DOGS</H3>
    </div>
</header>

<body>
    <section class="booking-response">
        <div class="response-container">

            <?php

            // create a booking response in json
            $bookingResponse = [
                'island' => 'Isle of dogs',
                'hotel' => 'Belmond Cockapoo Palace',
                'arrival_date' => $arrivalDate,
                'departure_date' => $departureDate,
                'total_cost' => $totalCost,
                'stars' => '3',
                'features' => $features,
                'additional_info' => [
                    'greeting' => 'Thank you for chosing Belmond Cockapoo Palace'
                ]
            ];

            $bookingResponseJson = json_encode($bookingResponse);
            echo $bookingResponseJson;

            ?>
        </div>

    </section>
</body>