<?php
require('../model/database.php');
require('../model/customer_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) 
{
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) 
    {
        $action = 'register';
    }
}  
if ($action == 'register') 
{
    include('register.php');
} 
else if ($action == 'register_process') 
{
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $firstName = filter_input(INPUT_POST, 'first_name');
    $lastName = filter_input(INPUT_POST, 'last_name');
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $postalCode = filter_input(INPUT_POST, 'postalCode');
    if ($firstName == NULL || $firstName == "" ||
            $lastName == NULL || $lastName == "" ||
            $address == NULL || $address == "" ||
            $city == NULL || $city == "" ||
            $state == NULL || $state == "" ||
            $postalCode == NULL || $postalCode == "" ||
            $email == null || $email == "" ||
            $password == null || $password == "") 
    {
        $error = 'Missing or incorrect information.';
        include('../errors/error.php');
    } 
    else 
    {
        $count = get_customer_count($email);
        
        if($count > 0)
        {
            $error = 'That email is already registered, please use a different one.';
            include('../errors/error.php');
        }
        else
        {
            add_customer($email, $password, $firstName, $lastName, $address, $city, $state, $postalCode);
        }
        $ID = get_customerID($email, $password);
    
        header('Location: ../customer_manager?action=edit_customer&customerID='.$ID);
    }
}
else if ($action == 'home') {
    include('../index.php');
} 
?>