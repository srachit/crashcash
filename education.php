<?php
include_once 'connect.php';
    session_start();
    if(isset($_SESSION['player']))
    {
        $player = $_SESSION['player'];
    }
    else
    {
        echo    "Not Logged in <br><br> <a href='index.php'>Go Back</a>";
        exit;
    }
    $player1 = "SELECT * from players where name = '$player'";
    $player2 = mysql_query($player1) or die ("could not select players");
    $player3 = mysql_fetch_array($player2);
    $playerIntelligence = $player3['intelligence']; 

if ($playerIntelligence == 1){
	$SQL = "UPDATE ports SET players(money, intelligence, energy, profession)
	                     VALUES('6000', '2', '10', 'Starbucks')";
	mysql_query($SQL) or die ("Could not update Starbucks");

	print   "Upgraded to Starbucks!";
}

else if ($playerIntelligence == 2){
	$SQL = "UPDATE into players(money, intelligence, energy, profession, tmoney)
	                     VALUES('12000', '3', '20', 'Professional', '$tmoney - 150000')";
	mysql_query($SQL) or die ("Could not update");

	print   "Upgraded to Professional!";
}

else if ($playerIntelligence == 3){
	$SQL = "UPDATE into players(money, intelligence, energy, profession, tmoney)
	                     VALUES('24000', '4', '30', 'Manager', '$tmoney - 450000')";
	mysql_query($SQL) or die ("Could not update");

	print   "Upgraded to Manager!";
}
else if ($playerIntelligence == 4){
	$SQL = "UPDATE into players(money, intelligence, energy, profession, tmoney)
	                     VALUES('48000', '5', '40', 'CEO', '$tmoney - 1350000')";
	mysql_query($SQL) or die ("Could not update");

	print   "Upgraded to CEO!";
}

?>