<?php

  require_once('createDB.php');
  $userName = $_POST['userName']; 
  $password = $_POST['password'];
  $query = "SELECT Roles.roleName, UserLogin.Password FROM UserLogin, Roles WHERE UserName = ?  AND UserLogin.Role = Roles.ID_Role";
  
  $stmt = $link->prepare($query);
  $stmt->bind_param('s', $userName);
 
  if( !($stmt->execute() && $stmt->store_result() && $stmt->num_rows === 1) )
  {
    echo "Login attempt failed<br/>";
    echo "Failure: existing user '$userName' not found<br/>";
    header('location: login.php');
  }
  
 $stmt->bind_result($roleName, $PWHash);
  
  if( ($stmt->fetch()) === FALSE )
  {
    echo "Error: failed to fetch query results: ". $link->error . "<br/>";
        header('location: login.php');

  }
  
  if (!password_verify($password, $PWHash)) 
  {
    echo "Login attempt failed<br/>";
    header('location: login.php');
  } else {

  
    
  echo "Login successful for user: '$userName' as '$roleName'<br/>";
  $_SESSION['UserName'] = $userName;
  $_SESSION['UserRole'] = $roleName;
      header('location: welcome.php');



   $update_query = "UPDATE UserLogin SET ts = CURRENT_TIMESTAMP where UserName = '$userName'";
   if (mysqli_query($link, $update_query)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($link);
}
  }
  // $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

  // require_once('welcome.php');
        
?>
