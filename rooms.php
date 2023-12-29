<?php

declare(strict_types=1);

require __DIR__ . '/roomFunctions.php';


$checkIn = $_POST['arrivalDate'];
$checkOut = $_POST['departureDate'];

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
        <section class="room-container">
            <div class="room-container-inner">

                <?php

                // Present available rooms
                foreach ($availableRooms as $room) :

                ?>
                    <label class="room-check">
                        <input type="radio" name="room" hidden>
                        <div class="room-card">
                            <h6><?= $room['name'] ?></h6>

                        </div>

                    </label>
                <?php endforeach; ?>
            </div>

        </section>
    </main>
</body>

</html>