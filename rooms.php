<?php

declare(strict_types=1);

require __DIR__ . '/autoload.php';
require __DIR__ . '/roomFunctions.php';
require __DIR__ . '/bookingFunctions.php';

require 'vendor/autoload.php';


$checkIn = $_POST['arrivalDate'];
$checkOut = $_POST['departureDate'];

$allRooms = getRooms();
$availableRooms = availableRooms($checkIn, $checkOut);

$allFeatures = getFeatures();


$numberOfDaysToStay = numberOfDays($checkIn, $checkOut);
$discount = calculateDiscount($numberOfDaysToStay);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Belmond Cockapoo Palace</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="rooms.css" />
</head>

<body>
    <header class="header">
        <a href="index.php">
            <div class="title">
                <h1>BELMOND COCKAPOO PALACE</h1>
                <h3>(NOT) A BELMOND HOTEL</h3>
                <h3>ISLE OF DOGS</h3>
            </div>
        </a>
    </header>
    <section class="menu">
        <div class="menu-bar">
            <a href="viewRooms.php">ROOMS</a>
            <a href="explore.php">EXPLORE</a>
        </div>
    </section>
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

                            <input id="arrivalDate" value="<?= $checkIn ?>" type="date" min="2024-01-01" max="2024-01-31" name="arrivalDate" readonly hidden />
                            <input id="departureDate" value="<?= $checkOut ?>" type="date" min="2024-01-01" max="2024-01-31" name="departureDate" readonly hidden />
                            <?php


                            // Present available rooms
                            foreach ($allRooms as $room) :
                                $isAvailable = isRoomAvailable($room['id'], $availableRooms);

                            ?>
                                <label class="room-check">
                                    <input class="room-input" type="radio" name="room" value="<?= $room['id'] ?>" required hidden <?= $isAvailable ? '' : 'disabled' ?>data-price="<?= $room['price'] ?>" data-name="<?= $room['name'] ?>">
                                    <div class="room-card <?= $isAvailable ? '' : 'booked' ?>">

                                        <img src="<?= $room['imageUrl'] ?>" alt="a hotelroom">
                                        <div class="room-includes">
                                            <p>Non-smoking</p>
                                            <p>Free Wifi</p>
                                            <p>Humans allowed</p>
                                        </div>
                                        <div class="room-info">
                                            <h2><?= $room['name'] ?></h2>
                                            <p><?= $room['info'] ?></p>
                                            <div>
                                                <li>Breakfast included</li>
                                                <li>Private beach access</li>
                                            </div>
                                        </div>
                                        <div class="room-price">
                                            <h2>Price per day: <?= $room['price'] ?></h2>
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
                                            <input class="feature-input" type="checkbox" id="<?= $feature['name'] ?>" name="features[]" value="<?= $feature['id'] ?>" data-price="<?= $feature['price'] ?>" data-name="<?= $feature['name'] ?>" hidden />
                                            <div class=" feature-card">
                                                <img src="<?= $feature['imgUrl'] ?>" alt="">
                                                <div>
                                                    <h2><?= $feature['name'] ?></h2>
                                                    <h2>Price: <?= $feature['price'] ?></h2>
                                                </div>
                                            </div>
                                        </label>
                                    <?php endforeach; ?>
                                </fieldset>

                            </div>
                            <h1>Guest information</h1>
                            <div class="booking-details">
                                <div class="guest-info">
                                    <input type="text" placeholder="First name" name="firstName" required />
                                    <input type="text" placeholder="Last name" name="lastName" required />
                                    <input type="text" placeholder="transfer code" name="transferCode" required />
                                    <button class="button" type="submit">Book your stay</button>
                                </div>
                            </div>
                        </div>


                        <div class="price-container">
                            <h2>Your stay</h2>
                            <div class="price-details">
                                <div class="booking-details">
                                    <h3>Arrival date</h3>
                                    <p><?= $checkIn ?></p>
                                </div>
                                <div class="booking-details">
                                    <h3>Departure date</h3>
                                    <p><?= $checkOut ?></p>
                                </div>
                            </div>
                            <div class="chosen-room">
                                <h3>Room</h3>
                                <p class="room-name">No room chosen</p>
                                <div class="feature-name"></div>

                            </div>
                            <div>
                                <h3>Room discount</h3>
                                <p><?= (1 - $discount) * 100 ?>%</p>
                            </div>
                            <div class="total-price-container">
                                <h2>Total Price:</h2>
                                <h2 class="total-price" data-discount="<?= $discount ?>">0</h2>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </section>
    </main>
    <script src="scripts/price.js"></script>
</body>

</html>