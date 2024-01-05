<?php

declare(strict_types=1);

use GuzzleHttp\Client;

// get number of days
function numberOfDays(string $arrivalDate, string $departureDate)
{
    $date1 = new DateTime($arrivalDate);
    $date2 = new DateTime($departureDate);
    $interval = $date1->diff($date2);
    // since we are charging for days and not nights we need to add 1
    return $interval->days + 1;
}

// Check if a transferCode is valid and unused
function validatePayment(string $transferCode, int $totalcost): bool
{
    $client = new Client([
        'base_uri' => 'https://www.yrgopelag.se/centralbank/',
        'timeout' => 2.0,
    ]);

    try {
        $response = $client->post("transferCode", [
            'form_params' => [
                'transferCode' => $transferCode,
                'totalcost' => $totalcost
            ],
        ]);
        $response = $response->getBody()->getContents();
        $response = json_decode($response, true);

        // if error is defined in the response we know transfercode is not valid
        if (isset($response['error'])) {
            return false;
        }
        return true;
    } catch (\Exception $e) {
        echo "Error occured!" . $e;
    }
}

//Insert booking to db
function registerBooking(string $arrivalDate, string $departureDate, string $firstName, string $lastName, int $roomId, int $totalCost, string $transferCode): int
{
    $db = connect('hotel.db');
    $statement = $db->prepare(
        'insert into bookings (arrival_date, departure_date, first_name, last_name, room_id, total_cost, transfer_code)
        values (:arrivalDate, :departureDate, :firstName, :lastName, :roomId, :totalCost, :transferCode)'
    );

    $statement->bindParam('arrivalDate', $arrivalDate, PDO::PARAM_STR);
    $statement->bindParam('departureDate', $departureDate, PDO::PARAM_STR);
    $statement->bindParam('firstName', $firstName, PDO::PARAM_STR);
    $statement->bindParam('lastName', $lastName, PDO::PARAM_STR);
    $statement->bindParam('roomId', $roomId, PDO::PARAM_INT);
    $statement->bindParam('totalCost', $totalCost, PDO::PARAM_INT);
    $statement->bindParam('transferCode', $transferCode, PDO::PARAM_STR);

    $statement->execute();

    return intval($db->lastInsertId());
}

function registerFeature(int $featureId, int $bookingId)
{
    $db = connect('hotel.db');
    $statement = $db->prepare(
        'insert into bookings_features (feature_id, booking_id)
        values (:featureId, :bookingId)'
    );

    $statement->bindParam('featureId', $featureId, PDO::PARAM_INT);
    $statement->bindParam('bookingId', $bookingId, PDO::PARAM_INT);


    $statement->execute();
}

// Deposit to centralbank
function depositTransfercode(string $transferCode)
{
    $client = new Client([
        'base_uri' => 'https://www.yrgopelag.se/centralbank/',
        'timeout' => 2.0,
    ]);

    try {
        $response = $client->post("deposit", [
            'form_params' => [
                'user' => 'Siri',
                'transferCode' => $transferCode,
            ],
        ]);
        $response = $response->getBody()->getContents();
        $response = json_decode($response, true);

        if (isset($response['error'])) {
            return false;
        }
        return true;
    } catch (\Exception $e) {
        echo "Error occured!" . $e;
    }
}
