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
        <h3>(NOT) A BELMOND HOTEL</h3>
        <h3>ISLE OF DOGS</h3>
    </div>
</header>

<body>
    <main>
        <section class="intro">
            <img src="images/facade.jpg" alt="facade of hotel building">
            <div class="booking-container">

                <?php

                // create a booking response in json
                $bookingResponse = [
                    'island' => 'Isle of dogs',
                    'hotel' => 'Belmond Cockapoo Palace',
                    'arrival_date' => '',
                    'departure_date' => '',
                    'total_cost' => '4',
                    'stars' => '3',
                    'features' => '$features',
                    'additional_info' => [
                        'greeting' => 'Thank you for chosing Belmond Cockapoo Palace'
                    ]
                ];

                $bookingResponseJson = json_encode($bookingResponse);
                echo $bookingResponseJson;

                ?>
            </div>

        </section>
    </main>
</body>