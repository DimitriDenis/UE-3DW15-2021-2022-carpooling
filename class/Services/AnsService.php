<?php

namespace App\Services;

use App\Entities\An;
use App\Entities\Car;
use App\Entities\Reservation;
use DateTime;

class AnsService
{
    /**
     * Create or update an Announcement.
     */
    public function setAn(?string $id, string $title, string $departure, string $destination, string $datea): string
    {
        $anId = '';

        $dataBaseService = new DataBaseService();
        $dateTime = new DateTime($datea);
        if (empty($id)) {
            $anId = $dataBaseService->createAn($title, $departure, $destination, $dateTime);
        } else {
            $dataBaseService->updateAn($id, $title, $departure, $destination, $dateTime);
            $anId = $id;
        }

        return $anId;
    }

    /**
     * Return all Announcements.
     */
    public function getAns(): array
    {
        $ans = [];

        $dataBaseService = new DataBaseService();
        $ansDTO = $dataBaseService->getAns();
        if (!empty($ansDTO)) {
            foreach ($ansDTO as $anDTO) {
                // Get An :
                $an = new An();
                $an->setId($anDTO['id']);
                $an->setTitle($anDTO['title']);
                $an->setDeparture($anDTO['departure']);
                $an->setDestination($anDTO['destination']);
                $date = new DateTime($anDTO['datea']);
                if ($date !== false) {
                    $an->setDate($date);
                }

                // Get cars of this announcement :
                $cars = $this->getAnCars($anDTO['id']);
                $an->setCars($cars);
                $reservations = $this->getAnReservations($anDTO['id']);
                $an->setReservations($reservations);


                $ans[] = $an;
            }
        }

        return $ans;
    }

    /**
     * Delete an Announcement.
     */
    public function deleteAn(string $iddel): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAn($iddel);

        return $isOk;
    }

    /**
     * Create relation bewteen an Announcement and his car.
     */
    public function setAnCar(string $anId, string $carId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setAnCar($anId, $carId);

        return $isOk;
    }

    /**
     * Get cars of given Announcement id.
     */
    public function getAnCars(string $anId): array
    {
        $anCars = [];

        $dataBaseService = new DataBaseService();

        // Get relation ans and cars :
        $ansCarsDTO = $dataBaseService->getAnCars($anId);
        if (!empty($ansCarsDTO)) {
            foreach ($ansCarsDTO as $anCarDTO) {
                $car = new Car();
                $car->setId($anCarDTO['id']);
                $car->setBrand($anCarDTO['brand']);
                $car->setModel($anCarDTO['model']);
                $car->setColor($anCarDTO['color']);
                $car->setNbrSlots($anCarDTO['nbrSlots']);
                $anCars[] = $car;
            }
        }

        return $anCars;
    }

    /**
     * Get cars of given Announcement id.
     */
    public function getAnReservations(string $anId): array
    {
        $anReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation ans and reservations :
        $ansReservationsDTO = $dataBaseService->getAnReservations($anId);
        if (!empty($ansReservationsDTO)) {
            foreach ($ansReservationsDTO as $anReservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($anReservationDTO['id']);
                $reservation->setNbrPassengers($anReservationDTO['nbrPassengers']);
                $anReservations[] = $reservation;
            }
        }

        return $anReservations;
    }

    /**
     * Create relation bewteen an Announcement and his car.
     */
    public function setAnReservation(string $anId, string $reservationId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setAnReservation($anId, $reservationId);

        return $isOk;
    }

    
}