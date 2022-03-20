<?php

class Store{
    
    private $id;
    private $name;
    private $isActive;
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getIsActive() {
        return $this->isActive;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setIsActive($isActive): void {
        $this->isActive = $isActive;
    }
    
}
?>