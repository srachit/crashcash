<?php
    include 'connect.php';
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
    $playerMoney = $player3['tmoney'];
    $playerEducation = $player3['profession'];
    $playerLoan = $player3['total_loan'];

    //Amount paying back
    $loanPayback = $_POST['loanAmount'];

    if($loanPayback <= 0)
    {
        echo "You didn't pay anything back!";
        echo "<a href='loan.php'>Go back</a><br>";
        exit;
    }
    else if ( ($playerLoan - $loanPayback) == 0)
    {
            $random = $playerMoney - $loanPayback;
            $updateplayer = "Update players set loan=0, interest = 0, tmoney = '$random', total_loan = 0, any_loan = false where name='$playerName'";
            mysql_query($updateplayer) or die("no Loan paid back!");

            print   "something print here";
    }
    else{
        $random = $playerMoney - $loanPayback;
        $random2 = $playerLoan - $loanPayback;
         $updateplayer = "Update players set tmoney ='$random', total_loan ='$random2' where name='$playerName'";
        mysql_query($updateplayer) or die("no Loan paid back at all!");

        print   "something print here please";
    }

?>
