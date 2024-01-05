<?php

declare(strict_types=1);

require __DIR__ . '/roomFunctions.php';

require 'vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;

$calendar = new Calendar;
$calendar->useMondayStartingDate();

$checkIn = $_POST['arrivalDate'];
$checkOut = $_POST['departureDate'];

$allRooms = getRooms();
$availableRooms = availableRooms($checkIn, $checkOut);

$allFeatures = getFeatures();

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
    <header class="header">
        <div class="title">
            <h1>BELMOND COCKAPOO PALACE</h1>
            <h2>(NOT) A BELMOND HOTEL</h2>
            <H3>ISLE OF DOGS</H3>
        </div>
    </header>
    <main>
        <section class="section-container">
            <form method="post" action="/booking.php">
                <div>
                    <div class="room-container">
                        <div class="room-container-inner">
                            <div class="details-container">
                                <div class="booking-details">
                                    <h3>Guests</h3>
                                    <p>1 dog</p>
                                </div>
                                <div class="booking-details">
                                    <h3>Arrival date</h3>
                                    <p><?= $checkIn ?></p>
                                </div>
                                <div class="booking-details">
                                    <h3>Departure date</h3>
                                    <p><?= $checkOut ?></p>
                                </div>
                            </div>

                            <h1>Select a room</h1>

                            <!-- <div class="booking-date">
                            <label for="arrivalDate">Arrival date</label>
                            <input id="arrivalDate" value="<?= $checkIn ?>" type="date" min="2024-01-01" max="2024-01-31" name="arrivalDate" readonly />
                            <label for="departureDate">Departure date</label>
                            <input id="departureDate" value="<?= $checkOut ?>" type="date" min="2024-01-01" max="2024-01-31" name="departureDate" readonly />
                        </div> -->

                            <?php


                            // Present available rooms
                            foreach ($allRooms as $room) :
                                $isAvailable = isRoomAvailable($room['id'], $availableRooms);

                            ?>
                                <label class="room-check">
                                    <input type="radio" name="room" value="<?= $room['id'] ?>" required hidden <?= $isAvailable ? '' : 'disabled' ?>>
                                    <div class="room-card <?= $isAvailable ? '' : 'booked' ?>">

                                        <img src="<?= $room['imageUrl'] ?>" alt="a hotelroom">
                                        <div>
                                            <h2><?= $room['name'] ?></h2>
                                            <p><?= $room['info'] ?></p>
                                        </div>

                                    </div>

                                </label>
                            <?php endforeach; ?>



                            <h1>Enhance your stay</h1>
                            <div class="feature-container">

                                <fieldset>

                                    <!-- // Present available features -->
                                    <?php foreach ($allFeatures as $feature) : ?>

                                        <label class="feature-check" for="<?= $feature['name'] ?>">
                                            <input type="checkbox" id="<?= $feature['name'] ?>" name="features[]" value="<?= $feature['id'] ?>" hidden />
                                            <div class="feature-card">
                                                <img src="<?= $feature['imgUrl'] ?>" alt="">
                                                <h2><?= $feature['name'] ?></h2>
                                            </div>
                                        </label>
                                    <?php endforeach; ?>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="booking-details">
                        <div class="guestInfo">
                            <input type="text" placeholder="First name" name="firstName" required />
                            <input type="text" placeholder="Last name" name="lastName" required />
                            <input type="text" placeholder="transfer code" name="transferCode" required />
                            <button class="button" type="submit">Book your stay</button>
                        </div>
                    </div>
                </div>

            </form>
        </section>
    </main>
</body>

</html>