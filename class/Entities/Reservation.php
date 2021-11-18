<?php

namespace App\Entities;

class Reservation
{
    private $id;
    private $nbrPassengers;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNbrPassengers(): int
    {
        return $this->nbrPassengers;
    }

    public function setNbrPassengers(int $nbrPassengers): self
    {
        $this->nbrPassengers = $nbrPassengers;

        return $this;
    }
}    