<?php
require_once 'RestaurantDatabase.php';

$db = new RestaurantDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'addCustomer':
            $name = $_POST['name'];
            $contact = $_POST['contact'];
            $db->addCustomer($name, $contact);
            echo "Customer added successfully.";
            break;

        case 'addReservation':
            $name = $_POST['name'];
            $time = $_POST['time'];
            $guests = $_POST['guests'];
            $requests = $_POST['requests'];
            $db->addReservation($name, $time, $guests, $requests);
            echo "Reservation added successfully.";
            break;

        case 'getCustomerPreferences':
            $customerId = $_POST['customerId'];
            $preferences = $db->getCustomerPreferences($customerId);
            echo json_encode($preferences);
            break;

        default:
            echo "Invalid action.";
    }
}
?>
n