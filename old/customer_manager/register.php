    <?php require_once '../view/header.php';?>
    <h2>Register Your Account</h2>
    <form action="index.php" method="post" id='register_form'>
        <input type="hidden" name="action" value="register_process">

        <label>First Name:</label>
        <input type="text" name="first_name"><br>

        <label>Last Name</label>
        <input type="text" name="last_name"><br>

        <label>Email Address:</label>
        <input type="text" name="email"><br>

        <label>Password:</label>
        <input type="password" name="password"><br>

        <label>Address:</label>
        <input type="text" name="address"><br>

        <label>City:</label>
        <input type="text" name="city"><br>

        <label>State:</label>
        <input type="text" name="state"><br>

        <label>Zip Code:</label>
        <input type="text" name="postalCode"><br>

        <label>&nbsp;</label>
        <input type="submit" value="Register"><br>

    </form>
    <?php require_once '../view/footer.php';?>