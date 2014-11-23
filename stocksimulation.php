<?php
    include 'stockmarketscript.php';
?>

<?php

    $grabber = new StockMarketGrabber();
    $dataset = $grabber->grabTop(200);
    
    $advancer = new StockMarketLimitless($dataset);
    $advancer->advanceByDay();
    $dataset = $advancer->getStocks();

    $grabber->updateEntriesBySymbol($dataset);
?>
