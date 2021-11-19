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
        if (isset($_POST['title']) &&
            isset($_POST['departure']) &&
            isset($_POST['destination']) &&
            isset($_POST['datea'])) {
            // Create the user :
            $ansService = new AnsService();
            $anId = $ansService->setAn(
                null,
                $_POST['title'],
                $_POST['departure'],
                $_POST['destination'],
                $_POST['datea']
            );
            if ($anId) {
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
        $html = '';

        // Get all users :
        $ansService = new AnsService();
        $ans = $ansService->getAns();

        // Get html :
        foreach ($ans as $an) {
            $html .=
                '#' . $an->getId() . ' ' .
                $an->getTitle() . ' ' .
                $an->getDeparture() . ' ' .
                $an->getDestination() . ' ' .
                $an->getDate()->format('d-m-Y') . '<br />';
        }

        return $html;
    }

    /**
     * Update the user.
     */
    public function updateAn(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['idup']) &&
            isset($_POST['titleup']) &&
            isset($_POST['departureup']) &&
            isset($_POST['destinationup']) &&
            isset($_POST['dateup'])) {
            // Update the user :
            $ansService = new AnsService();
            $isOk = $ansService->setAn(
                $_POST['idup'],
                $_POST['titleup'],
                $_POST['departureup'],
                $_POST['destinationup'],
                $_POST['dateup']
            );
            if ($isOk) {
                $html = 'Utilisateur mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'utilisateur.';
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