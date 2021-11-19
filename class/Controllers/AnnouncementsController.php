<?php

namespace App\Controllers;

use App\Services\AnnouncementsService;

class AnnouncementsController
{
    /**
     * Return the html for the create action
     */
    public function createAnnouncement(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['name']) &&
            isset($_POST['departure']) &&
            isset($_POST['destination']) &&
            isset($_POST['date'])) {
            // Create the user :
            $announcementsService = new AnnouncementsService();
            $announcementId = $announcementsService->setAnnouncement(
                null,
                $_POST['name'],
                $_POST['departure'],
                $_POST['destination'],
                $_POST['date']
            );

            // Create the user cars relations :
            if ($announcementId) {
                $html = 'Utilisateur créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'utilisateur.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action
     */
    public function getAnnouncements(): string
    {
        $html = '';

        $announcementsService= new AnnouncementsService();
        $announcements = $announcementsService->getAnnouncements();

        foreach($announcements as $announcement){
            $html .= 
                '#' . $announcement->getId(). ' ' .
                $announcement->getName(). ' ' .
                $announcement->getDeparture(). ' ' .
                $announcement->getDestination(). ' ' .
                $announcement->getDate()->format('d-m-Y'). '<br/>';
        }
        return $html;
    }

    /**
     * Update an Announcement
     */
    public function updateAnnouncement(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['name']) &&
            isset($_POST['departure']) &&
            isset($_POST['destination']) &&
            isset($_POST['date'])) {
            // Update the Announcement :
            $announcementsService = new AnnouncementsService();
            $isOk = $announcementsService->setAnnouncement(
                $_POST['id'],
                $_POST['name'],
                $_POST['departure'],
                $_POST['destination'],
                $_POST['date']
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
     * Delete an Announcement.
     */
    public function deleteAnnouncement(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['iddel'])) {
            // Delete the Announcement :
            $announcementsService = new AnnouncementsService();
            $isOk = $announcementsService->deleteAnnouncement($_POST['iddel']);
            if ($isOk) {
                $html = 'Utilisateur supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'utilisateur.';
            }
        }

        return $html;
    }
}