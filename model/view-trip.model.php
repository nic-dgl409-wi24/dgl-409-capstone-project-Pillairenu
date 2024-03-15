<?php
class RideModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getRideDetails($rideId) {
        $sql = "SELECT users.name, users.email, users.gender, 
                       vehicles.vehicle_make_model, vehicles.vehicle_photo_path,
                       rides.departure, rides.arrival, rides.date, rides.time 
                FROM rides
                JOIN users ON rides.user_id = users.user_id
                JOIN vehicles ON users.user_id = vehicles.user_id
                WHERE rides.ride_id = :ride_id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['ride_id' => $rideId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching ride details: " . $e->getMessage());
            return null;
        }
    }
}