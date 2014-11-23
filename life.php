<?php
    include 'connect.php';
?>

<?php

    $playerInfo = "SELECT id, tmoney, intelligence from players";
    $playerInfo2 = mysql_query($playerInfo) or die("Could not select playerInfo");
    while($playerInfo3=mysql_fetch_array($playerInfo2))
    {
        $playerIntelligence = $playerInfo3['intelligence'];
        if($playerIntelligence==1)
        {
            $rent = 150;
            $food = 150;
            $tax = 150;
            $moneyLeft = $playerInfo3['tmoney'] - $rent - $food - $tax;
        }
        else if($playerIntelligence==2)
        {
            $rent = 400;
            $food = 400;
            $tax = 400;
            $moneyLeft = $playerInfo3['tmoney'] - $rent - $food - $tax;
        }
        else if($playerIntelligence==3)
        {
            $rent = 1000;
            $food = 1000;
            $tax = 1000;
            $moneyLeft = $playerInfo3['tmoney'] - $rent - $food - $tax;
        }
        else if($playerIntelligence==4)
        {
            $rent = 3000;
            $food = 3000;
            $tax = 3000;
            $moneyLeft = $playerInfo3['tmoney'] - $rent - $food - $tax;
        }
        else if($playerIntelligence==5)
        {
            $rent = 8000;
            $food = 8000;
            $tax = 8000;
            $moneyLeft = $playerInfo3['tmoney'] - $rent - $food - $tax;
        }

        $updatePlayers = "Update players set tmoney='$moneyLeft' WHERE id = '$playerInfo3[id]'";
        mysql_query($updatePlayers) or die("Could not update player stats");
    }