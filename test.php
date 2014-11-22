<?php
    include 'connect.php';

    $playerinfo = "select * from players where name = 'player1'";
    $playerinfo2 = mysql_query($playerinfo) or die ("Could not select players");

    $playerinfo3 = mysql_fetch_array($playerinfo2);

    echo "Player1's email is " . $playerinfo3['email'];
?>