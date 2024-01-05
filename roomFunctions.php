<?php

declare(strict_types=1);

require __DIR__ . '/hotelFunctions.php';


function getRooms(): array
{
    $db = connect('hotel.db');

    $statement = $db->query('SELECT * FROM rooms');

    return $statement->fetchAll(PDO::FETCH_ASSOC);
};

function getFeatures(): array
{
    $db = connect('hotel.db');

    $statement = $db->query('SELECT * FROM features');

    return $statement->fetchAll(PDO::FETCH_ASSOC);
};

function getFeaturesByIds($featureIds): array
{
    $db = connect('hotel.db');

    $placeholder = str_repeat('?,', count($featureIds) - 1) . '?';

    $statement = $db->prepare("SELECT name, price FROM features where id in ($placeholder)");

    $statement->execute($featureIds);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getRoom(int $roomId): array
{
    $db = connect('hotel.db');
    $statement = $db->prepare(
        'select * from rooms
        where id = :roomId'
    );

    $statement->bindParam('roomId', $roomId, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}


function availableRooms(string $checkIn, string $checkOut): array
{
    $db = connect('hotel.db');
    $statement = $db->prepare('select * from rooms
    where id not in (
    select room_id from bookings
    where arrival_date BETWEEN :checkIn AND :checkOut
    OR
    departure_date between :checkIn AND :checkOut
    OR
    :checkIn between arrival_date and departure_date
    OR

    :checkOut between arrival_date and departure_date)');

    $statement->bindParam('checkIn', $checkIn, PDO::PARAM_STR);
    $statement->bindParam('checkOut', $checkOut, PDO::PARAM_STR);

    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function isRoomAvailable(int $roomId, array $availableRooms): bool
{
    foreach ($availableRooms as $availableRoom) {
        if ($availableRoom['id'] === $roomId) {
            return true;
        }
    }
    return false;
}
