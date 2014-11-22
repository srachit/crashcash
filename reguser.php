<?php
    include 'connect.php'
?>

<?
    $player = $_POST['username'];
    $password = $_POST['password1'];
    $password2 = $_POST['password2'];
    $player = strip_tags($player);
    $email = $_POST['email'];
    $email = strip_tags($email);

    if($email == "")
    {
        echo "You didn't enter an email address!";
        echo "<a href='register.php'>Go back</a><br>";
        exit;
    }
    if($password == $password2)
    {
        $isplayer = "SELECT * from players where name='$player'";
        $isplayer2 = mysql_query($isplayer) or die ("Could not query players table");
        $isplayer3 = mysql_fetch_array($isplayer2);
        if(!$_POST['password1'] || !$_POST['password2'])
        {
            print "You did not enter a password";
            echo "<a href='register.php'>Go back</a><br>";
            exit;
        }
        else if($isplayer3 || strlen($player)>21 || strlen($player)<1)
        {
            print   "There is already a player of that name or the name you specified is over 21 letters or less than 1 letter";
            echo    "<a href='register'>Go back</a><br>";
            exit;
        }
        else
        {
            $isaddress = "SELECT * from players where email='$email'";
            $isaddress2 = mysql_query($isaddress) or die ("not able to query for email");
            $isaddress3 = mysql_fetch_array($isaddress2);
            if($isaddress3)
            {
                print   "There is already a player with that email address";
                echo    "<a href='register.php'>Go back</a><br>";
                exit;
            }
            else
            {
                $password = md5($password);
                $SQL = "INSERT into players(name, password, email, money, intelligence, energy, profession, gambleLoss, tmoney, tenergy)
                                     VALUES('$player', '$password', '$email', '3000', '1', '5', 'Janitor', '0', '3000', '100')";
                mysql_query($SQL) or die ("Could not register");

                print   "Thank you for registering!";
                echo    "<a href='index.php'>Go back to main page and login!</a><br>";
            }
        }
    }

    else
    {
        print   "Your password didn't match or you did not enter a password";
        echo    "<a href='register.php'>Go back</a><br>";
        exit;
    }


?>