<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require __DIR__ . '/bookingFunctions.php';

use benhall14\phpCalendar\Calendar as Calendar;



function drawCalendar(int $roomId)
{

    $calendar = new Calendar;
    $calendar->useMondayStartingDate();


    // Fetch all bookings from bookings
    $bookings = getBookingsByRoom($roomId);

    foreach ($bookings as $booking) {
        $calendar->addEvent(
            $booking['arrival_date'],
            $booking['departure_date'],
            '',
            true,
            ['booked']
        );
    }

    echo $calendar->draw(date('Y-01-01'));
}
