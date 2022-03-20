<?php
// Get the product data
$customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
$firstName = filter_input(INPUT_POST, 'firstName');
$lastName = filter_input(INPUT_POST, 'lastName');
$address = filter_input(INPUT_POST, 'address');
$city = filter_input(INPUT_POST, 'city');
$state = filter_input(INPUT_POST, 'state');
$postalCode = filter_input(INPUT_POST, 'postalCode', FILTER_VALIDATE_INT);
$isActive = filter_input(INPUT_POST, 'isActive');
$error = '';

// Validate inputs
if ($customerID == null || $customerID == false || $firstName == null || $firstName == false ||
        $lastName == null || $lastName == false || $address == null || $address == false ||
        $city == null || $city == false || $state == null || $state == false ||
        $postalCode == null || $postalCode == false || $isActive == null || $isActive == false) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'Update customer 
                SET firstName = :firstName, 
                    lastName = :lastName, 
                    address = :address, 
                    city = :city, 
                    state = :state, 
                    postalCode = :postalCode, 
                    isActive = :isActive 
                WHERE ID = :customerID';
    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':postalCode', $postalCode);
    $statement->bindValue(':isActive', $isActive);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('customer_list.php');
}
?>