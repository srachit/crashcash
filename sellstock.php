<?php
include_once 'connect.php';
session_start();
if (isset($_SESSION['player']))
{
    $player = $_SESSION['player'];
}
else
{
    echo "Not logged in.";
    exit;
}

$player1 = "SELECT * from players where name = '$player'";
$player2 = mysql_query($player1) or die ("could not select players");
$player3 = mysql_fetch_array($player2);

if (isset($_POST['symbol']) && isset($_POST['price']))
{
    $targetsymbol = $_POST['symbol'];
    $targetprice = $_POST['price'];

    $oldstocks = explode(",", $player3['stocks']);
    $replacementstocks = "";

    for ($i = 0; $i < count($oldstocks); $i++)
    {
        if ($oldstocks[$i] != $targetsymbol)
        {
            $replacementstocks .= $oldstocks[$i];
        }

        if ($i < count($oldstocks)-2)
            $replacementstocks .= ",";
    }

    $newmoney = intval($player3['tmoney'] + $targetprice);


    $updatequery = "UPDATE players SET tmoney=" . $newmoney . ", stocks='" .
    $replacementstocks . "' WHERE name='" . $player3['name'] . "'";


    mysql_query($updatequery) or die ("Could not update symbols");

    echo "Stock " . $targetsymbol . " sold for " . $targetprice . "!<br>";
}

?>
