<?php require_once '../view/header.php';?>   
<?php require_once '../include/showGetPostVariables.php';?>

    <main>
        <h1>Edit Customer</h1>
        <form action="index.php" method="post" id="edit_customer_form">
            <input type="hidden" name="action" value="save_customer">
            
            <label>First Name:</label>
            <input type="text" value="<?php echo $customer->getFirstName(); ?>" name="firstName"><br>

            <label>Last Name:</label>
            <input type="text" value="<?php echo $customer->getLastName(); ?>" name="lastName"><br>

            <label>Address:</label>
            <input type="text" value="<?php echo $customer->getAddress(); ?>" name="address"><br>
            
            <label>City:</label>
            <input type="text" value="<?php echo $customer->getCity(); ?>" name="city"><br>
            
            <label>State:</label>
            <input type="text" value="<?php echo $customer->getState(); ?>" name="state"><br>
            
            <label>Zip Code:</label>
            <input type="text" value="<?php echo $customer->getPostalCode(); ?>" name="postalCode"><br>
                                    
            <label>Active:</label>
            <select name="isActive">
                <option value="1"<?php echo setSelectedOption(1, $customer->getIsActive())?>>Active</option>
                <option value="0"<?php echo setSelectedOption(0, $customer->getIsActive())?>>Inactive</option>
            </select><br>  
            <?php            
            function setSelectedOption($expectedValue, $compareToValue){
                // Compares two variables, if they are the same returns:  " selected "
                // If they are different, returns:  ""
                //
                // Example:    1, 2                    will return:  ""
                //                    1, 1                    will return:  " selected "

                $selectedState = "";
                if($expectedValue == $compareToValue)
                {
                    $selectedState = " selected ";
                }
                return $selectedState;
            }           
            ?>

            <label>&nbsp;</label>
            <input type="hidden" name="customerID"
                       value="<?php echo $customer->getID(); ?>">
            <input type="submit" value="Update"><br>
        </form>
        <p><a href="index.php">Back To List</a></p>
    </main>
    
<!--    <p>Debugging Variables</p>-->
        <?php // funShowAllPOSTandGETvariables() ?>
<?php require_once '../view/footer.php';?>