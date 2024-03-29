<?php

namespace App\Controllers;

use App\Services\UsersService;

class UsersController
{
    /**
     * Return the html for the create action.
     */
    public function createUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['birthday']) &&
            isset($_POST['cars'])) {
            // Create the user :
            $usersService = new UsersService();
            $userId = $usersService->setUser(
                null,
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
            );

            // Create the user cars relations :
            $isOk = true;
            if (!empty($_POST['cars'])) {
                foreach ($_POST['cars'] as $carId) {
                    $isOk = $usersService->setUserCar($userId, $carId);
                }
            }
            if ($userId && $isOk) {
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
    public function getUsers(): string
    {
        $html = '<table class="table_af">' .
        '<tr>' .
        '<th>Numéro</th>' .
        '<th>Prénom</th>' .
        '<th>Nom</th>' .
        '<th>Adresse mail</th>' .
        '<th>Date de naissance</th>' .
        '<th>Voiture</th>' .
        '<th>Annonce</th>' .
        '<th>Réservation</th>' .
        '</tr>';

        // Get all users :
        $usersService = new UsersService();
        $users = $usersService->getUsers();

        // Get html :
        foreach ($users as $user) {
            $carsHtml = '';
            $ansHtml = '';
            $resHtml = '';
            if (!empty($user->getCars())) {
                foreach ($user->getCars() as $car) {
                    $carsHtml .= '#'.$car->getBrand() . '-' . $car->getModel() . ' ' . $car->getColor() . ' ';
                }
            }

            if (!empty($user->getAns())) {
                foreach ($user->getAns() as $an) {
                    $ansHtml .= '#'.$an->getId(). ' | ' .$an->getPrice() . '€ : ' . $an->getDeparture() . '=>' . $an->getDestination() . ' ';
                }
            }

            if (!empty($user->getReservations())) {
                foreach ($user->getReservations() as $reservation) {
                    $resHtml .= "#".$reservation->getId() . ' - ' . $reservation->getNbrPassengers(). ' passager(s) ';
                }
            }

            
            $html .=
                '<tr>'.
                '<td>'. '#' . $user->getId() . ' ' . '</td>'.
                '<td>'. $user->getFirstname() . ' ' .'</td>'.
                '<td>'. $user->getLastname() . ' ' .'</td>'.
                '<td>'. $user->getEmail() . ' ' .'</td>'.
                '<td>'. $user->getBirthday()->format('d-m-Y') . ' ' .'</td>'.
                '<td>'. $carsHtml . ' '. '</td>'.
                '<td>'. $ansHtml . ' '. '</td>'.
                '<td>'. $resHtml . ' '. '</td>'.
                '</tr>';
        }
        $html .= '</table>';
        return $html;
    }

    /**
     * Update the user.
     */
    public function updateUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['birthday']) &&
            isset($_POST['reservations'])) {
            $userId=$_POST['id'];
            // Update the user :
            $usersService = new UsersService();
            $isOk = $usersService->setUser(
                $_POST['id'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
            );

            if (!empty($_POST['reservations'])) {
                foreach ($_POST['reservations'] as $reservationId) {
                    $isOk = $usersService->setUserReservation($userId, $reservationId);
                }
            }
            if (!empty($_POST['ans'])) {
                foreach ($_POST['ans'] as $anId) {
                    $isOk = $usersService->setUserAn($userId, $anId);
                }
            }
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
    public function deleteUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['iddel'])) {
            // Delete the user :
            $usersService = new UsersService();
            $isOk = $usersService->deleteUser($_POST['iddel']);
            if ($isOk) {
                $html = 'Utilisateur supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'utilisateur.';
            }
        }

        return $html;
    }
}
