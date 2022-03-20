<?php
//user index
if (session_id() == '') {
$lifetime = 60 * 60 * 24 * 14; 
        // 2 weeks in seconds 
        session_set_cookie_params($lifetime, '/'); 
        session_start(); 
}
require('../model/database.php');
require('../model/user_db.php');
require('../model/user.php');

$userDB = new UserDB(); 
if (isset($_SESSION['loginInfo'])) {
    $loginInfo = $_SESSION['loginInfo'];
} else {
    $loginInfo = array();
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_users';
    }
}  
if ($action == 'list_users') {
    $last_name = filter_input(INPUT_GET, 'last_name');

    $users = $userDB->get_user_list($last_name);
    include('user_list.php');
} 
else if ($action == 'edit_user') {
    $user_id = filter_input(INPUT_GET, 'userID', 
            FILTER_VALIDATE_INT);   
    if ($user_id == NULL || $user_id == FALSE) {
        $error = 'Missing or incorrect user id.';
        include('../errors/error.php');
    } else {
        $user = $userDB->get_user_by_id($user_id);

        // Get user data
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $address = $user->getAddress();
        $city = $user->getCity();
        $state = $user->getState();
        $postalCode = $user->getPostalCode();
        $isActive = $user->getIsActive();
        
        include('edit_user_form.php');
    }
}
else if ($action == 'save_user') {
    $user_id = filter_input(INPUT_POST, 'userID', 
            FILTER_VALIDATE_INT);   
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $postalCode = filter_input(INPUT_POST, 'postalCode');
    $isActive = filter_input(INPUT_POST, 'isActive');
    $phone = preg_replace('/\D+/', '', filter_input(INPUT_POST, 'phone'));
    
    $user = new User();
    $user->setID($user_id);
    $user->setFirstName($firstName);
    $user->setLastName($lastName);
    $user->setAddress($address);
    $user->setCity($city);
    $user->setState($state);
    $user->setPostalCode($postalCode);
    $user->setPhone($phone);
    $user->setIsActive($isActive);
    if ($user_id == NULL || $user_id == FALSE ||
            $firstName == NULL || $firstName == FALSE ||
            $lastName == NULL || $lastName == FALSE ||
            $address == NULL || $address == FALSE ||
            $city == NULL || $city == FALSE ||
            $state == NULL || $state == FALSE ||
            $postalCode == NULL || $postalCode == FALSE) {
        $error = 'Missing or incorrect information.';
        include('../errors/error.php');
        return;
    } else {
        $userDB->update_user($user);
        
        $roleID = 0;

       if(isset($_SESSION['loginInfo']))
        {
            foreach ($_SESSION['loginInfo'] as $item)
            {
                $roleID = $item['role'];
            }           
        }
        if($roleID == '2')
        {header('Location: .?action=list_users');}
        else
        {
            include('../index.php');
        }
    }
}
else if ($action == 'register') 
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
    $phone = preg_replace('/\D+/', '', filter_input(INPUT_POST, 'phone'));
    
    $user = new User();
    $user->setEmailAddress($email);
    $user->setPassword($password);
    $user->setFirstName($firstName);
    $user->setLastName($lastName);
    $user->setAddress($address);
    $user->setCity($city);
    $user->setState($state);
    $user->setPostalCode($postalCode);
    $user->setPhone($phone);
    $user->setIsActive(true);
    
    if ($firstName == NULL || $firstName == "" ||
            $lastName == NULL || $lastName == "" ||
            $address == NULL || $address == "" ||
            $city == NULL || $city == "" ||
            $state == NULL || $state == "" ||
            $postalCode == NULL || $postalCode == "" ||
            $phone == null || $phone == "" ||
            $email == null || $email == "" ||
            $password == null || $password == "") 
    {
        $error = 'Missing or incorrect information.';
        include('../errors/error.php');
        return;
    } 
    else 
    {
        $count = $userDB->get_user_count($email);
        
        if($count > 0)
        {
            $error = 'That email is already registered, please use a different one.';
            include('../errors/error.php');
            return;
        }
        else
        {
            $userDB->add_user($user);
        }
        $ID = $userDB->get_userID($email, $password);
    
        $roleID = 0;

       if(isset($_SESSION['loginInfo']))
        {
            foreach ($_SESSION['loginInfo'] as $item)
            {
                $roleID = $item['role'];
            }           
        }
        if($roleID == '2')
        {header('Location: .?action=edit_user&userID='.$ID);}
        else
        {
            header('Location: .?action=login_process&email='.$email.'&password='.$password);
        }
    }
}
else if ($action == "login")
{
    include('login.php');
}
else if ($action == "logout")
{
    session_destroy(); 
    $_SESSION['loginInfo'] = array();
    header('Location: .?action=login');
}
else if ($action == 'login_process') 
{
    $email = filter_input(INPUT_GET, 'email');
    $password = filter_input(INPUT_GET, 'password');
  
    if ($email == NULL || $email == FALSE || $email == '' ||
            $password == null || $password == false || $password == '') {
        $error = 'Invalid login';
        include('../errors/error.php');
    }
    $valid = $userDB->get_valid_login($email, $password);
    if($valid == 0)
    {
        $error = 'Invalid login';
        include('../errors/error.php');
        return;
    }
    $user = $userDB->get_user_by_login($email, $password);        

    // Get customer data
    $firstName = $user->getFirstName();
    $lastName = $user->getLastName();
    $role = $user->getRole();
    $id = $user->getID();
    setcookie($email, $password);
    
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
        'role' => $role,
        'message' => "Welcome: ".$firstName." ".$lastName
    );
    $_SESSION['loginInfo'][0] = $login;
    header('Location: .?action=edit_user&userID='.$id);
    }
} 
else if ($action == 'home') {
    include('../index.php');
} 
?>