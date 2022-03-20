    <?php require_once '../view/header.php';?>
    <?php require_once '../include/showGetPostVariables.php';?>


    <a href="index.php?id=1">Pic 1</a>
    <a href="index.php?id=2">Pic 2</a>
    <a href="index.php?id=3">Pic 3</a>
    <a href="index.php?id=4">Pic 4</a>
    <a href="index.php?id=5">Pic 5</a>
    <p>Very Cool Photos</p>


    <img src="<?php echo "images/$imageName"; ?>" alt="<?php echo "images/$imageName"; ?>"/>

    <p>Debugging Variables</p>
    <?php funShowAllPOSTandGETvariables() ?>

    <?php require_once '../view/footer.php';?>