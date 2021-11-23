<?php

namespace App\Services;

use App\Entities\Reservation;

class ReservationsService
{
    /**
    * Create or update a car.
    */
    public function setReservation(?string $id,string $title, string $nbrPassengers): string
    {
        $reservationId = '';

        $dataBaseService = new DataBaseService();
        
        if (empty($id)) {
            $reservationId = $dataBaseService->createReservation($title, $nbrPassengers);
        } else {
            $dataBaseService->updateReservation($id, $title, $nbrPassengers);
            $reservationId = $id;
        }

        return $reservationId;
    }

    /**
     * Return all reservations.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $dataBaseService = new DataBaseService();
        $reservationsDTO = $dataBaseService->getReservations();
        if (!empty($reservationsDTO)) {
            foreach ($reservationsDTO as $reservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($reservationDTO['id']);
                $reservation->setTitle($reservationDTO['title']);
                $reservation->setNbrPassengers($reservationDTO['nbrPassengers']);
                $reservations[] = $reservation;
            }
        }

        return $reservations;
    }

    /**
     * Delete an reservation.
     */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteReservation($id);

        return $isOk;
    }
}