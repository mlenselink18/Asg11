<?php 
    require_once '../view/header.php';
    require_once '../include/showGetPostVariables.php';
    $activeStatus = 'Yes'; 
?>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Active</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

    <?php foreach ($Stores as $Store) : ?>
    <tr>
        <?php 
        $activeStatus = $Utility->getIsActiveString($Store->getIsActive());
        $id = $Store->getID();
        ?>
        <td><?php echo $id; ?></td>
        <td><?php echo $Store->getName(); ?></td>
        <td><?php echo $activeStatus; ?></td>
        <td style="visibility:  <?php echo $editUsers ?>;">
            <form action="store_manager/index.php" method="GET">
                <input type="hidden" name="action" value="edit_store">
                <input type="hidden" name="storeID"
                   value="<?php echo $id; ?>">
                <input type="submit" value="Edit Store">
        </form></td>
        <td>
            <form action="store_manager/index.php" method="POST">
                <input type="hidden" name="action" value="delete_store">
                <input type="hidden" name="storeID"
                   value="<?php echo $id; ?>">
                <input type="submit" value="Delete Store">
        </form></td>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
<form action="store_manager/index.php" method="GET">
        <input type="hidden" name="action" value="add_store">
        <input type="hidden" name="storeID"
           value="0">
        <input type="submit" value="Add Store">
</form>
<br>
<?php require_once '../view/footer.php';?><?php