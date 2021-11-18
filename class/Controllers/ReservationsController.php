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
        if (isset($_POST['nbrPassengers'])) {
            // Create the user :
            $reservationsService = new ReservationsService();
            $reservationsId = $reservationsService->setReservation(
                null,
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
        $html = '';

        // Get all users :
        $reservationsService = new ReservationsService();
        $reservations = $reservationsService->getReservations();

        // Get html :
        foreach ($reservations as $reservation) {
           
            $html .=
                '#' . $reservation->getId() . ' ' .
                $reservation->getNbrPassengers(). '<br />';
                
        }

        return $html;
    }

    /**
     * Return the html for the update action.
     */
    public function updateReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if ( isset($_POST['idup']) &&
            isset($_POST['nbrPassengers'])) {
            // Update the car :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                $_POST['idup'],
                $_POST['nbrPassengers']
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
        if (isset($_POST['id'])) {
            // Delete the user :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->deleteReservation($_POST['id']);
            if ($isOk) {
                $html = 'La réservation à été supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la réservation.';
            }
        }

        return $html;
    }

}