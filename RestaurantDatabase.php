<?php
class RestaurantDatabase {
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $db = 'restaurant_reservations';
        $user = 'root';
        $pass = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function addCustomer($customerName, $contactInfo) {
        $sql = "INSERT INTO Customers (customerName, contactInfo) VALUES (:customerName, :contactInfo)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['customerName' => $customerName, 'contactInfo' => $contactInfo]);
    }

    public function addReservation($customerName, $reservationTime, $numberOfGuests, $specialRequests) {
        $customerId = $this->findCustomerByName($customerName);
        if (!$customerId) {
            $this->addCustomer($customerName, null);
            $customerId = $this->pdo->lastInsertId();
        }

        $sql = "INSERT INTO Reservations (customerId, reservationTime, numberOfGuests, specialRequests)
                VALUES (:customerId, :reservationTime, :numberOfGuests, :specialRequests)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'customerId' => $customerId,
            'reservationTime' => $reservationTime,
            'numberOfGuests' => $numberOfGuests,
            'specialRequests' => $specialRequests
        ]);
    }

    public function getCustomerPreferences($customerId) {
        $sql = "SELECT * FROM DiningPreferences WHERE customerId = :customerId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['customerId' => $customerId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function findCustomerByName($customerName) {
        $sql = "SELECT customerId FROM Customers WHERE customerName = :customerName";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['customerName' => $customerName]);
        return $stmt->fetchColumn();
    }
}
?>
