<?php
  require_once( 'createDB.php' );
        $firstName = trim($_REQUEST['firstName']);
        $firstName = strip_tags($_REQUEST['firstName']);
        $firstName = htmlspecialchars($_REQUEST['firstName']);

        $lastName = trim($_REQUEST['lastName']);
        $lastName = strip_tags($_REQUEST['lastName']);
        $lastName = htmlspecialchars($_REQUEST['lastName']);

        $email = trim($_REQUEST['email']);
        $email = strip_tags($_REQUEST['email']);
        $email = htmlspecialchars($_REQUEST['email']);

        $userName = trim($_REQUEST['userName']);
        $userName = strip_tags($_REQUEST['userName']);
        $userName = htmlspecialchars($_REQUEST['userName']);

        $password = trim($_REQUEST['password']);
        $password = strip_tags($_REQUEST['password']);
        $password = htmlspecialchars($_REQUEST['password']);

        $role = trim($_REQUEST['role']);
        $role = strip_tags($_REQUEST['role']);
        $role = htmlspecialchars($_REQUEST['role']); 

        

        if (preg_match('/^[a-zA-Z0-9_]*$/', $password) && (preg_match('/^[a-zA-Z0-9_]*$/', $userName))) {
            $sql = "INSERT INTO TeamRoster(Name_First, Name_Last) VALUES ('$firstName', '$lastName')";
        $link->query($sql);
        $query = "INSERT INTO UserLogin SET
              Name_First = ?,
              Name_Last  = ?,
              Email      = ?,
              UserName   = ?,
              Password   = ?,
              Role       = ?";

        $stmt = $link->prepare($query);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('sssssd', $firstName, $lastName, $email, $userName, $passwordHash, $role);
            
        if( ($stmt->execute() && $stmt->affected_rows === 1) )
        {
            echo "Success: new user '$userName' created<br/>";
            require_once('login.php');
        }
        else                           
        {
            echo("Password rules don't match");
            echo "Failure: new user '$userName' not created:  " . $link->error . "<br/>";
            require_once('login.php');
        }
    } else {
        require_once('login.php');
    }
?>