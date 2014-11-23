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
$playerName = $player3['name']; 
$playerEducation = $player3['profession'];
$playerMoney = $player3['tmoney'];
$playerIntelligence = $player3['intelligence'];
$playerEnergy = $player3['tenergy'];
$playerTime = $player3['time'];
$playerTLoan = $player3['total_loan'];
$playerTLoan2 = $player3['loan'];

$playerFD = $player3['fixed_deposit'];
$addFd = $_POST['fdAmount'];



    if(isset($_POST['addToFd']))
    {
        $var = $addFd + $playerFd;
        $var2 = $playerMoney - $addFd;
        if ($addFd < $playerMoney){
                $updateplayer = "Update players set fixed_deposit= '$var' ,tmoney = $var2 where name='$playerName'";
                mysql_query($updateplayer) or die("no FD done");

                print   "You've deposited in FD";
        }
    }

    if(isset($_POST['upgrade'])){
        $updateplayer = "Update players set fixed_deposit= 0 ,tmoney = tmoney + fixed_deposit where name='$playerName'";
        mysql_query($updateplayer) or die("no checkout");

        print   "You've checkout the deposit";
    }


    $playerIntelligence = $player3['intelligence'];
    $playerName = $player3['name'];
    $playerTmoney = $player3['tmoney'];
    $playerProfession = $player3['profession'];
    $playerLoan = $player3['total_loan'];
    $playerFD = $player3['fixed_deposit'];

?>

        
        
    