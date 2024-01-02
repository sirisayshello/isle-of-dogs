<?php

declare(strict_types=1);

require __DIR__ . '/hotelFunctions.php';


function getRooms(): array
{
    $db = connect('hotel.db');

    $statement = $db->query('SELECT * FROM rooms');

    return $statement->fetchAll(PDO::FETCH_ASSOC);
};

function availableRooms($checkIn, $checkOut): array
{
    $db = connect('hotel.db');
    $statement = $db->prepare("select * from rooms
    where id not in (
    select room_id from bookings
    where arrival_date BETWEEN :checkIn AND :checkOut
    OR
    departure_date between :checkIn AND :checkOut
    OR
    :checkIn between arrival_date and departure_date
    OR

    :checkOut between arrival_date and departure_date)");

    $statement->bindParam('checkIn', $checkIn, PDO::PARAM_STR);
    $statement->bindParam('checkOut', $checkOut, PDO::PARAM_STR);

    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function isRoomAvailable($roomId, $availableRooms): bool
{
    foreach ($availableRooms as $availableRoom) {
        if ($availableRoom['id'] === intval($roomId)) {
            return true;
        }
    }
    return false;
}
