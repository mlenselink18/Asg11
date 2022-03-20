<?php

class Customer {
    private $customerID;
    private $password;
    private $emailAddress;
    private $firstName;
    private $lastName;
    private $address;
    private $city;
    private $state;
    private $postalCode;
    private $isActive;
    

    public function __construct() {
        $this->customerID = 0;
        $this->password = '';
        $this->emailAddress = '';
        $this->firstName = '';
        $this->lastName = '';
        $this->address = '';
        $this->city = '';
        $this->state = '';
        $this->postalCode = '';
        $this->isActive = true;
    }

    public function getID() {
        return $this->customerID;
    }

    public function setID($value) {
        $this->customerID = $value;
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
        return $this->state;
    }

    public function setState($value) {
        $this->state = $value;
    }
    
    public function getPostalCode() {
        return $this->postalCode;
    }

    public function setPostalCode($value) {
        $this->postalCode = $value;
    }
    
    public function getIsActive() {
        return $this->isActive;
    }

    public function setIsActive($value) {
        $this->isActive = $value;
    }
}
?>