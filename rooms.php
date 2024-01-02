<?php

declare(strict_types=1);

require __DIR__ . '/roomFunctions.php';


$checkIn = $_POST['arrivalDate'];
$checkOut = $_POST['departureDate'];

$allRooms = getRooms();
$availableRooms = availableRooms($checkIn, $checkOut);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Belmond Cockapoo Palace</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <main>
        <section class="section-container">
            <form method="post" action="/booking.php">
                <div class="room-container">
                    <div class="room-container-inner">


                        <?php

                        // Present available rooms
                        foreach ($allRooms as $room) :
                            $isAvailable = isRoomAvailable($room['id'], $availableRooms);

                        ?>
                            <label class="room-check">
                                <input type="radio" name="room" value="<?= $room['id'] ?>" required hidden <?= $isAvailable ? '' : 'disabled' ?>>
                                <div class="room-card <?= $isAvailable ? '' : 'booked' ?>">

                                    <img src="<?= $room['imageUrl'] ?>" alt="a hotelroom">
                                    <h3><?= $room['name'] ?></h3>

                                </div>

                            </label>
                        <?php endforeach; ?>
                    </div>
                    <div class="room-info">
                        <h2>chosen room</h2>
                        <p>Our most spacious room for 2-4 guests. Bedroom with one king-size bed. Separate sitting area with sofa-bed suitable for 2 children. Bathroom with shower, some rooms with bathtub.</p>
                        <p>Includes</p>
                        <p>Breakfast</p>
                        <p>Access to private beach</p>
                        <div>
                            <h2>Enhance your stay</h2>
                            <p>Paw-decure</p>
                            <p>Bring human</p>
                        </div>
                        <h3>Total cost: </h3>
                    </div>
                    <div class="booking-details">
                        <label for="arrivalDate">Arrival date</label>
                        <input id="arrivalDate" value="<?= $checkIn ?>" type="date" min="2024-01-01" max="2024-01-31" name="arrivalDate" readonly />
                        <label for="departureDate">Departure date</label>
                        <input id="departureDate" value="<?= $checkOut ?>" type="date" min="2024-01-01" max="2024-01-31" name="departureDate" readonly />

                        <input type="text" placeholder="First name" name="firstName" required />
                        <input type="text" placeholder="Last name" name="lastName" required />
                        <input type="text" placeholder="transfer code" name="transferCode" required />
                        <button class="button" type="submit">Book your stay</button>
                    </div>
                </div>

            </form>
        </section>
    </main>
</body>

</html>