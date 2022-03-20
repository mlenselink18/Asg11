<?php
function funShowAllPOSTandGETvariables(){
    // Note when using double quotes, php will let you place variables in your string
    
   //  return;    // To turn this function off, uncomment the return keyword.
    echo "<div>*********************************************************************<br />";
    echo "<b>POST Variables:</b><br />";
    foreach ($_POST as $key => $value) {
        echo  "    <b> $key  </b> =  $value <br />";
    }
    echo "<p></p>";
    
    echo "<b>GET Variables:</b><br />";
    foreach ($_GET as $key => $value) {
        echo  "    <b> $key  </b> =  $value <br />";
    }
    echo "<p></p>";
    echo "*********************************************************************</div>";
}
?>
