<?php require_once '../view/header.php';?>
<?php require_once '../include/showGetPostVariables.php';?>
<?php $activeStatus = 'Yes'; ?>
<br>
<?php $wishlistID = $wishlist->getId(); ?>
<form method="POST">
    <b>WishListID :</b> <?php echo $wishlistID; ?><br>
    <b>First Name :</b> <?php echo $wishlist->getFirstName(); ?>
    <b>Last Name :</b> <?php echo $wishlist->getLastName(); ?>
    <b>Description :</b> <input type="text" name="taDescription" value="<?php echo $wishlist->getDescription(); ?>"/><br>
    <input type="hidden" name="action" value="updateWishList">
    <input type="hidden" name="wishlistID" value="<?php echo $wishlist->getID(); ?>">
    <input type="submit" value="Save Changes">
</form>
<br>
<table>
    <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Store</th>
        <th>Quantity</th>
        <th>Notes</th>
        <th>Fulfilled By</th>
        <th>Save</th>
        <th>Delete</th>
    </tr>

    <?php
        foreach ($wishListItems as $wishlist_item) : 
    ?>
    <?php 
            $fulfilledByName = $wishlist_item->getFulfilledByName();
            $fulfilled = $Utility->getFulfilled($fulfilledByName);
            $type = $Utility->getFulfilledType($fulfilledByName);
            
            if($wishlist_item->getIsActive() == '0')
            {
                continue;
            }

            $id = $wishlist_item->getID() 
        ?>
    <tr> 
    <form method="POST">
        <td><?php echo $id; ?></td>
        <td><input type="text" name="taDescription" value="<?php echo $wishlist_item->getDescription(); ?>"/></td>
        <td>
            <select name="selectStore">
            <?php
                foreach ($stores as $store) : 
                    $storeValue = $store->getID();
                    $storeName = $store->getName();
            ?>
                <option value="<?php echo $storeValue; ?>" <?php echo $Utility->setSelectedOption($storeValue, $wishlist_item->getStoreID())?>><?php echo $storeName; ?></option>
            <?php endforeach; ?>
            </select>
        </td>
        <td><input type="number" max="99" min="0" name="quantity" value="<?php echo $wishlist_item->getQuantity(); ?>"/></td>        
        <td><input type="text" name="taNotes" value="<?php echo $wishlist_item->getNotes(); ?>"/></td>
        <td><?php echo $fulfilledByName; ?></td>
        <td>
            <?php echo $fulfilled; ?>
            <form >
                <input type="hidden" name="action" value="saveItem">
                <input type="hidden" name="wishlistItemID"
                   value="<?php echo $id; ?>">
                <input class='<?php echo $type; ?>' type="submit" value="Save Changes">
        </td>
    </form>
        <td>
            <?php echo $fulfilled; ?>
            <form class='<?php echo $type; ?>' method="POST">
                <input type="hidden" name="action" value="deleteItem">
                <input type="hidden" name="wishlistItemID"
                   value="<?php echo $id; ?>">
                <input type="submit" value="Delete">
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <form method="POST">
        <td>NEW</td>
        <td><input type="text" name="taDescription" /></td>
        <td>
            <select name="selectStore">
            <?php
                foreach ($stores as $store) : 
            ?>
                <option value="<?php echo $store->getID(); ?>"><?php echo $store->getName(); ?></option>
            <?php endforeach; ?>
            </select>
        </td>
        <td><input type="number" name="quantity" max="99" min="0" /></td>        
        <td><input type="text" name="taNotes" /></td>
        <td></td>
        <td>           
            <input type="hidden" name="action" value="addItem">
            <input type="hidden" name="WishListID" value='<?php echo $wishlistID; ?>'>
            <input type="submit" value="Add New Item">           
        </td>
        </form>
        <td>
            N/A
        </td>
    </tr>
</table>
<br>
<form action="wishlist_manager/index.php" method="POST">
    <input type="hidden" name="action" value="deleteWishlist">
    <input type="hidden" name="deleteID"
       value="<?php echo $wishlistID; ?>">
    <input type="submit" value="Delete Wishlist">
</form>
<br>
<p><a href="wishlist_manager/index.php">Back To List</a></p>
<?php require_once '../view/footer.php';?>