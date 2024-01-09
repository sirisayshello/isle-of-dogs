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
            $booking['arrival_date'],   # start date in either Y-m-d or Y-m-d H:i if you want to add a time.
            $booking['departure_date'],   # end date in either Y-m-d or Y-m-d H:i if you want to add a time.
            '',  # event name text
            true,           # should the date be masked - boolean default true
            ['booked']   # (optional) additional classes in either string or array format to be included on the event days
        );
    }

    echo $calendar->draw(date('Y-01-01'));
}
