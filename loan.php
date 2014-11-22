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
	$playerMoney = $player3['tmoney'];
    $playerEducation = $player3['profession'];
    $playerLoan = $player3['total_loan'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crash Cash</title>

    <!-- Bootstrap -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <link href="CSS/font-awesome.min.css" rel="stylesheet">
    <link href="CSS/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-default" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="game.php">Crash Cash</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <form action="logout.php" class="navbar-form navbar-right" role="search">
            <button type="submit" name="logout" class="btn btn-default">Logout</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
              <li><p class="navbar-text"><span class="navglyp glyphicon glyphicon-user" aria-hidden="true"></span><?php echo $playerName; ?></p></li>   
              <li><p class="navbar-text"><i class="navglyp fa fa-suitcase"></i><?php echo $playerEducation; ?></p></li>
              <li><p class="navbar-text"><i class="navglyp fa fa-money"></i><?php echo $playerMoney; ?></p></li>
          </ul>
        </div><!-- /.navbar-collapse -->
        
        <div class="container-fluid">
            <div class=row>
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li><a href="game.php">Overview <span class="sr-only">(current)</span></a></li>
                        <li><a href="stockmarket.php">Stock Market</a></li>
                        <li><a href="education.php">Education</a></li>
                        <li  class="active"><a href="loan.php">Loan</a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li><a href="bank.php">Bank</a></li>
                        <li><a href="gamble.php">Gambling</a></li>
                        <li><a href="elearn.php">Learn And Earn!</a></li>
                    </ul>
                </div>
            </div>
      </div><!-- /.container-fluid -->
    </nav><!-- End of Navbar -->

    <div class="container">

        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">Panel heading</div>

          <!-- Table -->
          <table class="table">
            <thead>
                <tr>
                    <th>Profession</th>
                    <th>Loan Amount</th>
                    <th>Interest</th>
                    <th>Amount Due by (hours)</th>
                </tr>
            </thead>
            <tbody>
            	<tr>
                    <th>Janitor</th>
                    <th>20000</th>
                    <th>20%</th>
                    <th>15</th>
                </tr>
                <tr>
                    <th>Starbucks</th>
                    <th>50000</th>
                    <th>30%</th>
                    <th>18</th>
                </tr>
                <tr>
                    <th>Professional</th>
                    <th>140000</th>
                    <th>40%</th>
                    <th>21</th>
                </tr>
                <tr>
                    <th>Manager</th>
                    <th>400000</th>
                    <th>50%</th>
                    <th>33</th>
                </tr>
            </tbody>
          </table>
      
          	<div class="panel panel-default">
          		<form method="post" action="loanScript.php" class="navbar-form navbar-right" >
                    <button type="submit" name="upgrade" class="btn btn-default btn-success">Get Loan!</button>
                </form>

                <form method="post" class="form-signup" role="form" action="resetLoan.php">
                    <div class="form-group">
                        <input type="number" class="form-control" name="loanAmount" id="loanAmount" placeholder="tpye amount">
                        <button type="submit" name="loanAmount" class="btn btn-default btn-success">Pay Loan!</button>
                    </div>
                </form>
            </div>


        
	    <div class="panel-body">
			<p>Your loans: <?php echo $playerLoan; ?></p>
			</div>
        </div>
    </div>

    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="JS/bootstrap.min.js"></script>
    </body>
</html>