<?php
        require_once('database.php');
        $email = filter_input(INPUT_POST, 'email');
	$password = filter_input(INPUT_POST, 'password');
        $error = '';
?>
<?php
if ($email == null || $email == false || $password == null || $password == false) {
    $error = "Invalid credentials. Check all fields and try again.";
    include('error.php');
}
else 
{
        $query2 = 'select count(ID) as valid 
          FROM customer 
          WHERE emailAddress = :emailAddress
          and password = :password';
        $statement2 = $db->prepare($query2);
        $statement2->bindValue(':emailAddress', $email);
        $statement2->bindValue(':password', $password);
        $statement2->execute();
        $loginCheck = $statement2->fetch();
        $statement2->closeCursor();
              
        $valid = $loginCheck['valid'];
        
    if ($valid == "0")
    {
        $error = "Invalid email or password, please try again.";
        include('login.php');
    }
    else 
    {
        // Display the successful login page
        $result = 'Login Successful ';
        include('login_success.php');
    }
}
?>