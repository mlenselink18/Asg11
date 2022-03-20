<?php 
    require_once '../view/header.php';
    require_once '../include/showGetPostVariables.php';
    $activeStatus = 'Yes'; 
    $editUsers = $Utility->getAdminClass($UserRole);
    ?>
<form action="wishlist_manager/index.php" method="get">

    <label>Last Name : </label>
    <input type="hidden" name="action" value="list_wishlists">
    <input type="text" name='last_name'>
    <input type="submit" value="Search">
</form>
<br>
<table>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Description</th>
        <th>Item Count</th>
        <th>Date Created</th>
        <th>Active</th>
        <th style="visibility:  <?php echo $editUsers ?>;">Edit</th>
    </tr>

    <?php foreach ($WishLists as $WishList) : ?>
    <tr>
        <?php 
        $activeStatus = $Utility->getIsActiveString($WishList->getIsActive());
        $fullName = $WishList->getFullName(); 
        $id = $WishList->getID();
        $wlUserId = $WishList->getUserID();
        $editWishlist = $Utility->getEditRights($wlUserId, $UserId, $UserRole);
        ?>

        <td><?php echo $id; ?></td>
        <td><?php echo $fullName; ?></td>
        <td><?php echo $WishList->getDescription(); ?></td>
        <td><?php echo $WishList->getWishListItemCount(); ?></td>
        <td><?php echo $WishList->getDateCreated(); ?></td>
        <td><?php echo $activeStatus; ?></td>
        <td style="visibility:  <?php echo $editWishlist ?>;">
            <form action="wishlist_manager/index.php" method="GET">
                <input type="hidden" name="action" value="edit_wishlist">
                <input type="hidden" name="wishlistID"
                   value="<?php echo $id; ?>">
                <input type="submit" value="Edit Wishlist">
        </form></td>
        <td>
            <form action="wishlist_manager/index.php" method="GET">
                <input type="hidden" name="action" value="view_wishlist">
                <input type="hidden" name="wishlistID"
                   value="<?php echo $id; ?>">
                <input type="submit" value="Fulfill">
        </form></td>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
<form action="wishlist_manager/index.php" method="POST">
    <input type="text" name="wlDescription" placeholder="List Description">
    <input type="hidden" name="action" value="add_wishlist">
    <input type="hidden" name="userID"
       value="<?php echo $UserId; ?>">
    <input type="submit" value="Add Wishlist">
</form>
<br>
<?php require_once '../view/footer.php';?>