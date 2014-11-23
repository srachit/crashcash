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

if (isset($_POST['stockNameInput']))
{
    $targetsymbol = $_POST['stockNameInput'];

    $oldstocks = explode(",", $player3['stocks']);
    $replacementstocks = "";
    $duplicate = FALSE;

    for ($i = 0; $i < count($oldstocks); $i++)
    {
        if ($oldstocks[$i] != $targetsymbol)
        {
            $replacementstocks .= $oldstocks[$i];
        }
        else {
            $duplicate = TRUE;
            break;
        }

        if ($i < count($oldstocks)-1)
            $replacementstocks .= ",";
    }

    if ($duplicate == FALSE) {
        $replacementstocks .= ",";
        $replacementstocks .= $targetsymbol;
    }

    include 'stockmarketscript.php';
    $grabber = new StockMarketGrabber();
    $stockentry = $grabber->grabSpecific(array($targetsymbol));
    if (!$stockentry)
        die("Stock not found");
    $targetprice = NULL;
    foreach ($stockentry as &$sentry)
    {
        $targetprice = $sentry["price"];
    }

    $newmoney = intval($player3['tmoney'] - $targetprice);


    $updatequery = "UPDATE players SET tmoney=" . $newmoney . ", stocks='" .
    $replacementstocks . "' WHERE name='" . $player3['name'] . "'";


    mysql_query($updatequery) or die ("Could not update symbols");
    echo "Stock " . $targetsymbol . " bought for " . $targetprice;
    header("refresh:1; url=stockmarket.php");
}


?>
