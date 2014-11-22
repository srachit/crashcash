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

    $numGuessed = $_POST['numGuess'];
    $bet = $_POST['gambleBet'];
    $correct = rand(1, 10);

    if($numGussed > 10)
    {
        echo    "Entere a number below 10 please";
    }
    else
    {
        if($numGuessed );
    }

?>