<?php require_once '../view/header.php';?>
<?php require_once '../include/showGetPostVariables.php';?>
<?php $activeStatus = 'Yes'; ?>
<form action="customer_manager/index.php" method="get">

    <label>Last Name : </label>
    <input type="hidden" name="action" value="list_customers">
    <input type="text" name='last_name'>
    <input type="submit" value="Search">
</form>
<br>
<table>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zip Code</th>
        <th>Active</th>
        <th>Edit</th>
    </tr>

    <?php foreach ($customers as $customer) : ?>
    <tr>
        <?php if($customer->getIsActive() == '0')
            $activeStatus = 'No';
        else
        {
            $activeStatus = 'Yes';
        }
        ?>
        <?php $fullName = $customer->getFirstName() . ' ' . $customer->getLastName() ?>

        <td><?php echo $customer->getID(); ?></td>
        <td><?php echo $fullName; ?></td>
        <td><?php echo $customer->getEmailAddress(); ?></td>
        <td><?php echo $customer->getCity(); ?></td>
        <td><?php echo $customer->getState(); ?></td>
        <td><?php echo $customer->getPostalCode(); ?></td>
        <td><?php echo $activeStatus; ?></td>
        <td>
            <form action="customer_manager/index.php" method="GET">
                <input type="hidden" name="action" value="edit_customer">
                <input type="hidden" name="customerID"
                   value="<?php echo $customer->getID(); ?>">
                <input type="submit" value="Edit">
        </form></td>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<!--<p>Debugging Variables</p>-->
<?php // funShowAllPOSTandGETvariables() ?>

<?php require_once '../view/footer.php';?>