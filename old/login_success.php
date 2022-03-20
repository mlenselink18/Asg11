<?php
        $email = filter_input(INPUT_POST, 'email');
	$password = filter_input(INPUT_POST, 'password');
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="../main.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8">
        <title>Success</title>
    </head>

    <body>
        <?php require_once '../view/header.php';?>
        <?php require_once '../include/showGetPostVariables.php';?>
        
        
        <p>Login Successful</p>
        
<!--        <p>Debugging Variables</p>-->
        <?php // funShowAllPOSTandGETvariables() ?>
        
        <?php require_once '../view/footer.php';?>
    </body>
</html>