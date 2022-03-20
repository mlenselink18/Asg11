<?php
class CustomerDB{
public function get_customer_list($last_name) {
        $db = Database::getDB();
        $query = "SELECT * FROM customer" ;
        if($last_name != '')        
        { $query." where lastName like '$last_name' order by ID asc"; }
        $result = $db->query($query);
        $customers = array();
        foreach ($result as $row) {
            $customer = new Customer();
            $customer->setID($row['ID']);
            $customer->setFirstName($row['firstName']);
            $customer->setLastName($row['lastName']);
            $customer->setEmailAddress($row['emailAddress']);
            $customer->setAddress($row['address']);
            $customer->setCity($row['city']);
            $customer->setState($row['state']);
            $customer->setPostalCode($row['postalCode']);
            $customer->setIsActive($row['isActive']);
            $customers[] = $customer;
        }
        return $customers;
    }

public function get_customer_by_id($customerID) {
        $db = Database::getDB();
        $query = "SELECT * FROM customer WHERE ID = '$customerID'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $customer = new Customer();
        $customer->setID($row['ID']);
        $customer->setFirstName($row['firstName']);
        $customer->setLastName($row['lastName']);
        $customer->setEmailAddress($row['emailAddress']);
        $customer->setAddress($row['address']);
        $customer->setCity($row['city']);
        $customer->setState($row['state']);
        $customer->setPostalCode($row['postalCode']);
        $customer->setIsActive($row['isActive']);
        return $customer;
    }
    
    public function get_customer_by_login($email, $password) {
        $db = Database::getDB();
        $query = "SELECT * FROM customer "
                . "WHERE emailAddress = '$email' 
                    and password = '$password'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $customer = new Customer();
        $customer->setID($row['ID']);
        $customer->setFirstName($row['firstName']);
        $customer->setLastName($row['lastName']);
        $customer->setEmailAddress($row['emailAddress']);
        $customer->setAddress($row['address']);
        $customer->setCity($row['city']);
        $customer->setState($row['state']);
        $customer->setPostalCode($row['postalCode']);
        $customer->setIsActive($row['isActive']);
        return $customer;
    }

public function get_customer_count($email) {
//        $email = $customer->getEmailAddress();
        $db = Database::getDB();
        $query = "select count(ID) as count FROM customer 
                WHERE emailAddress = '$email'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $count = 0;
        $count = $row['count'];

        return $count;
    }

public function get_valid_login($email, $password) {
        $db = Database::getDB();
//        $email = $customer->getEmailAddress();
//        $password = $customer->getPassword();
        $query = "select count(ID) as valid 
          FROM customer 
          WHERE emailAddress = '$email' 
          and password = '$password'";
        $statement = $db->query($query);
        $row = $statement->fetch();
//        $valid = false;
        $valid = $row['valid'];

        return $valid;
    }

public function get_customerID($email, $password) {
    $db = Database::getDB();
//        $email = $customer->getEmailAddress();
//        $password = $customer->getPassword();
        $query = "select ID 
          FROM customer 
          WHERE emailAddress = '$email' 
          and password = '$password'";
        $statement = $db->query($query);
        $row = $statement->fetch();
//        $ID = 0;
        $ID = $row['ID'];
              
    return $ID;
}

    public function add_customer($customer) {
        $db = Database::getDB();

        $emailAddress = $customer->getEmailAddress();
        $password = $customer->getPassword();
        $firstName = $customer->getFirstName();
        $lastName = $customer->getLastName();
        $address = $customer->getAddress();
        $city = $customer->getCity();
        $state = $customer->getState();
        $postalCode = $customer->getPostalCode();
        $isActive = $customer->getIsActive();

        $query =
            "INSERT INTO customer
                 (emailAddress, password, firstName, lastName, address, city, state, postalCode, isActive)
             VALUES
                 ('$emailAddress', '$password', '$firstName', '$lastName', '$address', '$city', '$state', '$postalCode', '$isActive')";

        $row_count = $db->exec($query);
        return $row_count;
    }
    
    public function update_customer($customer) {
        $db = Database::getDB();

        $ID = $customer->getID();
        $firstName = $customer->getFirstName();
        $lastName = $customer->getLastName();
        $address = $customer->getAddress();
        $city = $customer->getCity();
        $state = $customer->getState();
        $postalCode = $customer->getPostalCode();
        $isActive = $customer->getIsActive();

        $query =
            "Update customer 
                SET firstName = '$firstName', 
                    lastName = '$lastName', 
                    address = '$address', 
                    city = '$city', 
                    state = :'$state', 
                    postalCode = '$postalCode',  
                    isActive = '$isActive' WHERE ID = '$ID'";

        $row_count = $db->exec($query);
        return $row_count;
    }
}
?>