<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;

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

<body>
    <header class="header">
        <div class="title">
            <h1>BELMOND COCKAPOO PALACE</h1>
            <h3>(NOT) A BELMOND HOTEL</h3>
            <h3>ISLE OF DOGS</h3>
        </div>
    </header>
    <main>
        <section class="intro">
            <img src="images/facade.jpg" alt="facade of hotel building">
            <section class="booking-container">
                <div>
                    <h2>BOOK A ROOM</h2>
                </div>

                <form class="booking-form" method="post" action="/rooms.php">
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
                    <div class="booking-button">
                        <button class="button" type="submit">Search for available rooms</button>
                    </div>
                </form>

            </section>
        </section>
    </main>
</body>

</html>