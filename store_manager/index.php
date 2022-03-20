<?php
//store index
if (session_id() == '') {
$lifetime = 60 * 60 * 24 * 14; 
        // 2 weeks in seconds 
        session_set_cookie_params($lifetime, '/'); 
        session_start(); 
}

require('../model/database.php');
require('../model/store.php');
require('../model/store_db.php');

if (isset($_SESSION['loginInfo'])) {
    $loginInfo = $_SESSION['loginInfo'];
}

$StoreDB = new StoreDB();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_stores';
    }
}  
if ($action == 'list_stores') {
    $Stores = $StoreDB->get_all_stores();
    include('store_list.php');
} 
else if ($action == 'add_store')
{
    $store = new Store();
    include('store_edit_form.php');
}
else if ($action == 'edit_store')
{
    $storeID = filter_input(INPUT_GET, 'storeID');
    if ($storeID == NULL || $storeID == FALSE) {
        $error = 'Missing or incorrect store id.';
        include('../errors/error.php');
        return;
    }
    $store = $StoreDB->get_store_by_id($storeID);
    include('store_edit_form.php');
}
else if ($action == 'delete_store')
{
    $storeID = filter_input(INPUT_POST, 'storeID');
    if ($storeID == NULL || $storeID == FALSE) {
        $error = 'Missing or incorrect store id.';
        include('../errors/error.php');
        return;
    }
    else 
    {

        $StoreDB->deleteStore($storeID);
        
        header('Location: .?action=list_stores');
    }
}
else if ($action == 'save_store')
{
    $storeID = filter_input(INPUT_POST, 'storeID');
    $name = filter_input(INPUT_POST, 'name');
    $isActive = filter_input(INPUT_POST, 'isActive');
    if ($storeID == NULL || $storeID == FALSE ||
            $name == NULL || $name == FALSE) {
        $error = 'Missing or incorrect items.';
        include('../errors/error.php');
        return;
    }
    else 
    {

        $StoreDB->updateStore($name, $isActive, $storeID);
        
        header('Location: .?action=list_stores');
    }
}
else if ($action == 'insert_store')
{
    $name = filter_input(INPUT_POST, 'name');
    $isActive = filter_input(INPUT_POST, 'isActive');
    if ($name == NULL || $name == FALSE) {
        $error = 'Missing or incorrect items.';
        include('../errors/error.php');
        return;
    }
    else 
    {

        $StoreDB->addStore($name, $isActive);
        
        header('Location: .?action=list_stores');
    }
}
if ($action == 'home') {
    include('../index.php');
} 