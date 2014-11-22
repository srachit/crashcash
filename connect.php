<?php
    $db = mysql_connect("217.199.187.189", "cl54-crashcash", "ucsdUSERS") or die("Could not connect to database");
    if(!$db)
    {
        die("no db");
    }
    if(!mysql_select_db("cl54-crashcash", $db))
    {
        die("No database selected");
    }
?>
