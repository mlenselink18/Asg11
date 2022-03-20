<?php
class WishListItem {
    
    private $id;
    private $wishListID;
    private $description;
    private $quantity;
    private $storeID;
    private $storeName;
    private $notes;
    private $fulfilledByID;
    private $fulfilledByName;
    private $dateCreated;
    private $dateUpdated;
    private $isActive;
    
    function __construct($id, $wishListID, $description, $quantity, $storeID, $storeName, $notes, $fulfilledByID, $fulfilledByName, $dateCreated, $dateUpdated, $isActive) {
        $this->id = $id;
        $this->wishListID = $wishListID;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->storeID = $storeID;
        $this->storeName = $storeName;
        $this->notes = $notes;
        $this->fulfilledByID = $fulfilledByID;
        $this->fulfilledByName = $fulfilledByName;
        $this->dateCreated = $dateCreated;
        $this->dateUpdated = $dateUpdated;
        $this->isActive = $isActive;
    }
    
    function getId() {
        return $this->id;
    }

    function getWishListID() {
        return $this->wishListID;
    }

    function getDescription() {
        return $this->description;
    }
    
    function getQuantity() {
        return $this->quantity;
    }

    function getStoreID() {
        return $this->storeID;
    }

    function getStoreName() {
        return $this->storeName;
    }

    function getNotes() {
        return $this->notes;
    }

    function getFulfilledByID() {
        return $this->fulfilledByID;
    }

    function getFulfilledByName() {
        return $this->fulfilledByName;
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

    function setWishListID($wishListID): void {
        $this->wishListID = $wishListID;
    }

    function setDescription($description): void {
        $this->description = $description;
    }
    
    function setQuantity($quantity): void {
        $this->quantity = $quantity;
    }

    function setStoreID($storeID): void {
        $this->storeID = $storeID;
    }

    function setStoreName($storeName): void {
        $this->storeName = $storeName;
    }

    function setNotes($notes): void {
        $this->notes = $notes;
    }

    function setFulfilledByID($fulfilledByID): void {
        $this->fulfilledByID = $fulfilledByID;
    }

    function setFulfilledByName($fulfilledByName): void {
        $this->fulfilledByName = $fulfilledByName;
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