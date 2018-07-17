 <html>
  <head>
    <title>Users Password Change</title>
  </head>
  <body>

  <?php
    require_once('navbar.php');
    require_once('createDB.php');

    $sql = "SELECT ID, Name_First, Name_Last FROM UserLogin";
    $query = mysqli_query($link, $sql);
             if (!$query) {
	              die ('SQL Error: ' . mysqli_error($link));
              }
  ?>
 
 <form action="passwordUpdate.php" method="post">
            <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">Name (Last, First)</td>
                <td><select name="name_ID" required>
                  <option value="" selected disabled hidden>Choose player's name here</option>
                  <?php
                    
                     while ($row = mysqli_fetch_array($query)) {
                        $dropID = $row['ID'];
                        $dropFN = $row['Name_First'];
                        $dropLN = $row['Name_Last'];
                        echo '<option value="'.$dropID.'">'.$dropLN.", ". $dropFN.'</option>';
                    }
                  ?>
                </select></td>
              </tr>
               <tr>
               <td colspan="2" style="text-align: center;"><input type="submit" value="Change Password" /></td>
              </tr>

         </table>
      </form>
   </body>
</html>