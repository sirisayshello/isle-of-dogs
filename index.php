<?php

declare(strict_types=1);

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
            <h2>(NOT) A BELMOND HOTEL</h2>
            <H3>ISLE OF DOGS</H3>
        </div>
    </header>
    <main>
        <section class="intro">
            <div class="border"></div>
            <img src="images/facade.jpg" alt="facade of hotel building">
            <section class="intro-booking">
                <div>
                    <h2>BOOK A ROOM</h2>
                </div>

                <form method="post" action="/rooms.php">
                    <label for="arrivalDate">Arrival date</label>
                    <input id="arrivalDate" type="date" min="2024-01-01" max="2024-01-31" name="arrivalDate" />
                    <label for="departureDate">Departure date</label>
                    <input id="departureDate" type="date" min="2024-01-01" max="2024-01-31" name="departureDate" />
                    <button class="button" type="submit">Search for available rooms</button>
                </form>

            </section>
        </section>
    </main>
</body>

</html>