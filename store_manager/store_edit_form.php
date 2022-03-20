<?php require_once '../view/header.php';?>   
<?php require_once '../include/showGetPostVariables.php';?>

    <main>
        <h1>Edit Store</h1>
        <?php 
        $action = '';
        if($store->getID() == '0' || $store->getID() == null)
            $action = 'insert_store';
        else
        {
            $action = 'save_store';
        }
        ?>
        <form action="store_manager/index.php" method="post" id="edit_user_form">
            <input type="hidden" name="action" value='<?php echo $action ?>'>
            
            <label>Name:</label>
            <input type="text" value="<?php echo $store->getName(); ?>" name="name"><br>

            <label>Active:</label>
            <select name="isActive">
                <option value="1"<?php echo  $Utility->setSelectedOption(1, $store->getIsActive())?>>Active</option>
                <option value="0"<?php echo  $Utility->setSelectedOption(0, $store->getIsActive())?>>Inactive</option>
            </select><br>  

            <label>&nbsp;</label>
            <input type="hidden" name="storeID"
                       value="<?php echo $store->getID(); ?>">
            <input type="submit" value="Save"><br>
        </form>
        <p><a href="store_manager/index.php">Back To List</a></p>
<?php require_once '../view/footer.php';?>