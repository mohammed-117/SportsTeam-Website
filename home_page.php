<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>CPSC 431 Project</title>
  </head>

  <body>
    <h1 style="text-align:center">Cal State Fullerton Basketball Statistics</h1>

    <?php
      require('navbar.php');
      require('Address.php');
      require('PlayerStatistic.php');
      require_once('createDB.php');
	    $link = mysqli_connect(DATA_BASE_HOST, $DBName, $DBPassword, DATA_BASE_NAME);

      // if connection was successful
      if( mysqli_connect_error() == 0 )  // Connection succeeded    PR
      {
////////////////////////////// ---QUERY 2---- ///////////////////////////////////////////////
		  $querytwo = "SELECT * FROM LeagueTeam";
		  if(!$resulttwo = mysqli_query($link,$querytwo))  //PR
		  {
			  die('There was an error running the query part 2 ');
		  }

/////////////////////////////// ---QUERY 3---- ///////////////////////////////////////////////		  

$query3 = "SELECT t1.GameRound, t1.TeamID_A, t1.TeamAPoints, t1.DateTracker, t2.TeamName
				FROM GP_Team AS t1 INNER JOIN LeagueTeam AS t2
				 ON t1.TeamID_A = t2.TeamID
				 ORDER BY GameRound"; 
				
           // Check connection
             if($link === false){
              die("ERROR: Could not connect. " . mysqli_connect_error()); //PR
                              }

							  

/////////////////////////////// ---QUERY 4---- ///////////////////////////////////////////////

  $query4 = "SELECT t1.GameRound, t1.TeamID_B, t1.TeamBPoints, t1.DateTracker, t2.TeamName
				FROM GP_Team AS t1 INNER JOIN LeagueTeam AS t2
				 ON t1.TeamID_B = t2.TeamID
				 ORDER BY GameRound"; 
				
          //  Check connection
             if($link === false){
             die("ERROR: Could not connect. " . mysqli_connect_error()); // PR
                              }
							  
							  
////////////////////////////////---QUERY 5----//////////////////////////////////////////////////////////////////
	 $query5 = "SELECT    TeamID_A, TeamAPoints, TeamID_B, TeamBPoints, DateTracker, Months, Days, Years
                           FROM GP_Team
						   ORDER BY GameRound";	 
                     // result5 changed to stmt 
	    $stmt2 = mysqli_prepare($link,$query5);  //PR
        // no query parameters to bind
        mysqli_stmt_execute($stmt2);           //PR
        mysqli_stmt_store_result($stmt2);     // PR
        mysqli_stmt_bind_result($stmt2,	     // PR
								$TeamID_A,
								$TeamAPoints,								
								$TeamID_B,
								$TeamBPoints,
		                        $DateTracker,
                                $Months,
								$Days,
								$Years );
														  
							  
          
/////////////////////////////////////////////////////////////////////////////////////////////////


		  
        
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
      }
    ?>

    <table style="width: 100%; border:0px solid black; border-collapse:collapse;">
      <tr>
        <th style="width: 40%;">Name and Address</th>
        <th style="width: 60%;">Players</th>
      </tr>
      <tr>
        <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter Name and Address -->
          <form action="processAddressUpdate.php" method="post">
            <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">First Name</td>
                <td><input type="text" name="firstName" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Last Name</td>
               <td><input type="text" name="lastName" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Street</td>
               <td><input type="text" name="street" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">City</td>
                <td><input type="text" name="city" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">State</td>
                <td><input type="text" name="state" value="" size="35" maxlength="100"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Country</td>
                <td><input type="text" name="country" value="" size="20" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Zip</td>
                <td><input type="text" name="zipCode" value="" size="10" maxlength="10"/></td>
              </tr>

              <tr>
               <td colspan="2" style="text-align: center;"><input type="submit" value="Add Name and Address" /></td>
              </tr>
            </table>
          </form>
        </td>

        <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter game statistics for a particular player -->
          <form action="processStatisticUpdate.php" method="post">
            <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">Name (Last, First)</td>
<!--            <td><input type="text" name="name" value="" size="50" maxlength="500"/></td>  -->
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
               <td colspan="2" style="text-align: center;"><input type="submit" value="Player Statistics" /><br/><br/></td>
              </tr>
	      </table>
          </form>
	     </td>
       </tr>
    </table>  
	
			  <br/><br/>
			      <table style="width: 100%; border:0px solid black; border-collapse:collapse;">
      <tr>
        <th style="width: 40%;">Game Schedules </th>
                 <form action="" method="post">
			    <table style="width: 100%; border:0px solid black; border-collapse:collapse;">
                <td style="text-align: left; background: lightblue;">Date (dd-mm-yyyy)</td>
				
<!--            <td><input type="text" name="name" value="" size="50" maxlength="500"/></td>  -->
                <td><select name="datetracker" required>
                  <option value="" selected disabled hidden>Choose a date</option>
                  <?php
				
				  
		  	  if($stmt2 = mysqli_query($link,$query5) ){  //PR
		  if(mysqli_num_rows($stmt2) > 0 ){     //PR
				$i = 1;
				while ($row5 = mysqli_fetch_array($stmt2))  // PR
			  {
			     echo "<option value=\"$i\">".$row5['Months']."-".$row5['Days']."-".$row5['Years']."</option>\n";
		         ++$i;
				}
		    
		
		 }  
		  }  
                  ?>
                </select></td>
              </tr>		  
			  
              <tr>
               <td colspan="2" style="text-align: center;"><input type="submit" value="Search Date" /></td>
              </tr>
			  
           
			 </table>
          </form>
        </td>
      </tr>
    </table>
	
<title>////////////////////// USE CASE 1 /////////////////////////////</title>
<h2 style="text-align:center">Team League Chart</h2>
<table style="border:1px solid black; border-collapse:collapse;">
      <tr>
       <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;"></th>
        <th colspan="2" style="vertical-align:top; border:1px solid black; background: lightblue;">Team Names</th>
        
        
      </tr>
      <?php
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
        mysqli_stmt_data_seek($stmt,0); //PR
        $row_number = 0;

        while( mysqli_stmt_fetch($stmt) )   // PR
        {

          echo "      </tr>\n";
          // Emit table row data using table LeagueTeam
          echo "      <tr>\n";
				while ($row = mysqli_fetch_assoc($resulttwo)) // PR
			{
				echo "<tr><td  $fmt_style>".++$row_number."</td>";
				echo "<td  $fmt_style>".($row['TeamName'])."</td></tr>";
			
			}
          echo "      </tr>\n";
        }
      ?>
</table>




<title>////////////////////// USE CASE 2 /////////////////////////////</title>
<h2 style="text-align:center">Player Stats</h2>
<table style="border:1px solid black; border-collapse:collapse;">
      <tr>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">Name</th>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">Games Played</th>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">Time on Court</th>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">Points Scored</th>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">Number of Assists</th>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">Number of Rebounds</th>
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

<title>////////////////////// USE CASE 3 /////////////////////////////</title>
<h2 style="text-align:center">Schedule</h2>
<table style="border:1px solid black; border-collapse:collapse;">
      <tr>
	
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">MatchUp</th>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">Result</th>
        
      </tr>
	  
<?php
// refer to login.php for next page transfer
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';

		if(isset($_POST['datetracker']) && ($_POST['datetracker'] > 0))
		{
	$option2 = $_POST['datetracker'];   
	
		
		
  
	
		if($option2 != NULL)
	{ // valid	

		  if(($result3 = mysqli_query($link,$query3)) && ($result4 = mysqli_query($link,$query4))  ){  // PR
		   if((mysqli_num_rows($result3) > 0) && ( mysqli_num_rows($result4) > 0) ){               // PR
           	

				while (($row = mysqli_fetch_array($result3)) && ($row2 = mysqli_fetch_array($result4)) )  // PR
			    { 
			
	  if((int)$option2 === (int)$row['DateTracker'])
	    {
		
          // Emit table row data using appropriate getters from the Address and PlayerStatistic objects
          echo "      <tr>\n";
			//	echo "<td  $fmt_style>". $row5['Months']."-".$row5['Days']."-".$row5['Years'] . "</td>\n";
				echo "<td  $fmt_style>". $row['TeamName'] ."<br/>-vs-<br/>".$row2['TeamName']. "</td>\n";
				echo "<td  $fmt_style>". $row['TeamAPoints'] ."<br/>---<br/>".$row2['TeamBPoints']. "</td>\n";

          echo "      </tr>\n";
        }
	  }
    }   
  }
}

		}


?>
</table>


<title>////////////////////// USE CASE 4 /////////////////////////////</title>
<h2 style="text-align:center">TeamA vs. TeamB Game Stats</h2>
<table style="border:1px solid black; border-collapse:collapse;">
      <tr>
       
  
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;"> Game Round </th>
		<th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">Team Name</th>
		<th colspan="1" style="vertical-align:top; border:1px solid black; background: lightblue;">  Points  </th>
        
      </tr>
      <?php
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
	  
		  if(($result3 = mysqli_query($link,$query3)) && ($result4 = mysqli_query($link,$query4))  ){   // PR
		   if((mysqli_num_rows($result3) > 0) && (mysqli_num_rows($result4) > 0) ){                 // PR
          
				while (($row = mysqli_fetch_array($result3)) && ($row2 = mysqli_fetch_array($result4)) )  // PR
			    {
				echo "      <tr>\n";
			
				echo "<td  $fmt_style>". $row['GameRound'] . "</td>\n";
				echo "<td  $fmt_style>". $row['TeamName'] ."<br/>-vs-<br/>".$row2['TeamName']. "</td>\n";
				echo "<td  $fmt_style>". $row['TeamAPoints'] ."<br/>---<br/>".$row2['TeamBPoints']. "</td>\n";
				
				
				echo "      </tr>\n";
				}
			}
		  mysqli_free_result($result3);   // PR
		  mysqli_free_result($result4);   // PR
		   }
		   else
		   {
        echo "No records matching your query were found.";
          }
	   
	   
	   
    
      ?>
</table>

    <?php
      ////////////////////////////////////////////////////////////////////////////////////////
	  
    ?>
	
	
	
	<title>////////////////////// USE CASE 5 /////////////////////////////</title>
    <h2 style="text-align:center">Player Statistics</h2>

    <?php
      // emit the number of rows (records) in the table
      echo "Number of Records:  ".mysqli_stmt_num_rows($stmt)."<br/>"; // PR
    ?>

    <table style="border:1px solid black; border-collapse:collapse;">
      <tr>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th colspan="2" style="vertical-align:top; border:1px solid black; background: lightgreen;">Player</th>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th colspan="4" style="vertical-align:top; border:1px solid black; background: lightgreen;">Statistic Averages</th>
      </tr>
      <tr>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Address</th>

        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Games Played</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Time on Court</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Points Scored</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Number of Assists</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Number of Rebounds</th>
      </tr>
      <?php
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
        mysqli_stmt_data_seek($stmt,0); //PR
        $row_number = 0;

        while( mysqli_stmt_fetch($stmt) )  //PR
        {
          // construct Address and PlayerStatistic objects supplying as constructor parameters the retrieved database columns
          $player = new Address([$Name_First, $Name_Last], $Street, $City, $State, $Country, $ZipCode);
          $stat   = new PlayerStatistic([$Name_First, $Name_Last], [$PlayingTimeMin, $PlayingTimeSec], $Points, $Assists, $Rebounds);

          // Emit table row data using appropriate getters from the Address and PlayerStatistic objects
          echo "      <tr>\n";
          echo "        <td  $fmt_style>".++$row_number."</td>\n";
          echo "        <td  $fmt_style>".$player->name()."</td>\n";
          echo "        <td  $fmt_style>".$player->street()."<br/>"
                                         .$player->city().', '.$player->state().' '.$player->zip().'<br/>'
                                         .$player->country()."</td>\n";
          echo "        <td  $fmt_style>".$TotalGames."</td>\n";
          if($TotalGames >0)
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
  </body>
</html>
