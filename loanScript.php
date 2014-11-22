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
    $playerLoan = $player3['total_loan'];
    $playerGotLoan = $player3['any_loan'];

    if(isset($_POST['upgrade']))
    {
        if ($playerIntelligence == 1 && $playerGotLoan == false){
                $updateplayer = "Update players set loan=20000, interest = 20, tmoney = tmoney + loan, total_loan = total_loan + loan + 4000, time=15, any_loan = true where name='$playerName'";
                mysql_query($updateplayer) or die("no Loan given");

                print   "You've got a 20000 loan";
            }

        else if ($playerIntelligence == 2 && $playerGotLoan == false){
                $updateplayer = "update players set loan=50000, interest = 30, tmoney = tmoney + loan, total_loan = total_loan + loan + 15000, time=18, any_loan = true where name='$playerName'";
                mysql_query($updateplayer) or die("no Loan given");

                print   "You've got a 50000 loan";
            }

        else if ($playerIntelligence == 3 && $playerGotLoan == false){
                $updateplayer = "update players set loan=120000, interest = 40, tmoney = tmoney + loan, total_loan = total_loan + loan + 48000, time=21, any_loan = true where name='$playerName'";
                mysql_query($updateplayer) or die("no Loan given");

                print   "You've got a 120000 loan";
            }

        else if ($playerIntelligence == 4 && $playerGotLoan == false){
                $updateplayer = "update players set loan=400000, interest = 50, tmoney = tmoney + loan, total_loan = total_loan + loan + 200000, time=33, any_loan = true where name='$playerName'";
                mysql_query($updateplayer) or die("no Loan given");

                print   "You've got a 400000 loan";
            }
        }


    $playerIntelligence = $player3['intelligence'];
    $playerName = $player3['name'];
    $playerTmoney = $player3['tmoney'];
    $playerProfession = $player3['profession'];
    $playerLoan = $player3['tloan'];

?>