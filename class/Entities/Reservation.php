<?php

namespace App\Entities;

class Reservation
{
    private $id;
    private $title;
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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