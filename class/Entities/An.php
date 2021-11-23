<?php

namespace App\Entities;

use DateTime;

class An
{
    private $id;
    private $price;
    private $departure;
    private $destination;
    private $datea;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getDeparture(): string
    {
        return $this->departure;
    }

    public function setDeparture(string $departure): void
    {
        $this->departure = $departure;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function setDestination($destination): void
    {
        $this->destination = $destination;
    }

    public function getDate(): DateTime
    {
        return $this->datea;
    }

    public function setDate(DateTime $datea): void
    {
        $this->datea = $datea;
    }

    public function getCars(): ?array
    {
        return $this->cars;
    }

    public function setCars(array $cars)
    {
        $this->cars = $cars;

        return $this;
    }

    public function getReservations(): ?array
    {
        return $this->reservations;
    }

    public function setReservations(array $reservations)
    {
        $this->reservations = $reservations;

        return $this;
    }
}
