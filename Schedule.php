<!DOCTYPE html>
<html>
<head>
<body bgcolor="lightblue">
        <h1 style="text-align:center">Cal State Fullerton Basketball Statistics</h1>
			    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
        <link rel="stylesheet" href="stylesheets/stylesheet.css">	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body bgcolor="lightblue">
<title>Schedule</title>
<?php
      require_once('navbar.php');
	  require_once('createDB.php');
	  require('Address.php');
      require('PlayerStatistic.php');
	  

/////////////////////////////// ---QUERY 3---- ///////////////////////////////////////////////		  

$query3 = "SELECT t1.GameRound, t1.TeamID_A, t1.TeamAPoints, t1.DateTracker, t2.TeamName
				FROM GP_Team AS t1 INNER JOIN LeagueTeam AS t2
				 ON t1.TeamID_A = t2.TeamID
				 ORDER BY GameRound"; 
				
		  if(!$result3 = mysqli_query($link,$query3)) 
		  {
			  die('There was an error running query:3 ');
		  }

							  

/////////////////////////////// ---QUERY 4---- ///////////////////////////////////////////////

  $query4 = "SELECT t1.GameRound, t1.TeamID_B, t1.TeamBPoints, t1.DateTracker, t2.TeamName
				FROM GP_Team AS t1 INNER JOIN LeagueTeam AS t2
				 ON t1.TeamID_B = t2.TeamID
				 ORDER BY GameRound"; 
				 
		  if(!$result4 = mysqli_query($link,$query4))
		  {
			  die('There was an error running query:4 ');
		  }
	
////////////////////////////////////////---QUERY 5---- /////////////////////////////////////////////////////
	 $query5 = "SELECT    TeamID_A, TeamAPoints, TeamID_B, TeamBPoints, DateTracker, Months, Days, Years
                           FROM GP_Team
						   ORDER BY GameRound";	 
                     // result5 changed to stmt 
	    $stmt2 = mysqli_prepare($link,$query5);  
        // no query parameters to bind
        mysqli_stmt_execute($stmt2);           
        mysqli_stmt_store_result($stmt2);     
        mysqli_stmt_bind_result($stmt2,	     
								$TeamID_A,
								$TeamAPoints,								
								$TeamID_B,
								$TeamBPoints,
		                        $DateTracker,
                                $Months,
								$Days,
								$Years );
								
			if(!$stmt2 = mysqli_query($link,$query5) )
	  		  {
			  die('There was an error running query:5 ');
	     	  }
	  ////////////////////// USE CASE 3 /////////////////////////////
?>
<table style="width: 100%; border:0px solid black; border-collapse:collapse;">
      <tr>
        <th style="width: 40%;"><h2>Game Schedules</h2></th>
      </tr>
	  
      <tr>
        <td style="vertical-align:top; border:1px solid black;">
                 <form action="" method="post">
			    <table style="width: 20%; border:0px solid black; border-collapse:collapse;">
				<tr>
                <td style="text-align: left;height:35px; background: lightblue;">Date (Month-Day-Year)</td>
				</tr>
                <td><select name="datetracker" required>
                  <option value="" selected disabled hidden>Choose a date</option>
                  <?php
				
		  if(mysqli_num_rows($stmt2) > 0 ){    
				$i = 1;
				while ($row5 = mysqli_fetch_array($stmt2)) 
			    {
			     echo "<option value=\"$i\">".$row5['Months']."-".$row5['Days']."-".$row5['Years']."</option>\n";
		         ++$i;
				}
		     }    
			 
                  ?>
                </select></td>
              </tr>		  
			  
              <tr>
			  
              <td colspan="2" style="text-align: left;"><br/><br/><input class="pure-button pure-button-primary" type="submit" value="Search Date" /><br/><br/></td>
              </tr>
			  
           
			 </table>
          </form>
        </td>
      </tr>
    </table>	 
		 
		 
		 <br/><br/>

<table style="border:1px solid black; border-collapse:collapse;">
      <tr>
	
        <th colspan="1" style="vertical-align:top; width:200px; height:35px; border:1px solid black; background: lightblue;">MatchUp</th>
        <th colspan="1" style="vertical-align:top; width:200px; height:35px; border:1px solid black; background: lightblue;">Results</th>
        
      </tr>
	  
      <?php
        $fmt_style = 'style="vertical-align:top; border:1px solid black;"';

		if(isset($_POST['datetracker']) && ($_POST['datetracker'] > 0))
		{
	      $option2 = $_POST['datetracker'];   
	
		
		
  
	
		if($option2 != NULL)
	{ // valid	

		  
		   if((mysqli_num_rows($result3) > 0) && ( mysqli_num_rows($result4) > 0) ){               
           	

				while (($row = mysqli_fetch_array($result3)) && ($row2 = mysqli_fetch_array($result4)) )  
			    { 
			
	  if((int)$option2 === (int)$row['DateTracker'])
	    {
		
          // Emit table row data 
          echo "      <tr>\n";
			//	echo "<td  $fmt_style>". $row5['Months']."-".$row5['Days']."-".$row5['Years'] . "</td>\n";
				echo "<td  $fmt_style>". $row['TeamName'] ."<br/>-vs-<br/>".$row2['TeamName']. "</td>\n";
				echo "<td  $fmt_style>". $row['TeamAPoints'] ."<br/>---<br/>".$row2['TeamBPoints']. "</td>\n";

          echo "      </tr>\n";
         }
	   }
	   ob_start();
     }   
   }
 }
	  

      ?>
</table>



</body>
</head>
</html>
