<?php

class WishList{
    
    private $id;
    private $userID;
    private $firstName;
    private $lastName;
    private $description;
    private $wishListItems = array();
    private $wishListItemCount;
    private $dateCreated;
    private $dateUpdated;
    private $isActive;
    
    function __construct($id, $userID, $firstName, $lastName, $description, $wishListItemCount, $dateCreated, $dateUpdated, $isActive) {
        $this->id = $id;
        $this->userID = $userID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->description = $description;
        $this->wishListItemCount = $wishListItemCount;
        $this->dateCreated = $dateCreated;
        $this->dateUpdated = $dateUpdated;
        $this->isActive = $isActive;
    }
    
    
    function getId() {
        return $this->id;
    }

    function getUserID() {
        return $this->userID;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }
    
    function getFullName() {
        return $this->firstName. ' ' . $this->lastName;
    }

    function getDescription() {
        return $this->description;
    }

    function getWishListItems() {
        return $this->wishListItems;
    }

    function getWishListItemCount() {
        return $this->wishListItemCount;
    }

    function getDateCreated() {
        return $this->dateCreated;
    }

    function getDateUpdated() {
        return $this->dateUpdated;
    }

    function getIsActive() {
        return $this->isActive;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setUserID($userID): void {
        $this->userID = $userID;
    }

    function setFirstName($firstName): void {
        $this->firstName = $firstName;
    }

    function setLastName($lastName): void {
        $this->lastName = $lastName;
    }

    function setDescription($description): void {
        $this->description = $description;
    }

    function setWishListItems($wishListItems): void {
        $this->wishListItems = $wishListItems;
    }

    function setWishListItemCount($wishListItemCount): void {
        $this->wishListItemCount = $wishListItemCount;
    }

    function setDateCreated($dateCreated): void {
        $this->dateCreated = $dateCreated;
    }

    function setDateUpdated($dateUpdated): void {
        $this->dateUpdated = $dateUpdated;
    }

    function setIsActive($isActive): void {
        $this->isActive = $isActive;
    }

    
}