<?php require_once '../view/header.php';?>
<?php require_once '../include/showGetPostVariables.php';?>
<?php $activeStatus = 'Yes'; ?>
<h3><?php echo $wishlist->getDescription(); ?>, by <?php echo $wishlist->getFirstName(); ?> <?php echo $wishlist->getLastName(); ?></h3>
<table>
    <tr>
        <th>Description</th>
        <th>Quantity</th>
        <th>Store</th>
        <th>Notes</th>
        <th>Fulfilled By</th>
        <th>Fulfill</th>
    </tr>

    <?php foreach ($wishListItems as $wishlist_item) : ?>
    <tr>
        <?php $fulfilledByName = $wishlist_item->getFulfilledByName() ?>
        <?php if($fulfilledByName != null || trim($fulfilledByName) != '')
        {
            $fulfilled = 'N/A';
            $type = 'hidden';
        }
        else
        {
            $fulfilled = '';
            $type = 'visible';
        }
        ?>
        <?php $id = $wishlist_item->getID() ?>

        <td><?php echo $wishlist_item->getDescription(); ?></td>
        <td><?php echo $wishlist_item->getQuantity(); ?></td>        
        <td><?php echo $wishlist_item->getStoreName(); ?></td>
        <td><?php echo $wishlist_item->getNotes(); ?></td>
        <td><?php echo $fulfilledByName; ?></td>
        <td>
            <?php echo $fulfilled; ?>
            <form class='<?php echo $type; ?>' method="GET">
                <input type="hidden" name="action" value="fulfill">
                <input type="hidden" name="wishlistItemID"
                   value="<?php echo $id; ?>">
                <input type="hidden" name="wishlistID"
                   value="<?php echo $wishlist_item->getWishListID(); ?>">
                <input type="submit" value="Fulfill">
        </form></td>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php require_once '../view/footer.php';?>