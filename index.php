<?php

declare(strict_types=1);

require 'vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Belmond Cockapoo Palace</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="rooms.css" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>

<body>
    <header class="header">
        <a href="index.php">
            <div class="title">
                <div>
                    <img src="svg/star.svg" alt="">
                    <img src="svg/star.svg" alt="">
                    <img src="svg/star.svg" alt="">
                    <img src="svg/star.svg" alt="">
                </div>
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
        <section class="intro">
            <section class="intro-booking-container">
                <div>
                    <h2>BOOK A ROOM</h2>
                </div>

                <form class="booking-form" method="post" action="rooms.php">
                    <div class="booking-details">
                        <label for="arrivalDate">
                            <h3>Arrival date</h3>
                        </label>
                        <input id="arrivalDate" type="date" min="2024-01-01" max="2024-01-31" name="arrivalDate" required />
                        <label for="departureDate">
                            <h3>Departure date</h3>
                        </label>
                        <input id="departureDate" type="date" min="2024-01-01" max="2024-01-31" name="departureDate" required />
                    </div>
                    <p class="savings">Stay a little longer, save a lot more!</p>
                    <p class="savings">Enjoy <b>10%</b> off your 2nd night and up to <b>50%</b> off for stays of six nights or more.</p>
                    <div class="booking-button">
                        <button class="button" type="submit">Check availabilty</button>
                    </div>
                </form>

            </section>
        </section>
    </main>

    <script src="scripts/date.js"></script>
</body>

</html>