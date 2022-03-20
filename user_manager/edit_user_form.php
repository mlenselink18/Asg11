<?php require_once '../view/header.php';?>   
<?php require_once '../include/showGetPostVariables.php';?>

    <main>
        <h1>Edit Customer</h1>
        <form action="user_manager/index.php" method="post" id="edit_user_form">
            <input type="hidden" name="action" value="save_user">
            
            <label>First Name:</label>
            <input type="text" value="<?php echo $user->getFirstName(); ?>" name="firstName"><br>

            <label>Last Name:</label>
            <input type="text" value="<?php echo $user->getLastName(); ?>" name="lastName"><br>

            <label>Address:</label>
            <input type="text" value="<?php echo $user->getAddress(); ?>" name="address"><br>
            
            <label>City:</label>
            <input type="text" value="<?php echo $user->getCity(); ?>" name="city"><br>
            
            <label>State:</label>
            <input type="text" value="<?php echo $user->getState(); ?>" name="state"><br>
            
            <label>Zip Code:</label>
            <input type="text" value="<?php echo $user->getPostalCode(); ?>" name="postalCode"><br>
            
            <label>Phone:</label>
            <input type="text" value="<?php echo $user->getPhone(); ?>" name="phone"><br>
                                    
            <label>Active:</label>
            <select name="isActive">
                <option value="1"<?php echo $Utility->setSelectedOption(1, $user->getIsActive())?>>Active</option>
                <option value="0"<?php echo $Utility->setSelectedOption(0, $user->getIsActive())?>>Inactive</option>
            </select><br>  

            <label>&nbsp;</label>
            <input type="hidden" name="userID"
                       value="<?php echo $user->getID(); ?>">
            <input type="submit" value="Save"><br>
        </form>
        <p><a href="user_manager/index.php" class='<?php echo $admin ?>'>Back To List</a></p>
<?php require_once '../view/footer.php';?>