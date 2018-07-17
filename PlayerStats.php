<!DOCTYPE html>
<html>
<head>
<body bgcolor="lightblue">
        <h1 style="text-align:center">Cal State Fullerton Basketball Statistics</h1>
			    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
        <link rel="stylesheet" href="stylesheets/stylesheet.css">	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body bgcolor="lightblue">
<title>Player Stats</title>
<?php
      require('navbar.php');
	  require('Address.php');
	  require('PlayerStatistic.php');
      require_once('createDB.php');
////////////////////////////// ---QUERY 2---- ///////////////////////////////////////////////
		// Build query to retrieve player's name, address, and averaged statistics from the joined Team Roster and Statistics tables
        $query = "SELECT
		

		
                    TeamRoster.ID,
                    TeamRoster.Name_First,
                    TeamRoster.Name_Last,
                    TeamRoster.Street,
                    TeamRoster.City,
                    TeamRoster.State,
                    TeamRoster.Country,
                    TeamRoster.ZipCode,

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
                           $Street,
                           $City,
                           $State,
                           $Country,
                           $ZipCode,

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
        <th style="width: 40%;"><h2>Player Stats</h2></th>
      </tr>

        <tr>
        <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter game statistics for a particular player -->
          <form action="processStatisticUpdate.php" method="post">
            <table style="width: 15%; border:0px solid black; border-collapse:collapse;">
                <tr>
                <td style="text-align: left;height:35px; background: lightblue;">Name (Last, First)</td>
                 </tr>
                <td><select name="name_ID" required>
                  <option value="" selected disabled hidden>Choose player's name here</option>
                  <?php
                    // for each row of data returned,
                    //   construct an Address object providing first and last name
                    //   emit an option for the pull down list such that
                    //     the displayed name is retrieved from the Address object
                    //     the value submitted is the unique ID for that player
                    // for example:
                    //     <option value="101">Duck, Daisy</option>
                    mysqli_stmt_data_seek($stmt, 0);  //PR
                    while( mysqli_stmt_fetch($stmt) )  //PR
                    {
                      $player = new Address([$Name_First, $Name_Last]);
                      echo "<option value=\"$Name_ID\">".$player->name()."</option>\n";
                    }
                  ?>
                </select></td>
              </tr>

              
                <tr>
               <td  colspan="2" style="text-align: left;"><br/><br/><input class="pure-button pure-button-primary" type="submit" value="Player Statistics" /><br/><br/></td>
                </tr>
			  
	       </table>
          </form>
	     </td>
		 </tr>
       </table>
    
<br/><br/>

<table style="border:1px solid black; border-collapse:collapse;">
      <tr>
        <th colspan="1" style="vertical-align:top; width:200px; height:35px; border:1px solid black; background: lightblue;">Name</th>
        <th colspan="1" style="vertical-align:top; width:200px; height:35px; border:1px solid black; background: lightblue;">Games Played</th>
        <th colspan="1" style="vertical-align:top; width:200px; height:35px; border:1px solid black; background: lightblue;">Time on Court</th>
        <th colspan="1" style="vertical-align:top; width:200px; height:35px; border:1px solid black; background: lightblue;">Points Scored</th>
        <th colspan="1" style="vertical-align:top; width:200px; height:35px; border:1px solid black; background: lightblue;">Number of Assists</th>
        <th colspan="1" style="vertical-align:top; width:200px; height:35px; border:1px solid black; background: lightblue;">Number of Rebounds</th>
      </tr>
	  
<?php
// refer to login.php for next page transfer
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
		
        mysqli_stmt_data_seek($stmt,0);   // PR
        $row_number = 0;
		
   $option = isset($_POST['name_ID']) ? $_POST['name_ID'] : false;
   
	
	if($option != NULL)
	{ // valid
        while( mysqli_stmt_fetch($stmt) )   // PR
     {
          // construct Address and PlayerStatistic objects supplying as constructor parameters the retrieved database columns
          $player = new Address([$Name_First, $Name_Last]);
          $stat   = new PlayerStatistic([$Name_First, $Name_Last], [$PlayingTimeMin, $PlayingTimeSec], $Points, $Assists, $Rebounds);
          
		 
		  
	  if((int)$option === (int)$Name_ID)
	    {
			
          // Emit table row data using appropriate getters from the Address and PlayerStatistic objects
          echo "      <tr>\n";
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
	 }
	
    }


?>
</table>



</body>
</head>
</html>
