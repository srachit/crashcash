<?php

class StockMarketConnector
{
    private $db;
    function __construct()
    {
            $this->db = mysqli_connect("217.199.187.189", "cl54-crashcash", "ucsdUSERS") or die("Cannot connect to db");

            if (!$this->db)
                die("No database allocated.");
            
            if (!mysqli_select_db($this->db, "cl54-crashcash"))
                die("No database selected in alloc.");
    }

    function isconnected()
    {
        return (!$this->db) ? FALSE : TRUE;
    }

    function submitQuery($querystr)
    {
        $queryreturn = mysqli_query($this->db, $querystr);

        if ($queryreturn == FALSE)
            return NULL;

        $finalarray = array();
        while ($row = mysqli_fetch_array($queryreturn))
        {
            array_push($finalarray, $row);
        }

        return $finalarray;
    }

}

?>
