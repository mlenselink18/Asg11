<?php require_once '../view/header.php';?>
<?php require_once '../include/showGetPostVariables.php';?>
<?php $activeStatus = 'Yes'; ?>
<form action="user_manager/index.php" method="get">

    <label>Last Name : </label>
    <input type="hidden" name="action" value="list_users">
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

    <?php foreach ($users as $user) : ?>
    <tr>
        <?php 
        $activeStatus = $Utility->getIsActiveString($user->getIsActive());
        $fullName = $user->getFullName();?>

        <td><?php echo $user->getID(); ?></td>
        <td><?php echo $fullName; ?></td>
        <td><?php echo $user->getEmailAddress(); ?></td>
        <td><?php echo $user->getCity(); ?></td>
        <td><?php echo $user->getState(); ?></td>
        <td><?php echo $user->getPostalCode(); ?></td>
        <td><?php echo $activeStatus; ?></td>
        <td>
            <form action="user_manager/index.php" method="GET">
                <input type="hidden" name="action" value="edit_user">
                <input type="hidden" name="userID"
                   value="<?php echo $user->getID(); ?>">
                <input type="submit" value="Edit">
        </form></td>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php require_once '../view/footer.php';?>