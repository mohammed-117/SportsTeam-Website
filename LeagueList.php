<!DOCTYPE html>
<html>
<head>
<body bgcolor="lightblue">
        <h1 style="text-align:center">Cal State Fullerton Basketball Statistics</h1>
		
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body bgcolor="lightblue">
<title>League List</title>
<?php
      require_once('navbar.php');
	  require_once('createDB.php');
	  

////////////////////////////// ---QUERY 1---- ///////////////////////////////////////////////
		  $query = "SELECT * FROM LeagueTeam";
		  if(!$result = mysqli_query($link,$query))  //PR
		  {
			  die('There was an error running query:1 ');
		  }

/////////////////////////////////////////////////////////////////////////////////////////////		  
	  
	  
	  ////////////////////// USE CASE 1 /////////////////////////////
?>
<h2>League Teams</h2>
        				   
<table style="border:1px solid black; border-collapse:collapse;">

    <?php
        // require('navbarManager.php')
    ?>
      <tr>
       <th colspan="1" style="vertical-align:top; width:35px;height:35px; border:1px solid black; background: lightblue;">ID</th>
       <th colspan="2" style="vertical-align:top; width:200px;height:35px; border:1px solid black; background: lightblue;">Team Names</th>
      </tr>
      <?php
	  $row_number = 0;
	  $fmt_style = 'style="vertical-align:top; border:1px solid black;"';
	    while($row=mysqli_fetch_array($result))
        {
			echo "      <tr>";
				echo "<tr><td  $fmt_style>".++$row_number."</td>";
				echo "<td  $fmt_style>".($row['TeamName'])."</td></tr>";
			echo "      </tr>";
		}
	  ob_start();
	  
      ?>
</table>



</body>
</head>
</html>