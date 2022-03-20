<?php
class StoreDB{
    
public function get_store_list() {
    $db = Database::getDB();
    $query = "SELECT * FROM store where isActive = 1" ;
    $result = $db->query($query);
    $stores = array();
    foreach ($result as $row) {
        $store = new Store(); 
        $store->setId($row['ID']);
        $store->setName($row['name']);
        $store->setIsActive($row['isActive']);
        $stores[] = $store;
    }
    return $stores;
}

public function get_all_stores() {
    $db = Database::getDB();
    $query = "SELECT * FROM store" ;
    $result = $db->query($query);
    $stores = array();
    foreach ($result as $row) {
        $store = new Store(); 
        $store->setId($row['ID']);
        $store->setName($row['name']);
        $store->setIsActive($row['isActive']);
        $stores[] = $store;
    }
    return $stores;
}

public function get_store_by_id($id) {
    $db = Database::getDB();
    $query = "SELECT * FROM store where ID = '$id'" ;
    $statement = $db->query($query);
    $row = $statement->fetch();
    $store = new Store(); 
    $store->setId($row['ID']);
    $store->setName($row['name']);
    $store->setIsActive($row['isActive']);
    
    return $store;
}

public function addStore($name, $isActive) {
    $db = Database::getDB();

    $query =
        "INSERT INTO store (name, isActive) VALUES ('$name', '$isActive')";

    $row_count = $db->exec($query);
    return $row_count;
}

public function deleteStore($id) {
    $db = Database::getDB();

    $query =
        "Update store SET isActive = '0' WHERE ID = $id";

    $row_count = $db->exec($query);
    return $row_count;
}

public function updateStore($name, $isActive, $id) {
    $db = Database::getDB();

    $query =
        "Update store SET name = '$name', isActive = '$isActive' WHERE ID = $id";

    $row_count = $db->exec($query);
    return $row_count;
}

}