<?php

namespace App\Controllers;

use App\Services\CarsService;

class CarsController
{
    /**
     * Return the html for the create action.
     */
    public function createCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['nbrSlots'])) {
            // Create the user :
            $carsService = new CarsService();
            $carsId = $carsService->setCar(
                null,
                $_POST['brand'],
                $_POST['model'],
                $_POST['color'],
                $_POST['nbrSlots']
            );
            if ($carsId){
                $html .= "La voiture à bien été créée !";
            }
            else {
                $html .= "Erreur, la voiture n'a pas été créée !";
            }
        }
        return $html;

    }    


/**
     * Return the html for the read action.
     */
    public function getCars(): string
    {
        $html = '<table class="table_af">' .
        '<tr>' .
        '<th>Numéro</th>' .
        '<th>Marque</th>' .
        '<th>Modèle</th>' .
        '<th>Couleur</th>' .
        '<th>Nombre de places passager</th>' .
        '</tr>';

        // Get all users :
        $carsService = new CarsService();
        $cars = $carsService->getCars();

        // Get html :
        foreach ($cars as $car) {
           
            $html .=
                '<tr>'.
                '<td>'. '#' . $car->getId() . ' ' . '</td>' .
                '<td>'. $car->getBrand() . ' ' . '</td>' .
                '<td>'. $car->getModel() . ' ' . '</td>' .
                '<td>'. $car->getColor() . ' ' . '</td>' .
                '<td>'. $car->getNbrSlots(). ' ' . '</td>' .
                '</tr>';
                
        }
        $html .= '</table>';
        return $html;
    }

    /**
     * Return the html for the update action.
     */
    public function updateCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if ( isset($_POST['idup']) &&
            isset($_POST['brandup']) &&
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['nbrSlots'])) {
            // Update the car :
            $carsService = new CarsService();
            $isOk = $carsService->setCar(
                $_POST['idup'],
                $_POST['brandup'],
                $_POST['model'],
                $_POST['color'],
                $_POST['nbrSlots']
            );
            if ($isOk){
                $html = "La voiture à bien été modifiée !";
            }
            else {
                $html = "Erreur, la voiture n'a pas été modifiée !";
            }
        }
        return $html;

    } 
        /**
     * Delete an user.
     */
    public function deleteCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['iddel'])) {
            // Delete the user :
            $carsService = new carsService();
            $isOk = $carsService->deleteCar($_POST['iddel']);
            if ($isOk) {
                $html = 'La voiture à été supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la voiture.';
            }
        }

        return $html;
    }

}