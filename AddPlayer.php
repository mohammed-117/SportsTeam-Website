<!DOCTYPE html>
<html>
<head>
<body bgcolor="lightblue">
        <h1 style="text-align:center">Cal State Fullerton Basketball Statistics</h1>
			    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
        <link rel="stylesheet" href="stylesheets/stylesheet.css">	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body bgcolor="lightblue">
<title>Add-Player</title>
<?php
      require_once('createDB.php');
     
       if ($_SESSION['UserRole'] == 'Observer') {
           
            header("location: welcome.php");
            echo('Get out');
          }

           require_once('navbar.php');
	    require('Name.php');
	    require('PlayerStatistic.php');
	  
		  
////////////////////////////// ---QUERY 2---- ///////////////////////////////////////////////
		// Build query to retrieve player's name, address, and averaged statistics from the joined Team Roster and Statistics tables
        $query = "SELECT
		

		
                    TeamRoster.ID,
                    TeamRoster.Name_First,
                    TeamRoster.Name_Last,


                    Statistics.TotalGames,
                    AVG(Statistics.PlayingTimeMin),
                    AVG(Statistics.PlayingTimeSec),
                    AVG(Statistics.Points),
                    AVG(Statistics.Assists),
                    AVG(Statistics.Rebounds)
                  FROM TeamRoster LEFT JOIN Statistics ON
                    Statistics.Player = TeamRoster.ID
                  GROUP BY
                    TeamRoster.Name_Last,
                    TeamRoster.Name_First
                  ORDER BY
                    TeamRoster.Name_Last,
                    TeamRoster.Name_First";

        // Prepare, execute, store results, and bind results to local variables
        $stmt = mysqli_prepare($link,$query);   //PR
        // no query parameters to bind
        mysqli_stmt_execute($stmt);           //PR
        mysqli_stmt_store_result($stmt);      //PR
        mysqli_stmt_bind_result($stmt,        //PR
						   
						   
						   $Name_ID,
                           $Name_First,
                           $Name_Last,


                           $TotalGames,
                           $PlayingTimeMin,
                           $PlayingTimeSec,
                           $Points,
                           $Assists,
                           $Rebounds);
      

/////////////////////////////////////////////////////////////////////////////////////////////		  
	  
	  
	  ////////////////////// USE CASE 2 /////////////////////////////
?>

    <table style="width: 100%; border:0px solid black; border-collapse:collapse;">
      <tr>
        <th style="width: 40%;">Name Add Request</th>
      </tr>
	  
      <tr>
        <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter Name and Address -->
          <form action="processAddressUpdate.php" method="post">
            <table style="width: 15%; border:0px solid black; border-collapse:collapse;">
              <tr>
                <td style="text-align: right;height:35px; background: lightblue;">First Name</td>
                <td><input type="text" name="firstName" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right;height:35px; background: lightblue;">Last Name</td>
               <td><input type="text" name="lastName" value="" size="35" maxlength="250"/></td>
              </tr>


              <tr>
               <td colspan="2" style="text-align: center;"><br/><br/><input class="pure-button pure-button-primary" type="submit" value="Add Name" /><br/><br/></td>
              </tr>
			  
            </table>
          </form>
        </td>


      </tr>
    </table>

	<br/><br/>

    <h2 style="text-align:center">Player Statistics</h2>


    <table style="border:1px solid black; border-collapse:collapse;">

      <tr>
        <th style="vertical-align:top; width:200px; height:35px;  border:1px solid black; background: lightgreen;"></th>
        <th style="vertical-align:top; width:200px; height:35px;  border:1px solid black; background: lightgreen;">Player Name</th>
        

        <th style="vertical-align:top; width:200px; height:35px;  border:1px solid black; background: lightgreen;">Games Played</th>
        <th style="vertical-align:top; width:200px; height:35px;  border:1px solid black; background: lightgreen;">Time on Court</th>
        <th style="vertical-align:top; width:200px; height:35px;  border:1px solid black; background: lightgreen;">Points Scored</th>
        <th style="vertical-align:top; width:200px; height:35px;  border:1px solid black; background: lightgreen;">Number of Assists</th>
        <th style="vertical-align:top; width:200px; height:35px;  border:1px solid black; background: lightgreen;">Number of Rebounds</th>
      </tr>
      <?php
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
        mysqli_stmt_data_seek($stmt,0);   // PR
        $row_number = 0;

        // for each row (record) of data retrieved from the database emit the html to populate a row in the table

         while( mysqli_stmt_fetch($stmt) )   // PR
        {
          // construct Address and PlayerStatistic objects supplying as constructor parameters the retrieved database columns
          $player = new Nameplayer([$Name_First, $Name_Last]);
          $stat   = new PlayerStatistic([$Name_First, $Name_Last], [$PlayingTimeMin, $PlayingTimeSec], $Points, $Assists, $Rebounds);

          // Emit table row data using appropriate getters from the Address and PlayerStatistic objects
          echo "      <tr>\n";
          echo "        <td  $fmt_style>".++$row_number."</td>\n";
          echo "        <td  $fmt_style>".$player->name()." </td>\n";
          echo "        <td  $fmt_style>".$TotalGames."</td>\n";
          if($TotalGames>0)
          {
            echo "        <td  $fmt_style>".(int)$PlayingTimeMin.":".(int)$PlayingTimeSec."</td>\n";
            echo "        <td  $fmt_style>".$stat->pointsScored()."</td>\n";
            echo "        <td  $fmt_style>".$stat->assists()."</td>\n";
            echo "        <td  $fmt_style>".$stat->rebounds()."</td>\n";
          }
          else
          {
            echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
            echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
            echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
            echo "        <td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>\n";
          }
          echo "      </tr>\n";
        }
      ?>
    </table>

  </body>
</html>
