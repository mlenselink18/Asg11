<?php
        require_once('database.php');
        $first_name = filter_input(INPUT_POST, 'first_name');
	$last_name = filter_input(INPUT_POST, 'last_name');
        $email = filter_input(INPUT_POST, 'email');
	$password = filter_input(INPUT_POST, 'password');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $postalCode = filter_input(INPUT_POST, 'postalCode', FILTER_VALIDATE_INT);   
        $error = '';
?>
<?php
if ($first_name == null || $first_name == false || $last_name == null || $last_name == false ||
        $email == null || $email == false || $password == null || $password == false ||
        $address == null || $address == false || $city == null || $city == false ||
        $state == null || $state == false || $postalCode == null || $postalCode == false) {
    $error = "Invalid data. Check all fields and try again.";
    include('register.php');
}
else 
{
    $query2 = 'select count(ID) as count 
          FROM customer 
          WHERE emailAddress = :emailAddress';
        $statement2 = $db->prepare($query2);
        $statement2->bindValue(':emailAddress', $email);
        $statement2->execute();
        $emailCheck = $statement2->fetch();
        $statement2->closeCursor();
        
        
        $count = $emailCheck['count'];
    
    if ($count != "0")
    {
        $error = "That email is already registered, please use a different one.";
        include('error.php');
    }
    else {
        // Add the customer to the database  
        $query = 'insert into customer 
                    (emailAddress, password, firstName, lastName, address, city, state, postalCode, isActive)
                    VALUES(:emailAddress, :password, :firstName, :lastName, :address, :city, :state, :postalCode, 1)';
        $statement = $db->prepare($query);
        $statement->bindValue(':emailAddress', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':firstName', $first_name);
        $statement->bindValue(':lastName', $last_name);
        $statement->bindValue(':address', $address);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':postalCode', $postalCode);
        $statement->execute();
        $statement->closeCursor();

        // Display the successful registration page
        include('register_success.php');
    }
}
?>