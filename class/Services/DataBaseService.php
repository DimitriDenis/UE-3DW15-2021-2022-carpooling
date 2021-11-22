<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = 'password';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Create an user.
     */
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): string
    {
        $userId = '';

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $userId = $this->connection->lastInsertId();
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update a user.
     */
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete a user.
     */
    public function deleteUser(string $id_del): bool
    {
        $isOk = false;

        $data = [
            'id' => $id_del,
        ];
        $sql = 'DELETE FROM users WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO users_cars (user_id, car_id) VALUES (:userId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN users_cars as uc ON uc.car_id = c.id
            WHERE uc.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userCars = $results;
        }

        return $userCars;
    }



 /**
     * Create a car.
     */

    public function createCar(string $brand, string $model, string $color, string $nbrSlots): string
    {
        $carId = '';

        $data = [
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'nbrSlots' => $nbrSlots,
        ];
        $sql = 'INSERT INTO cars (brand, model, color, nbrSlots) VALUES (:brand, :model, :color, :nbrSlots)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $carId = $this->connection->lastInsertId();
        }

        return $carId;
    }
    
    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $sql = 'SELECT * FROM cars';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $cars = $results;
        }

        return $cars;
    }


  /**
     * Update a car.
     */
    public function updateCar(string $idup, string $brandup, string $model, string $color, string $nbrSlots): bool
    {
        $isOk = false;

        $data = [
            'id' => $idup,
            'brand' => $brandup,
            'model' => $model,
            'color' => $color,
            'nbrSlots' => $nbrSlots,
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, color = :color, nbrSlots = :nbrSlots WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        
        return $isOk;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(string $iddel): bool
    {
        $isOk = false;

        $data = [
            'id' => $iddel,
        ];
        $sql = 'DELETE FROM cars WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create a reservation.
     */

    public function createReservation(string $nbrPassengers): string
    {
        $reservationId = '';

        $data = [
            'nbrPassengers' => $nbrPassengers,
        ];
        $sql = 'INSERT INTO reservations (nbrPassengers) VALUES (:nbrPassengers)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $reservationId = $this->connection->lastInsertId();
        }

        return $reservationId;
    }
    
    /**
     * Return all cars.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $sql = 'SELECT * FROM reservations';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $reservations = $results;
        }

        return $reservations;
    }


  /**
     * Update a reservation.
     */
    public function updateReservation(string $idup, string $nbrPassengers): bool
    {
        $isOk = false;

        $data = [
            'id' => $idup,
            'nbrPassengers' => $nbrPassengers,
        ];
        $sql = 'UPDATE reservations SET nbrPassengers = :nbrPassengers WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        
        return $isOk;
    }

    /**
     * Delete a reservation.
     */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM reservations WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create an announcement.
     */
    public function createAn(string $title, string $departure, string $destination, DateTime $datea): string
    {
        $anId = '';

        $data = [
            'title' => $title,
            'departure' => $departure,
            'destination' => $destination,
            'datea' => $datea->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO announcements (title, departure, destination, datea) VALUES (:title, :departure, :destination, :datea)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $anId = $this->connection->lastInsertId();
        }

        return $anId;
    }

    /**
     * Return all announcements.
     */
    public function getAns(): array
    {
        $ans = [];

        $sql = 'SELECT * FROM announcements';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $ans = $results;
        }

        return $ans;
    }

    /**
     * Update an announcement.
     */
    public function updateAn(string $id, string $title, string $departure, string $destination, DateTime $datea): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'title' => $title,
            'departure' => $departure,
            'destination' => $destination,
            'datea' => $datea->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE announcements SET title = :title, departure = :departure, destination = :destination, datea = :datea WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an announcement.
     */
    public function deleteAn(string $iddel): bool
    {
        $isOk = false;

        $data = [
            'id' => $iddel,
        ];
        $sql = 'DELETE FROM announcements WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Create relation bewteen an announcement and his car.
     */
    public function setAnCar(string $anId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'anId' => $anId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO announcements_cars (announcement_id, car_id) VALUES (:anId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given announcement id.
     */
    public function getAnCars(string $anId): array
    {
        $anCars = [];

        $data = [
            'anId' => $anId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN announcements_cars as ac ON ac.car_id = c.id
            WHERE ac.announcement_id = :anId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $anCars = $results;
        }

        return $anCars;
    }

     /**
     * Create relation bewteen an announcement and his Reservation.
     */
    public function setAnReservation(string $anId, string $reservationId): bool
    {
        $isOk = false;

        $data = [
            'anId' => $anId,
            'reservationId' => $reservationId,
        ];
        $sql = 'INSERT INTO announcements_reservations (announcement_id, reservation_id) VALUES (:anId, :reservationId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get reservations of given announcement id.
     */
    public function getAnReservations(string $anId): array
    {
        $anReservations = [];

        $data = [
            'anId' => $anId,
        ];
        $sql = '
            SELECT r.*
            FROM reservations as r
            LEFT JOIN announcements_reservations as ar ON ar.reservation_id = r.id
            WHERE ar.announcement_id = :anId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $anReservations = $results;
        }

        return $anReservations;
    }

    /**
     * Create relation bewteen an user and his Reservation.
     */
    public function setUserReservation(string $userId, string $reservationId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'reservationId' => $reservationId,
        ];
        $sql = 'INSERT INTO users_reservations (user_id, reservation_id) VALUES (:userId, :reservationId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get reservations of given announcement id.
     */
    public function getUserReservations(string $userId): array
    {
        $userReservations = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT r.*
            FROM reservations as r
            LEFT JOIN users_reservations as ar ON ar.reservation_id = r.id
            WHERE ar.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userReservations = $results;
        }

        return $userReservations;
    }

    /**
     * Create relation bewteen an user and his annoucements.
     */
    public function setUserAn(string $userId, string $anId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'anId' => $anId,
        ];
        $sql = 'INSERT INTO users_announcements (user_id, announce_id) VALUES (:userId, :anId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get reservations of given announcement id.
     */
    public function getUserAns(string $userId): array
    {
        $userAns = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT a.*
            FROM announcements as a
            LEFT JOIN users_announcements as ua ON ua.announce_id = a.id
            WHERE ua.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userAns = $results;
        }

        return $userAns;
    }

}



