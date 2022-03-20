<?php
require('../model/database.php');
require('../model/customer_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'login';
    }
}  
if ($action == "login")
{
    include('login.php');
}
if ($action == 'login_process') 
{
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    if ($email == NULL || $email == FALSE ||
            $password == null || $password == false) {
        $error = 'Invalid login';
        include('../errors/error.php');
    }
    $valid = get_valid_login($email, $password);
    if(!$valid)
    {
        $error = 'Invalid login';
        include('../errors/error.php');
    }
    $ID = get_customerID($email, $password);
    
    header('Location: ../customer_manager?action=edit_customer&customerID='.$ID);
} 
else if ($action == 'home') 
{
    include('../index.php');
} 
?>