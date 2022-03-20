<?php
//customer index
if (session_id() == '') {
$lifetime = 60 * 60 * 24 * 14; 
        // 2 weeks in seconds 
        session_set_cookie_params($lifetime, '/'); 
        session_start(); 
}
require('../model/database.php');
require('../model/customer_db.php');
require('../model/customer.php');

$customerDB = new CustomerDB();
 
if (isset($_SESSION['loginInfo'])) {
    $loginInfo = $_SESSION['loginInfo'];
} else {
    $loginInfo = array();
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_customers';
    }
}  
if ($action == 'list_customers') {
    $last_name = filter_input(INPUT_GET, 'last_name');
    if ($last_name == NULL || $last_name == FALSE) {
        $last_name = "";
    }
    $customers = $customerDB->get_customer_list($last_name);
    include('customer_list.php');
} 
else if ($action == 'edit_customer') {
    $customer_id = filter_input(INPUT_GET, 'customerID', 
            FILTER_VALIDATE_INT);   
    if ($customer_id == NULL || $customer_id == FALSE) {
        $error = 'Missing or incorrect customer id.';
        include('../errors/error.php');
    } else {
        $customer = $customerDB->get_customer_by_id($customer_id);

        // Get customer data
        $firstName = $customer->getFirstName();
        $lastName = $customer->getLastName();
        $address = $customer->getAddress();
        $city = $customer->getCity();
        $state = $customer->getState();
        $postalCode = $customer->getPostalCode();
        $isActive = $customer->getIsActive();
        
        include('edit_customer_form.php');
    }
}
else if ($action == 'save_customer') {
    $customer_id = filter_input(INPUT_POST, 'customerID', 
            FILTER_VALIDATE_INT);   
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $postalCode = filter_input(INPUT_POST, 'postalCode');
    $isActive = filter_input(INPUT_POST, 'isActive');
    
    $customer = new Customer();
        $customer->setFirstName($firstName);
        $customer->setLastName($lastName);
        $customer->setAddress($address);
        $customer->setCity($city);
        $customer->setState($state);
        $customer->setPostalCode($postalCode);
        $customer->setIsActive($isActive);
    if ($customer_id == NULL || $customer_id == FALSE ||
            $firstName == NULL || $firstName == FALSE ||
            $lastName == NULL || $lastName == FALSE ||
            $address == NULL || $address == FALSE ||
            $city == NULL || $city == FALSE ||
            $state == NULL || $state == FALSE ||
            $postalCode == NULL || $postalCode == FALSE) {
        $error = 'Missing or incorrect information.';
        include('../errors/error.php');
    } else {
        $customerDB->update_customer($customer);
        
        header('Location: .?action=list_customers');
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
    
    $customer = new Customer();
        $customer->setEmailAddress($email);
        $customer->setPassword($password);
        $customer->setFirstName($firstName);
        $customer->setLastName($lastName);
        $customer->setAddress($address);
        $customer->setCity($city);
        $customer->setState($state);
        $customer->setPostalCode($postalCode);
        $customer->setIsActive(true);
    
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
        $count = $customerDB->get_customer_count($email);
        
        if($count > 0)
        {
            $error = 'That email is already registered, please use a different one.';
            include('../errors/error.php');
        }
        else
        {
            $customerDB->add_customer($customer);
        }
        $ID = $customerDB->get_customerID($email, $password);
    
        header('Location: .?action=edit_customer&customerID='.$ID);
    }
}
if ($action == "login")
{
    include('login.php');
}
if ($action == "logout")
{
    session_destroy(); 
    $_SESSION['loginInfo'] = array();
    header('Location: .?action=login');
}
if ($action == 'login_process') 
{
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
//    $customer = new Customer();
//        $customer->setEmailAddress($email);
//        $customer->setPassword($password);
//    
if ($email == NULL || $email == FALSE || $email == '' ||
            $password == null || $password == false || $password == '') {
        $error = 'Invalid login';
        include('../errors/error.php');
    }
    $valid = $customerDB->get_valid_login($email, $password);
    if($valid == 0)
    {
        $error = 'Invalid login';
        include('../errors/error.php');
        return;
    }
    $customer = $customerDB->get_customer_by_login($email, $password);        

    // Get customer data
    $firstName = $customer->getFirstName();
    $lastName = $customer->getLastName();
    $id = $customer->getID();
    setcookie($username, $password);
    
    if($id == null || trim($id) == '')
    {
        $error = 'Invalid login';
        include('../errors/error.php');
        return;
    }
    else
    {
    $login = array(
        'id' => $id,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'userName' => $email,
        'pass' => $password,
        'message' => "Welcome: ".$firstName." ".$lastName
    );
    $_SESSION['loginInfo'][0] = $login;
    header('Location: .?action=edit_customer&customerID='.$id);
    }
} 
if ($action == 'home') {
    include('../index.php');
} 
?>