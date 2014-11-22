<?php
    include_once 'connect.php';
    session_start();

    if(isset($_POST['submit']))
    {
        $player = $_POST['username'];
        $password = $_POST['password'];
        $player = strip_tags($player);
        $password = strip_tags($password);
        $password = md5($password);

        $query = "SELECT name, password from players where name='$player' and '$password'";
        $result = mysql_query($query) or die ("Could not query players");
        $result2 = mysql_fetch_array($result);

        if($result2)
        {
            $_SESSION['player'] = $player;

            header("Location: game.php");
        }
        else
        {
            echo    "Wrong username or password. <a href='index.php'>Go back</a>";
        }
    }
?>