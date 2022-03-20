<!-- start header -->
<!DOCTYPE html>
<html>
    <head>
        <title>ASG 12</title>
        <base href="http://localhost/projects/Asg11/">
        <link href="main.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8">
    </head>
    <header><h1>Michael Lenselink's Website</h1></header>
    <body>
        <?php 
        if (session_id() == '') {
        $lifetime = 60 * 60 * 24 * 14; 
                // 2 weeks in seconds 
                session_set_cookie_params($lifetime, '/'); 
                session_start(); 
        }
        require ($_SERVER['DOCUMENT_ROOT'].'/projects/Asg11/model/Utility.php');
        $Utility = new Utility();
        $UserId = $Utility->getUserIdFromSession();
        $UserRole = $Utility->getUserRoleIdFromSession();
        $login = $Utility->getLoginClass($UserId);
        $logout = $Utility->getLogoutClass($UserId);
        $admin = $Utility->getAdminClass($UserRole);
        ?>
        <h1>
            Michael Lenselink Asg 12
        </h1>
        <a href="index.php">Home</a>
        <a href="user_manager" class='<?php echo $admin ?>'>Users</a>
        <a href="wishlist_manager" class='<?php echo $logout ?>'>Wish Lists</a>
        <a href="store_manager" class='<?php echo $admin ?>'>Stores List</a>
        <?php if($UserId != 0){ ?>
        <a href="user_manager/?action=edit_user&userID=<?php echo $UserId ?>">Manage Account</a>
        <?php } ?>
        <a href="user_manager/?action=login" class='<?php echo $login ?>'>Login</a>
        <a href="user_manager/?action=logout" class='<?php echo $logout ?>'>Logout</a>
        <a href="user_manager/?action=register" class='<?php echo $login ?>'>Register</a>
        <hr>

<!-- end header -->