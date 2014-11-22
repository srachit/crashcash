<?php
//include_once 'connect.php';
//    session_start();
//    if(isset($_SESSION['player']))
//    {
//        $player = $_SESSION['player'];
//    }
//    else
//    {
//        echo    "Not Logged in <br><br> <a href='index.php'>Go Back</a>";
//        exit;
//    }
//    $player1 = "SELECT * from players where name = '$player'";
//    $player2 = mysql_query($player1) or die ("could not select players");
//    $player3 = mysql_fetch_array($player2);
//    $playerName = $player3['name'];
//    $playerIntelligence = $player3['intelligence'];
//    $playerId = $player3['id'];
//
//if ($playerIntelligence == 1){
//
//    $updateplayer = "update players set money=6000, intelligence=2, energy=10, profession='Starbucks' where name='$playerName'";
//    mysql_query($updateplayer) or die("Could not update starbucks");
//
//	print   "Upgraded to Starbucks!";
//}
//
//else if ($playerIntelligence == 2){
//	$SQL = "UPDATE into players(money, intelligence, energy, profession, tmoney)
//	                     VALUES('12000', '3', '20', 'Professional', '$tmoney - 150000')";
//	mysql_query($SQL) or die ("Could not update");
//
//	print   "Upgraded to Professional!";
//}
//
//else if ($playerIntelligence == 3){
//	$SQL = "UPDATE into players(money, intelligence, energy, profession, tmoney)
//	                     VALUES('24000', '4', '30', 'Manager', '$tmoney - 450000')";
//	mysql_query($SQL) or die ("Could not update");
//
//	print   "Upgraded to Manager!";
//}
//else if ($playerIntelligence == 4){
//	$SQL = "UPDATE into players(money, intelligence, energy, profession, tmoney)
//	                     VALUES('48000', '5', '40', 'CEO', '$tmoney - 1350000')";
//	mysql_query($SQL) or die ("Could not update");
//
//	print   "Upgraded to CEO!";
//}
//
//?>

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
$playerName = $player3['name'];

if ($playerIntelligence == 1){

    $updateplayer = "update players set money=6000, intelligence=2, energy=10, profession='Starbucks', tmoney = tmoney -50000 where name='$playerName'";
    mysql_query($updateplayer) or die("Could not update starbucks");

    print   "Upgraded to Starbucks!";
}

else if ($playerIntelligence == 2){
    $updateplayer = "update players set money=12000, intelligence=3, energy=20, profession='Professional', tmoney = tmoney -150000 where name='$playerName'";
    mysql_query($updateplayer) or die("Could not update Professional");

    // $SQL = "UPDATE into players(money, intelligence, energy, profession, tmoney)
    //                      VALUES('12000', '3', '20', 'Professional', '$tmoney - 150000')";
    // mysql_query($SQL) or die ("Could not update");

    print   "Upgraded to Professional!";
}

else if ($playerIntelligence == 3){
    $updateplayer = "update players set money=24000, intelligence=4, energy=30, profession='Manager', tmoney = tmoney -450000 where name='$playerName'";
    mysql_query($updateplayer) or die("Could not update Manager");

    // $SQL = "UPDATE into players(money, intelligence, energy, profession, tmoney)
    //                      VALUES('24000', '4', '30', 'Manager', '$tmoney - 450000')";
    // mysql_query($SQL) or die ("Could not update");

    print   "Upgraded to Manager!";
}
else if ($playerIntelligence == 4){
    $updateplayer = "update players set money=48000, intelligence=5, energy=40, profession='CEO', tmoney = tmoney -1350000 where name='$playerName'";
    mysql_query($updateplayer) or die("Could not update CEO");

    // $SQL = "UPDATE into players(money, intelligence, energy, profession, tmoney)
    //                      VALUES('48000', '5', '40', 'CEO', '$tmoney - 1350000')";
    // mysql_query($SQL) or die ("Could not update");

    print   "Upgraded to CEO!";
}

?>