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
</head>

<body>
    <main>
        <h1>Isle of dogs</h1>
        <h2>Belmond Cockapoo Palace</h2>

        <div>
            <h3>Book a room</h3>
            <p>Here you can check for available rooms</p>
        </div>

        <div>
            <form method="post" action="/rooms.php">
                <label for="arrivalDate">Arrival date</label>
                <input id="arrivalDate" type="date" min="2024-01-01" max="2024-01-31" name="arrivalDate" />
                <label for="departureDate">Departure date</label>
                <input id="departureDate" type="date" min="2024-01-01" max="2024-01-31" name="departureDate" />
                <button type="submit">Search for available rooms</button>
            </form>
        </div>
        <input type="text" placeholder="First name" name="firstName" />
        <input type="text" placeholder="Last name" name="lastName" />
        <div>

        </div>
    </main>
</body>

</html>