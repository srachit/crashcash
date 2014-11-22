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
	$playerIntelligence = $player3['intelligence'];
	$playerTmoney = $player3['tmoney'];
    $playerLoan = $player3['tloan'];

    if(isset($_POST['upgrade']))
    {
        if ($playerIntelligence == 1){
                $updateplayer = "Update players set loan=20000, interest = 20, tmoney = tmoney + loan, total_loan = total_loan + loan + 4000 where name='$playerName'";
                mysql_query($updateplayer) or die("no Loan given");

                print   "Upgraded to Starbucks!";
            }

        else if ($playerIntelligence == 2){
                $updateplayer = "update players set loan=50000, interest = 30, tmoney = tmoney + loan, total_loan = total_loan + loan + 15000, time=18 where name='$playerName'";
                mysql_query($updateplayer) or die("no Loan given at all");

                print   "Upgraded to Professional!";
            }

        else if ($playerIntelligence == 3){
                $updateplayer = "update players set loan=120000, interest = 40, tmoney = tmoney + loan, total_loan = total_loan + loan + 48000, time=21 where name='$playerName'";
                mysql_query($updateplayer) or die("no Loan given");

                print   "Upgraded to Manager!";
            }

        else if ($playerIntelligence == 4){
                $updateplayer = "update players set loan=400000, interest = 50, tmoney = tmoney + loan, total_loan = total_loan + loan + 200000, time=33 where name='$playerName'";
                mysql_query($updateplayer) or die("no Loan given");

                print   "Upgraded to CEO!";
            }
        }


    $playerIntelligence = $player3['intelligence'];
    $playerName = $player3['name'];
    $playerTmoney = $player3['tmoney'];
    $playerProfession = $player3['profession'];
    $playerLoan = $player3['tloan'];

?>