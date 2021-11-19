<?php

namespace App\Services;

use App\Entities\An;
use DateTime;

class AnsService
{
    /**
     * Create or update an user.
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
     * Return all users.
     */
    public function getAns(): array
    {
        $ans = [];

        $dataBaseService = new DataBaseService();
        $ansDTO = $dataBaseService->getAns();
        if (!empty($ansDTO)) {
            foreach ($ansDTO as $anDTO) {
                // Get user :
                $an = new An();
                $an->setId($anDTO['id']);
                $an->setTitle($anDTO['title']);
                $an->setDeparture($anDTO['departure']);
                $an->setDestination($anDTO['destination']);
                $date = new DateTime($anDTO['datea']);
                if ($date !== false) {
                    $an->setDate($date);
                }
                $ans[] = $an;
            }
        }

        return $ans;
    }

    /**
     * Delete an user.
     */
    public function deleteAn(string $iddel): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAn($iddel);

        return $isOk;
    }
}