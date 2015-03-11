<?php error_reporting(E_ALL ^ E_NOTICE);

    mysql_connect ("localhost", "root", "") or die (mysql_error());
    mysql_select_db ("vintagebikes");
    
    $id = addslashes ($_REQUEST['id']);
    
    $image = mysql_query ("SELECT * FROM image WHERE id=$id");
    $image = mysql_fetch_assoc($image);
    $image = $image['path'];
    
    header ("Content-type: image/png");
    
    echo $image;
?> 
