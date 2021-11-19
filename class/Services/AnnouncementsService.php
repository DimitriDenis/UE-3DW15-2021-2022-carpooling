<?php
namespace App\Services;

use App\Entities\Announcement;
use DateTime;

class AnnouncementsService
{
    /**
     * Create or update an announcement
     */
    public function setAnnouncement(?string $id,string $Aname, string $departure, string $destination, string $Adate): string
    {
        $announcementId = '';
        $dataBaseService = new DataBaseService();
        $announcementDateTime = new DateTime($Adate);
        if (empty($id)) {
            $announcementId = $dataBaseService->createAnnouncement($Aname, $departure, $destination, $announcementDateTime);
        } else {
            $dataBaseService->updateAnnouncement($id, $Aname, $departure, $destination, $announcementDateTime);
            $announcementId = $id;
        }
        return $announcementId;
    }

    /**
     * Return all users
     */
    public function getAnnouncements(): array
    {
        $announcements = [];

        $dataBaseService = new DataBaseService();
        $announcementsDTO = $dataBaseService->getAnnouncements();
        if(!empty($announcementsDTO)){
            foreach ($announcementsDTO as $announcementDTO) {
            // get announcement :
            $announcement = new Announcement();
            $announcement->setId($announcementDTO['id']);
            $announcement->setName($announcementDTO['name']);
            $announcement->setDeparture($announcementDTO['departure']);
            $announcement->setDestination($announcementDTO['destination']);
            $date = new DateTime($announcementDTO['date']);
            if($date !== false){
                $announcement->setDate($date);
            }
                $announcements[] = $announcement;
            }
        }   
        return $announcements;
    }

    /**
     * Delete an announcement
     */
    public function deleteAnnouncement(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAnnouncement($id);
        return $isOk;
    }

}
