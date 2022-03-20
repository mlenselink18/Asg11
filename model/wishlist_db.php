<?php
class WishListDB{
     // Get an array of wishListItems for a WishList  
 private static function getWishListItemsForWishList($wishListID)
 {
    //$db= new Database();
    $db= Database::getDB();
    $query =  'SELECT wi.ID, wi.wishListID, wi.description, wi.quantity, wi.storeID, 
          s.name as "storeName", wi.notes,  wi.fulfilledByID, 
          concat(u.firstName, " ", u.lastName) as "fulfilledByName", wi.isActive, wi.dateCreated, wi.dateUpdated
         FROM wishlistitem wi
         left join store s on wi.storeID = s.ID
         left join wluser u on wi.fulfilledByID = u.ID WHERE wi.wishListID = :wishListID';
     $statement = $db->prepare($query);
     $statement-> bindvalue(':wishListID', $wishListID); 
     $statement->execute();
     $wishListItems = array();

     foreach ($statement as $row) {
             $wishListItem  = new WishListItem($row['ID'], $row['wishListID'], $row['description'],
                     $row['quantity'], $row['storeID'], $row['storeName'], $row['notes'],
                     $row['fulfilledByID'], $row['fulfilledByName'], 
                     $row['dateCreated'], $row['dateUpdated'], $row['isActive']);

         $wishListItems[]= $wishListItem;
     }
     return $wishListItems;    
}  



// Might return mutliple WishLists
public static function getWishListsForUser($userID)
{
    //$db= new Database();
    $db= Database::getDB();

    $query = 'SELECT w.ID, w.wlUserID,. u.firstName, u.lastName, w.description, w.isActive, w.dateCreated, w.dateUpdated,  count(wi.wishListID) as "wishListItemCount"
          from wishlist w left join wishlistitem wi on w.id = wi.wishListID
          join wlUser u on w.wlUserID = u.IDwhere   w.isActive = :isActive and w.wlUserID = :userID 
          group by  w.ID, w.wlUserID,. u.firstName, u.lastName, w.description, w.isActive, w.dateCreated, w.dateUpdated';
     $statement = $db->prepare($query);
     $statement-> bindvalue(':userID', $userID);
     $statement-> bindvalue(':isActive', 1); // Hard code to 1 for now
     $statement->execute();
     $wishLists=array();

     foreach ($statement as $row) {

           $wishList= new WishList($row['ID'], $row['wlUserID'], $row['firstName'], $row['lastName'],
                                $row['description'], $row['wishListItemCount'], $row['dateCreated'], 
                              $row['dateUpdated'], $row['isActive']);

           // populate the wishlistItems
           $wishListItems= WishListDB::getWishListItemsForWishList($row['ID']);
           $wishList->setWishListItems($wishListItems);


         $wishLists[]= $wishList;
     }

     return $wishLists;

 }


// Get just a single wishlist, it might have multiple WishListItems
public static function getWishListByID($wishListID)
{
       //$db= new Database();
       $db= Database::getDB();

    $query = 'SELECT w.ID, w.wlUserID,. u.firstName, u.lastName, w.description, w.isActive, 
            w.dateCreated, w.dateUpdated,  count(wi.wishListID) as "wishListItemCount"
            from wishlist w 
            left join wishlistitem wi on w.id = wi.wishListID
            join wlUser u on w.wlUserID = u.ID
            where  w.ID = :wishListID 
            group by  w.ID, w.wlUserID,. u.firstName, u.lastName, w.description, w.isActive, 
            w.dateCreated, w.dateUpdated';
       $statement = $db->prepare($query);
       $statement-> bindvalue(':wishListID', $wishListID);
       $statement->execute();

       // Should be only one row
       foreach ($statement as $row) {

             $wishList= new WishList($row['ID'],  $row['wlUserID'], $row['firstName'], $row['lastName'],
                                  $row['description'], $row['wishListItemCount'], $row['dateCreated'], 
                                $row['dateUpdated'], $row['isActive']);

             // populate the wishlistItems
             $wishListItems= WishListDB::getWishListItemsForWishList($row['ID']);

             $wishList->setWishListItems($wishListItems);


       }

       return $wishList;

}       



// get all wishlists with the count of wishlist items, it does not include the wishListItems.
public static function getWishAllWishLists($last_name)
{
   //$db= new Database();
   $db= Database::getDB();

    $query = 'SELECT w.ID, w.wlUserID,. u.firstName, u.lastName, w.description, w.isActive, 
         w.dateCreated, w.dateUpdated,  count(wi.wishListID) as "wishListItemCount" from wishlist w 
         left join wishlistitem wi on w.id = wi.wishListID
         join wlUser u on w.wlUserID = u.ID
         where   w.isActive = :isActive ';
    if(trim($last_name) != ""){ $query .= " and lastName like '$last_name' "; }
    $query .= 'group by  w.ID, w.wlUserID,. u.firstName, u.lastName, w.description, w.isActive, 
         w.dateCreated, w.dateUpdated';

    $statement = $db->prepare($query);
    $statement-> bindvalue(':isActive', 1); // Hard code to 1 for now
    $statement->execute();
    $wishLists=array();
    foreach ($statement as $row) {
            // Add the Wishlist record.
            $wishList= new WishList($row['ID'],  $row['wlUserID'], $row['firstName'], $row['lastName'],
                               $row['description'], $row['wishListItemCount'], $row['dateCreated'], 
                               $row['dateUpdated'], $row['isActive']);

             $wishLists[]= $wishList;
        }

    return $wishLists;
}





public static function fulfillWishListItems($wishListItemID, $wishListUserID)
{
       //$db= new Database();
       $db= Database::getDB();

        $query =  'Update  wishlistItem 
              set dateUpdated = now(),
              fulfilledByID = :fulfilledByID
              where id = :wishListItemID';

        $statement = $db->prepare($query);
        $statement-> bindvalue(':wishListItemID', $wishListItemID); 
        $statement-> bindvalue(':fulfilledByID', $wishListUserID); 
        $statement->execute();


}  

public function addWishList($wishListUserID, $description) {
    $db = Database::getDB();

    $date = date('Y-m-d H:i:s');
    
    $query =
        "INSERT INTO wishlist (wlUserID, description, dateCreated) VALUES ('$wishListUserID', '$description', '$date')";
    
    $row_count = $db->exec($query);
    return $row_count;
}

public function deleteWishList($wishListID) {
    $db = Database::getDB();

    $date = date('Y-m-d H:i:s');

    $query =
        "Update wishlist SET isActive = '0', dateUpdated = '$date' WHERE ID = $wishListID";

    $row_count = $db->exec($query);
    return $row_count;
}


public function addWishListItem($wishListItem) {
    $db = Database::getDB();

    $wishListID = $wishListItem->getWishListID();
    $description = $wishListItem->getDescription();
    $quantity = $wishListItem->getQuantity();
    $notes = $wishListItem->getNotes();
    $storeID = $wishListItem->getStoreID();
    $date = date('Y-m-d H:i:s');

    $query =
        "INSERT INTO wishlistitem (wishListID, description, quantity, storeID, notes, isActive, dateCreated) "
            . "VALUES ('$wishListID', '$description', '$quantity', '$storeID', '$notes', '1', '$date')";

    $row_count = $db->exec($query);
    return $row_count;
}

public function updateWishListItem($wishListItem) {
    $db = Database::getDB();

    $ID = $wishListItem->getId();
    $description = $wishListItem->getDescription();
    $quantity = $wishListItem->getQuantity();
    $notes = $wishListItem->getNotes();
    $storeID = $wishListItem->getStoreID();
    $date = date('Y-m-d H:i:s');

    $query =
        "Update wishlistitem SET description = '$description', quantity = '$quantity', storeID = $storeID, notes = '$notes', dateUpdated = '$date' WHERE ID = $ID";

    $row_count = $db->exec($query);
    return $row_count;
}

public function deleteWishListItem($wishlistItemID) {
    $db = Database::getDB();

    $date = date('Y-m-d H:i:s');

    $query =
        "Update wishlistitem SET isActive = 0, dateUpdated = '$date' WHERE ID = $wishlistItemID";

    $row_count = $db->exec($query);
    return $row_count;
}

public function updateWishList($wishList) {
    $db = Database::getDB();

    $ID = $wishList->getId();
    $description = $wishList->getDescription();
    $date = date('Y-m-d H:i:s');

    $query =
        "Update wishlist SET description = '$description', dateUpdated = '$date' WHERE ID = $ID";

    $row_count = $db->exec($query);
    return $row_count;
}

}