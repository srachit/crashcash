<?php
error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include 'stockmarket_connect.php';

class StockMarketGrabber
{
    private $connector;
    public function __construct()
    {
        $this->connector = new StockMarketConnector();
        if (!$this->connector->isconnected())
            printf("Could not connect to database.<br>");
    }

    /* Grabs the topmost n elements from the database */
    function grabTop($n)
    {

        $queryinfo = "SELECT * FROM stocks LIMIT $n";

        $returndata = $this->connector->submitQuery($queryinfo);

        return $returndata;
    }

    function grabSpecific($list)
    {
        $includestr = "(";

        for ($i = 0; $i < count($list); $i++)
        {
            $includestr .= "'";
            $includestr .= $list[$i];
            $includestr .= "'";
            if ($i < count($list)-1)
                $includestr .= ",";

        }

        $includestr .= ")";
        
        $querystr = "SELECT * FROM stocks WHERE symbol in $includestr";

        $returndata = $this->connector->submitQuery($querystr);

        return $returndata;
    }
}

class StockMarketRanker
{
    function __construct()
    {
    }

    function comparePriceMax( $a, $b )
    {
        return floatval($a["price"]) > floatval($b["price"]);
    }

    function comparePriceMin( $a, $b )
    {
        return floatval($a["price"]) < floatval($b["price"]);
    }

    function compareChangeMax( $a, $b )
    {
        return floatval($a["up_down_amount"]) < floatval($b["up_down_amount"]);
    }

    function compareChangeMin ( $a, $b )
    {
        return !$this->compareChangeMax($a, $b);
    }
    
    function compareSymbolAlphabetMax( $a, $b )
    {
        return strnatcmp($a["symbol"], $b["symbol"]);
    }

    function compareSymbolAlphabetMin( $a, $b )
    {
        return $this->compareSymbolAlphabetMax($b, $a);
    }

    function compareFullNameAlphabetMax( $a, $b )
    {
        return strnatcmp($a["full_name"], $b["full_name"]);
    }

    function compareFullNameAlphabetMin($a, $b)
    {
        return $this->compareFullNameAlphabetMax($b, $a);
    }

    function sortMax( &$data, $cmpFunc )
    {
        /* Sorts from greatest to least */
        usort($data, array($this, $cmpFunc . 'Max'));
    }

    function sortMin ( &$data, $cmpFunc )
    {
        usort($data, array($this, $cmpFunc . 'Min'));
    }
}

class StockMarketLimitless
{
    private $stocks;
    function __construct( $stocklist )
    {
        $this->stocks = $stocklist;
    }

    function getStocks()
    {
        return $this->stocks;
    }

    function advanceByDay()
    {
        $rand = mt_rand(1,10);

        for ($i = 0; $i < $rand; $i++)
        {
            $this->singleAdvance(TRUE);
        }
    }

    function advanceByWeek()
    {
        $ranker = new StockMarketRanker();
        for ($i = 0; $i < 5; $i++)
        {
            $ranker->sortMax($this->stocks, 'comparePrice');
            $ranker->sortMax($this->stocks, 'compareChange');
            $this->advanceByDay();
        }
    }

    function f_rand($min=0,$max=1,$mul=1000000){
        if ($min>$max) return false;
        return mt_rand($min*$mul,$max*$mul)/$mul;
    }

    function singleAdvance($multipleAdvance)
    {
        /* Sort the list to make sure that the higher-ranked stocks are on top
         * */

        if ($multipleAdvance == FALSE)
        {
            $ranker = new StockMarketRanker();
            $ranker->sortMax($this->stocks, 'comparePrice');
            $ranker->sortMax($this->stocks, 'compareChange'); 
        }
        /* Stocks are sorted to commit bias */
        
        /* For each stock in the list, we change their values with bias to their
         * position in the list. 
         * 
         * Higher stocks have less of a chance of falling, but also not too much
         * of a chance of increasing.
         *
         * Mid range stocks have an equal chance of falling and increasing.
         *
         * Lower range stocks have a higher chance of increasing but when it
         * falls it falls hard.
         *
         */
        for ($i = 0; $i < count($this->stocks); $i++)
        {
 
            /*printf("Pre print of stock %s: (%f) (%f)<br>", 
            $this->stocks[$i]['symbol'],
            $this->stocks[$i]['up_down_amount'],
            $this->stocks[$i]['price']
            );*/

            $tempval = $this->stocks[$i]['up_down_amount'];
            $increaseprobability = .5; // Start off with a 50% chance for all 
            $gains = 0.0; // in percentage
            $finalchange = 0.0;

            /* Augment probability of increase by the position of the stock */
            if ( $i <= (count($this->stocks)*.01) ) {
                $increaseprobability = $this->f_rand(0.3, 0.6);
                $gains += 0.03;
            }
            else if ( $i <= (count($this->stocks)*.50) ) /* Midsection */
            {
                $increaseprobability = $this->f_rand(0.4, 0.6);
                $gains += 0.09;
            }
            else /* Bottom stocks */
            {
                $increaseprobability = $this->f_rand(0.35, 0.92);
                $gains += 0.3;
            }

            /* Next, augment gains by current price of product */
            /*if ( floatval($this->stocks[$i]['price']) > 300.0 )
            {
                if ($gains >= 0.5)
                    $gains /= 2;
            }*/
            
            /* Calculate whether we will increase or decrease */
            $randnum = $this->f_rand(0, 1);

            /*printf("Random number: %f, increase: %f, decrease: %f<br>",
            $randnum,
            $increaseprobability,
            $decreaseprobability);*/

            if ($randnum <= $increaseprobability)
            {
                if (floatval($this->stocks[$i]['price']) > 0)
                        $finalchange =
                        abs(floatval($this->stocks[$i]['price'])) * $gains;
                else
                        $finalchange = $gains;
            }
            else 
            {
                $finalchange =
                abs(floatval($this->stocks[$i]['price'])) * ($gains);
                $finalchange = -$finalchange;
            }

            
            $this->stocks[$i]['up_down_amount'] = $finalchange;
            $this->stocks[$i]['price'] += $finalchange;

            if ($this->stocks[$i]['price'] < 0) $this->stocks[$i]['price'] = 0;

            /*printf("Final result of stock %s: (%f) (%f)<br>", 
            $this->stocks[$i]['symbol'],
            $this->stocks[$i]['up_down_amount'],
            $this->stocks[$i]['price']
            );*/

            //printf("<br>");
        }
    }
}

?>
