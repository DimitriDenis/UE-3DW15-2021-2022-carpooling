<?php

namespace App\Controllers;

use App\Services\ReservationsService;

class ReservationsController
{
    /**
     * Return the html for the create action.
     */
    public function createReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['title']) &&
            isset($_POST['nbrPassengers'])) {
            // Create the user :
            $reservationsService = new ReservationsService();
            $reservationsId = $reservationsService->setReservation(
                null,
                $_POST['title'],
                $_POST['nbrPassengers']
            );
            if ($reservationsId){
                $html .= "La réservation à bien été créée !";
            }
            else {
                $html .= "Erreur, la réservation n'a pas été créée !";
            }
        }
        return $html;

    }    


/**
     * Return the html for the read action.
     */
    public function getReservations(): string
    {
        $html = '<table class="table_af">' .
        '<tr>' .
        '<th>Numéro</th>' .
        '<th>Nom</th>' .
        '<th>Nombre de passager(s)</th>' .
        '</tr>';

        // Get all users :
        $reservationsService = new ReservationsService();
        $reservations = $reservationsService->getReservations();

        // Get html :
        foreach ($reservations as $reservation) {
           
            $html .=
                '<tr>'.
                '<td>'. '#' . $reservation->getId() . ' ' . '</td>' .
                '<td>'. $reservation->getTitle(). ' ' . '</td>' .
                '<td>'. $reservation->getNbrPassengers(). ' ' . '</td>' .
                '</tr>';
                
        }
        $html .= '</table>';
        return $html;
    }

    /**
     * Return the html for the update action.
     */
    public function updateReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['idup']) &&
            isset($_POST['titleup']) &&
            isset($_POST['nbrPassengersup'])) {
            // Update the car :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                $_POST['idup'],
                $_POST['titleup'],
                $_POST['nbrPassengersup']
            );
            if ($isOk){
                $html = "La réservation à bien été modifiée !";
            }
            else {
                $html = "Erreur, la réservation n'a pas été modifiée !";
            }
        }
        return $html;

    } 
        /**
     * Delete an user.
     */
    public function deleteReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['iddel'])) {
            // Delete the user :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->deleteReservation($_POST['iddel']);
            if ($isOk) {
                $html = 'La réservation à été supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la réservation.';
            }
        }

        return $html;
    }

}