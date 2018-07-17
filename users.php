
<!DOCTYPE>
<html>
<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Users</title>
<?php
       require_once('navbar.php');
       require_once('createDB.php');
       
       if ($_SESSION['UserRole'] != 'Executive Manager') {
           
            header("location: welcome.php");
            echo('Get out');
          }

       $sql = "SELECT Name_First, Name_Last, Email, UserName, Password, Role From UserLogin";
       $query = mysqli_query($link, $sql);
            if (!$query) {
	              die ('SQL Error: ' . mysqli_error($link));
              }
?>

<table class="table table-bordered table-dark">
    <h2> Users Infromation</h2>
    <?php
        require('navbarManager.php')
    ?>
      <tr>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">First Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Last Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Email</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Password</th>
        <th style="vertical-align:top; border:1px solid black; background: lightblue;">Role</th>
      </tr>
      <?php

        // for each row (record) of data retrieved from the database emit the html to populate a row in the table
        // for example:
        //  <tr>
        //    <td  style="vertical-align:top; border:1px solid black;">1</td>
        //    <td  style="vertical-align:top; border:1px solid black;">Dog, Pluto</td>
        //    <td  style="vertical-align:top; border:1px solid black;">1313 S. Harbor Blvd.<br/>Anaheim, CA 92808-3232<br/>USA</td>
        //    <td  style="vertical-align:top; border:1px solid black;">1</td>
        //    <td  style="vertical-align:top; border:1px solid black;">10:0</td>
        //    <td  style="vertical-align:top; border:1px solid black;">18</td>
        //    <td  style="vertical-align:top; border:1px solid black;">2</td>
        //    <td  style="vertical-align:top; border:1px solid black;">4</td>
        //  </tr>
        // or if there exists no statistical data for the player
        //  <tr>
        //    <td  style="vertical-align:top; border:1px solid black;">2</td>
        //    <td  style="vertical-align:top; border:1px solid black;">Duck, Daisy</td>
        //    <td  style="vertical-align:top; border:1px solid black;">1180 Seven Seas Dr.<br/>Lake Buena Vista, FL 32830<br/>USA</td>
        //    <td  style="vertical-align:top; border:1px solid black;">0</td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //  </tr>
        //
        while($row=mysqli_fetch_array($query))
        {
          // construct Address and PlayerStatistic objects supplying as constructor parameters the retrieved database columns

          // Emit table row data using appropriate getters from the Address and PlayerStatistic objects
          echo "      <tr>";
          echo "        <td>".$row['Name_First']."</td>";
          echo "        <td>".$row['Name_Last']."</td>";
          echo "        <td>".$row['Email']."</td>";
          echo "        <td>".$row['Password']."</td>";
          echo "        <td>".$row['Role']."</td>";
          echo "      </tr>";
        }
        ob_start();
      ?>
    </table>

</body>
</head>
</html>