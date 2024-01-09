<?php

declare(strict_types=1);

require __DIR__ . '/autoload.php';
require __DIR__ . '/roomFunctions.php';
require __DIR__ . '/calendar.php';

require 'vendor/autoload.php';



$allRooms = getRooms();
// $availableRooms = availableRooms($checkIn, $checkOut);
$allFeatures = getFeatures();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Belmond Cockapoo Palace</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="calendar.css" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
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
    <main>

        <section class="section-container">
            <div class="view-room-container">
                <div class="view-room-container-inner">

                    <h1>Our rooms</h1>

                    <?php
                    // Present all rooms
                    foreach ($allRooms as $room) :

                    ?>
                        <div class="view-room-card">
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
                            <div>
                                <?php drawCalendar($room['id']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

</body>

</html>