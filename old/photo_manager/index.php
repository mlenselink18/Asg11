<?php

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'view_photo';
    }
}  
if ($action == 'view_photo') {
    $imageID = filter_input(INPUT_GET, 'id');
        
    if($imageID === false || $imageID === '' || $imageID > 5 || $imageID < 1)
        $imageID = 1;

    $imageName = 'tnt'.$imageID.'.jpg';

    include('photo.php');
}
else if ($action == 'home') {
    include('../index.php');
} 
?>