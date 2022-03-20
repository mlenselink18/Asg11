<?php

class User {
    private $ID;
    private $wlUserRoleID;
    private $password;
    private $emailAddress;
    private $firstName;
    private $lastName;
    private $address;
    private $city;
    private $st;
    private $zip;
    private $phone;
    private $isActive;
    private $dateCreated;
    private $dateUpdated;
    

    public function __construct() {
        $this->ID = 0;
        $this->wlUserRoleID = 1;
        $this->password = '';
        $this->emailAddress = '';
        $this->firstName = '';
        $this->lastName = '';
        $this->address = '';
        $this->city = '';
        $this->st = '';
        $this->zip = '';
        $this->phone = '';
        $this->isActive = true;
        $this->dateCreated = '';
        $this->dateUpdated = '';
    }

    public function getID() {
        return $this->ID;
    }

    public function setID($value) {
        $this->ID = $value;
    }
    
    public function getRole() {
        return $this->wlUserRoleID;
    }

    public function setRole($value) {
        $this->wlUserRoleID = $value;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($value) {
        $this->password = $value;
    }
    
    public function getEmailAddress() {
        return $this->emailAddress;
    }

    public function setEmailAddress($value) {
        $this->emailAddress = $value;
    }

    public function getFirstName() {
        return $this->name;
    }

    public function setFirstName($value) {
        $this->name = $value;
    }
    
    public function getLastName() {
        return $this->lastName;
    }
    
    function getFullName() {
        return $this->firstName. ' ' . $this->lastName;
    }

    public function setLastName($value) {
        $this->lastName = $value;
    }
    
    public function getAddress() {
        return $this->address;
    }

    public function setAddress($value) {
        $this->address = $value;
    }
    
    public function getCity() {
        return $this->city;
    }

    public function setCity($value) {
        $this->city = $value;
    }
    
    public function getState() {
        return $this->st;
    }

    public function setState($value) {
        $this->st = $value;
    }
    
    public function getPostalCode() {
        return $this->zip;
    }

    public function setPostalCode($value) {
        $this->zip = $value;
    }
    
    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($value) {
        $this->phone = $value;
    }
    
    public function getIsActive() {
        return $this->isActive;
    }

    public function setIsActive($value) {
        $this->isActive = $value;
    }
    
    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function setDateCreated($value) {
        $this->dateCreated = $value;
    }
    
    public function getDateUpdated() {
        return $this->dateUpdated;
    }

    public function setDateUpdated($value) {
        $this->dateUpdated = $value;
    }
}
?>