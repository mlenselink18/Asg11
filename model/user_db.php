<?php
class UserDB{
public function get_user_list($last_name) {
        $db = Database::getDB();
        $query = "SELECT * FROM wluser";
        if(trim($last_name) != "")        
        { $query.=" where lastName like '$last_name' order by ID asc"; }
        $result = $db->query($query);
        $users = array();
        foreach ($result as $row) {
            $user = new User(); $user->setID($row['ID']);
            $user->setFirstName($row['firstName']); $user->setLastName($row['lastName']);
            $user->setRole($row['wlUserRoleID']); $user->setEmailAddress($row['email']);
            $user->setAddress($row['address']); $user->setCity($row['city']);
            $user->setState($row['st']);
            $user->setPostalCode($row['zip']);
            $user->setPhone($row['phone']);
            $user->setIsActive($row['isActive']);
            $user->setDateCreated($row['dateCreated']);
            $user->setDateUpdated($row['dateUpdated']);
            $users[] = $user;
        }
        return $users;
    }

public function get_user_by_id($userID) {
        $db = Database::getDB();
        $query = "SELECT * FROM wluser WHERE ID = '$userID'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $user = new User();
        $user->setID($row['ID']);
        $user->setFirstName($row['firstName']);
        $user->setLastName($row['lastName']);
        $user->setRole($row['wlUserRoleID']);
        $user->setEmailAddress($row['email']);
        $user->setAddress($row['address']);
        $user->setCity($row['city']);
        $user->setState($row['st']);
        $user->setPostalCode($row['zip']);
        $user->setPhone($row['phone']);
        $user->setIsActive($row['isActive']);
        $user->setDateCreated($row['dateCreated']);
        $user->setDateUpdated($row['dateUpdated']);
        return $user;
    }
    
    public function get_user_by_login($email, $password) {
        $db = Database::getDB();
        $query = "SELECT * FROM wluser "
                . "WHERE email = '$email' and password = '$password'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $user = new User();
        $user->setID($row['ID']);
        $user->setFirstName($row['firstName']);
        $user->setLastName($row['lastName']);
        $user->setRole($row['wlUserRoleID']);
        $user->setEmailAddress($row['email']);
        $user->setAddress($row['address']);
        $user->setCity($row['city']);
        $user->setState($row['st']);
        $user->setPostalCode($row['zip']);
        $user->setPhone($row['phone']);
        $user->setIsActive($row['isActive']);
        $user->setDateCreated($row['dateCreated']);
        $user->setDateUpdated($row['dateUpdated']);
        return $user;
    }

public function get_user_count($email) {
//        $email = $customer->getEmailAddress();
        $db = Database::getDB();
        $query = "select count(ID) as count FROM wluser 
                WHERE email = '$email'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $count = $row['count'];

        return $count;
    }

public function get_valid_login($email, $password) {
        $db = Database::getDB();
//        $email = $customer->getEmailAddress();
//        $password = $customer->getPassword();
        $query = "select count(ID) as valid 
          FROM wluser 
          WHERE email = '$email' 
          and password = '$password'";
        $statement = $db->query($query);
        $row = $statement->fetch();
//        $valid = false;
        $valid = $row['valid'];

        return $valid;
    }

public function get_userID($email, $password) {
    $db = Database::getDB();
//        $email = $customer->getEmailAddress();
//        $password = $customer->getPassword();
        $query = "select ID 
          FROM wluser 
          WHERE email = '$email' 
          and password = '$password'";
        $statement = $db->query($query);
        $row = $statement->fetch();
//        $ID = 0;
        $ID = $row['ID'];
              
    return $ID;
}

public function add_user($user) {
    $db = Database::getDB();

    $emailAddress = $user->getEmailAddress();
    $password = $user->getPassword();
    $firstName = $user->getFirstName();
    $lastName = $user->getLastName();
    $address = $user->getAddress();
    $city = $user->getCity();
    $state = $user->getState();
    $postalCode = $user->getPostalCode();
    $phone = $user->getPhone();
    $isActive = $user->getIsActive();
    $date = date('Y-m-d H:i:s');

    $query =
        "INSERT INTO wluser (email, password, firstName, lastName, address, city, st, zip, phone, isActive, wlUserRoleID, dateCreated, dateUpdated) "
            . "VALUES ('$emailAddress', '$password', '$firstName', '$lastName', '$address', '$city', "
            . "'$state', '$postalCode', '$phone', '$isActive', '1', '1', '$date')";

    $row_count = $db->exec($query);
    return $row_count;
}

public function update_user($user) {
    $db = Database::getDB();

    $ID = $user->getID();
    $firstName = $user->getFirstName();
    $lastName = $user->getLastName();
    $address = $user->getAddress();
    $city = $user->getCity();
    $state = $user->getState();
    $postalCode = $user->getPostalCode();
    $phone = $user->getPhone();
    $isActive = $user->getIsActive();
    $date = date('Y-m-d H:i:s');

    $query =
        "Update wluser SET firstName = '$firstName', lastName = '$lastName', address = '$address', city = '$city', "
            . "st = '$state', phone = '$phone', zip = '$postalCode', isActive = '$isActive', dateUpdated = '$date' "
            . "WHERE ID = $ID";

    $row_count = $db->exec($query);
    return $row_count;
}
}
?>
