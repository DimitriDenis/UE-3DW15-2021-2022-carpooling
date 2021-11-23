<?php

namespace App\Controllers;

use App\Services\AnsService;

class AnsController
{
    /**
     * Return the html for the create action.
     */
    public function createAn(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['price']) &&
            isset($_POST['departure']) &&
            isset($_POST['destination']) &&
            isset($_POST['datea']) &&
            isset($_POST['cars'])) {
            // Create the user :
            $ansService = new AnsService();
            $anId = $ansService->setAn(
                null,
                $_POST['price'],
                $_POST['departure'],
                $_POST['destination'],
                $_POST['datea']
            );
            $isOk = True;
            if (!empty($_POST['cars'])) {
                foreach ($_POST['cars'] as $carId) {
                    $isOk = $ansService->setAnCar($anId, $carId);
                }
            }
            if ($anId && $isOk) {
                $html = 'Utilisateur créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'utilisateur.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getAns(): string
    {
        $html = '<table class="table_af">' .
        '<tr>' .
        '<th>Numéro</th>' .
        '<th>Titre</th>' .
        '<th>Départ</th>' .
        '<th>Arrivée</th>' .
        '<th>Date</th>' .
        '<th>Voiture</th>' .
        '<th>Réservée par</th>' .
        '</tr>';

        // Get all ans :
        $ansService = new AnsService();
        $ans = $ansService->getAns();

        // Get html :
        foreach ($ans as $an) {
            $carsHtml = '';
            $resHtml = '';
            if (!empty($an->getCars())) {
                foreach ($an->getCars() as $car) {
                    $carsHtml .= $car->getBrand() . ' ' . $car->getModel();
                }
            }
            if (!empty($an->getReservations())) {
                foreach ($an->getReservations() as $reservation) {
                    $resHtml .= $reservation->getNbrPassengers().' Passager(s)';
                }
            }
            $html .= 
                '<tr>'.
                '<td>'. '#' . $an->getId() . ' ' . '</td>'.
                '<td>'. $an->getPrice() . ' ' . '</td>'.
                '<td>'.$an->getDeparture() . ' ' . '</td>'.
                '<td>'.$an->getDestination() . ' ' . '</td>'.
                '<td>'.$an->getDate()->format('d-m-Y') . ' ' . '</td>'.
                '<td>'.$carsHtml . ' ' . '</td>'.
                '<td>'.$resHtml .'<br />'. '</td>'.
                '</tr>';
        }
        $html .= '</table>';
        return $html;
    }

    /**
     * Update the An.
     */
    public function updateAn(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['idup']) &&
            isset($_POST['titleup']) &&
            isset($_POST['departureup']) &&
            isset($_POST['destinationup']) &&
            isset($_POST['dateup']) &&
            isset($_POST['reservations'])) {
            $anId=$_POST['idup'];
            // Update the user :
            $ansService = new AnsService();
            $isOk = $ansService->setAn(
                $_POST['idup'],
                $_POST['titleup'],
                $_POST['departureup'],
                $_POST['destinationup'],
                $_POST['dateup']
            );
            if (!empty($_POST['reservations'])) {
                foreach ($_POST['reservations'] as $reservationId) {
                    $isOk = $ansService->setAnReservation($anId, $reservationId);
                }
            }
            if ($isOk) {
                $html = 'Annonce mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Delete an user.
     */
    public function deleteAn(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['iddel'])) {
            // Delete the user :
            $ansService = new AnsService();
            $isOk = $ansService->deleteAn($_POST['iddel']);
            if ($isOk) {
                $html = 'Utilisateur supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'utilisateur.';
            }
        }

        return $html;
    }
}