<?php include '../view/header.php'; ?>
    <h2>Login</h2>
    <form action="customer_manager/index.php" method="post" id='login_form'>
        <input type="hidden" name="action" value="login_process">

        <label>Email Address:</label>

        <?php 
        $username = '';
        $pass = '';
        if(!empty($_SESSION['loginInfo']) && count($_SESSION['loginInfo']) > 0)
        {
            foreach ($_SESSION['loginInfo'] as $key => $item)
            {
                $username = $item['userName'];
                $pass = $item['pass'];
            }
        }
        ?>
        <input type="text" value="<?php echo $username ?>"  name="email"><br>

        <label>Password:</label>
        <input type="text" value="<?php echo $pass ?>" name="password"><br>


        <label>&nbsp;</label>
        <input type="submit" value="Login"><br>

    </form>
    <?php require_once '../view/footer.php';?>
</body>