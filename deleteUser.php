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

      $sql = "SELECT ID, Name_First, Name_Last FROM UserLogin";
    $query = mysqli_query($link, $sql);
             if (!$query) {
	              die ('SQL Error: ' . mysqli_error($link));
              }
?>


            
<form class="pure-form pure-form-stacked" method="post" action="deleteUserLogic.php">
    <fieldset>
        <h1>Enter Users Name</h1>
       
        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="email">Email</label>
                <input id="email" class="pure-u-23-24" type="text" name="email">
            </div>
        <button class="pure-button pure-button-primary" type="submit" name="submit" value="submit">Delete</button>
    </fieldset>
</form>
        </div>
         </table>
      </form>


</body>
</head>
</html>