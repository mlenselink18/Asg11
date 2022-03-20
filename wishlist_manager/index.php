<?php
if (session_id() == '') {
$lifetime = 60 * 60 * 24 * 14; 
        // 2 weeks in seconds 
        session_set_cookie_params($lifetime, '/'); 
        session_start(); 
}
//wishlist index
require('../model/database.php');
require('../model/wishlist_db.php');
require('../model/wishlist.php');
require('../model/wishlist_item.php');
require('../model/store.php');
require('../model/store_db.php');
require('../model/user_db.php');

if (isset($_SESSION['loginInfo'])) {
    $loginInfo = $_SESSION['loginInfo'];
}

$WishListDB = new WishListDB();
$StoreDB = new StoreDB();
$UserDB = new UserDB();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_wishlists';
    }
}  
if ($action == 'list_wishlists') {
    $last_name = filter_input(INPUT_GET, 'last_name');
//    if ($last_name == NULL || $last_name == FALSE) {
//        $last_name = "";
//    }
    $WishLists = $WishListDB->getWishAllWishLists($last_name);
    include('wishlist_list.php');
} 
else if ($action == 'edit_wishlist') {
    $wishlistID = filter_input(INPUT_GET, 'wishlistID', 
            FILTER_VALIDATE_INT);   
    if ($wishlistID == NULL || $wishlistID == FALSE) 
    {
        $error = 'Missing or incorrect wishlist id.';
        include('../errors/error.php');
        return;
    } 
    else 
    {
        $wishlist = $WishListDB->getWishListByID($wishlistID);

        // Get wishlist data
        $id = $wishlist->getId();
        $userID = $wishlist->getUserID();
        $firstName = $wishlist->getFirstName();
        $lastName = $wishlist->getLastName();
        $description = $wishlist->getDescription();
        $wishListItemCount = $wishlist->getWishListItemCount();
        $dateCreated = $wishlist->getDateCreated();
        $dateUpdated = $wishlist->getDateUpdated();
        $isActive = $wishlist->getIsActive();
        
        $wishListItems = $wishlist->getWishListItems();
        
        $stores = $StoreDB->get_store_list();
        
        include('wishlist_edit.php');
    }
}
else if ($action == 'view_wishlist') {
    $wishlistID = filter_input(INPUT_GET, 'wishlistID', 
            FILTER_VALIDATE_INT);   
    if ($wishlistID == NULL || $wishlistID == FALSE) 
    {
        $error = 'Missing or incorrect wishlist id.';
        include('../errors/error.php');
        return;
    } 
    else 
    {
        $wishlist = $WishListDB->getWishListByID($wishlistID);

        // Get wishlist data
        $id = $wishlist->getId();
        $userID = $wishlist->getUserID();
        $firstName = $wishlist->getFirstName();
        $lastName = $wishlist->getLastName();
        $description = $wishlist->getDescription();
        $wishListItemCount = $wishlist->getWishListItemCount();
        $dateCreated = $wishlist->getDateCreated();
        $dateUpdated = $wishlist->getDateUpdated();
        $isActive = $wishlist->getIsActive();
        
        $wishListItems = $wishlist->getWishListItems();
        
        include('wishListItems_list.php');
    }
}
else if ($action == 'fulfill'){
    $wishlistItemID = filter_input(INPUT_GET, 'wishlistItemID', 
            FILTER_VALIDATE_INT);   
    $wishlistID = filter_input(INPUT_GET, 'wishlistID', 
            FILTER_VALIDATE_INT); 
    if ($wishlistItemID == NULL || $wishlistItemID == FALSE ||
            $wishlistID == null || $wishlistID == false) {
        $error = 'Missing or incorrect item id.';
        include('../errors/error.php');
    } 
    else 
    {
        $currentUserID= '';
        foreach ($_SESSION['loginInfo'] as $key => $item)
        {
            $userid = $item['id'];
        }
        $WishListDB->fulfillWishListItems($wishlistItemID, $userid);
        
        header('Location: .?action=view_wishlist&wishlistID='.$wishlistID);
    }
}
else if ($action == 'saveItem'){
    $wishlistItemID = filter_input(INPUT_POST, 'wishlistItemID', 
            FILTER_VALIDATE_INT);   
    $description= filter_input(INPUT_POST, 'taDescription');   
    $storeID = filter_input(INPUT_POST, 'selectStore');
    $quantity = filter_input(INPUT_POST, 'quantity', 
            FILTER_VALIDATE_INT);
    $notes = filter_input(INPUT_POST, 'taNotes');
    if ($wishlistItemID == NULL || $wishlistItemID == FALSE  ||
            $description == NULL || $description == FALSE  ||
            $storeID == NULL || $storeID == FALSE  ||
            $quantity == NULL || $quantity == FALSE) 
            {
        $error = 'Missing or incorrect item id.';
        include('../errors/error.php');
    } 
    else 
    {
        $wishlistItem = new WishListItem(null, null, null, null, null, null, null, null, null, null, null, null);
        
        $wishlistItem->setDescription($description);
        $wishlistItem->setStoreID($storeID);
        $wishlistItem->setQuantity($quantity);
        $wishlistItem->setNotes($notes);
        
        $WishListDB->updateWishListItem($wishlistItem);
        
        header('Location: .?action=edit_wishlist&wishlistID='.$wishlistID);
    }
}
else if ($action == 'deleteItem'){
    $wishlistItemID = filter_input(INPUT_POST, 'wishlistItemID', 
            FILTER_VALIDATE_INT);    
    if ($wishlistItemID == NULL || $wishlistItemID == FALSE) 
    {
        $error = 'Missing or incorrect item id.';
        include('../errors/error.php');
    } 
    else 
    {

        $WishListDB->deleteWishListItem($wishlistItemID);
        
        header('Location: .?action=view_wishlist&wishlistID='.$wishlistID);
    }
}
else if ($action == 'addItem'){
    $wishlistID = filter_input(INPUT_POST, 'WishListID', 
            FILTER_VALIDATE_INT); 
    $description= filter_input(INPUT_POST, 'taDescription');   
    $storeID = filter_input(INPUT_POST, 'selectStore');
    $quantity = filter_input(INPUT_POST, 'quantity');
    $notes = filter_input(INPUT_POST, 'taNotes');
    if ($wishlistID == null || $wishlistID == false || $wishlistID == 0  ||
            $description == NULL || $description == FALSE  ||
            $storeID == NULL || $storeID == FALSE  ||
            $quantity == NULL || $quantity == FALSE) 
    {
        $error = 'Missing or incorrect wishlist id.';
        include('../errors/error.php');
    } 
    else 
    {
        $wishlistItem = new WishListItem(null, null, null, null, null, null, null, null, null, null, null, null);
        
        $wishlistItem->setDescription($description);
        $wishlistItem->setStoreID($storeID);
        $wishlistItem->setQuantity($quantity);
        $wishlistItem->setNotes($notes);
        $wishlistItem->setWishListID($wishlistID);
        
        $WishListDB->addWishListItem($wishlistItem);
        
        header('Location: .?action=edit_wishlist&wishlistID='.$wishlistID);
    }
}
else if ($action == 'updateWishList'){
    $wishlistID = filter_input(INPUT_POST, 'wishlistID', 
            FILTER_VALIDATE_INT);   
    $description = filter_input(INPUT_POST, 'taDescription');

    if ($wishlistID == NULL || $wishlistID == FALSE  ||
            $description == NULL || $description == FALSE) 
            {
        $error = 'Missing or incorrect items.';
        include('../errors/error.php');
    } 
    else 
    {
        $wishlist = new WishList(null, null, null, null, null, null, null, null, null, null);
        
        $wishlist->setDescription($description);
        $wishlist->setId($wishlistID);
        
        $WishListDB->updateWishList($wishlist);
        
        header('Location: .?action=edit_wishlist&wishlistID='.$wishlistID);
    }
}
else if ($action == 'add_wishlist'){
    $description = str_replace("'", "''", filter_input(INPUT_POST, 'wlDescription'));
    $userID = filter_input(INPUT_POST, 'userID', 
            FILTER_VALIDATE_INT);   
    
if ($userID == NULL || $userID == FALSE ||
        $description == null || $description == FALSE || trim($description) == '') 
    {
        $error = 'Please add a list title';
        include('../errors/error.php');
    } 
    else 
    {
        $wishlistID = $WishListDB->addWishList($userID, $description);
        $wishlist = $WishListDB->getWishListByID($wishlistID);
        header('Location: .?action=list_wishlists');
    }
}
else if ($action == 'deleteWishlist'){
    $wishlistID = filter_input(INPUT_POST, 'deleteID', 
            FILTER_VALIDATE_INT);   

    if ($wishlistID == NULL || $wishlistID == FALSE) 
            {
        $error = 'Missing or incorrect items.';
        include('../errors/error.php');
    } 
    else 
    {        
        $WishListDB->deleteWishList($wishlistID);
        
        header('Location: .?action=list_wishlists');
    }
}
else if ($action == 'home') {
    include('../index.php');
} 
?>