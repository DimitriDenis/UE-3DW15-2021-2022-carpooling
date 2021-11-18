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
            $slots = (string)$_POST['nbrSlots'];
            $carsService = new CarsService();
            $carsId = $carsService->setCar(
                null,
                $_POST['brand'],
                $_POST['model'],
                $_POST['color'],
                $slots
            );

        
        return $html;
        }


    }    


/**
     * Return the html for the read action.
     */
    public function getCars(): string
    {
        $html = '';

        // Get all users :
        $carsService = new CarsService();
        $cars = $carsService->getCars();

        // Get html :
        foreach ($cars as $car) {
           
            $html .=
                '#' . $car->getId() . ' ' .
                $car->getBrand() . ' ' .
                $car->getModel() . ' ' .
                $car->getColor() . ' ' .
                $car->getNbrSlots();
                
        }

        return $html;
    }


}