<?php
//Load Composer's autoloader
 require("createDB.php");

  if (isset($_REQUEST['submit'])) {
            $email = trim($_REQUEST['email']);
            $email = strip_tags($_REQUEST['email']);
            $email = htmlspecialchars($_REQUEST['email']);

            $sql = "SELECT ID, Password FROM userLogin where Email = '$email'";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_array($result);
            $found = isset($row['found']);
            $counter = mysqli_num_rows($result);

            $length = 8;
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $password = substr( str_shuffle( $chars ), 0, $length );
        if ($counter == 1) {
        require 'PHPMailer\PHPMailerAutoload.php';

        $mail = new PHPMailer(true);                              
        $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );

    $mail->isSMTP();     
    $mail->Host='smtp.gmail.com';
    $mail->Username='431basketball@gmail.com'; //Add new email
    $mail->Password='431Rocks!'; //add new password
    $mail->SMTPSecure='tls';
    $mail->SMTPAuth = true;

    $mail->Port=587;
    $mail->setFrom('431Basketball@gmail.com', 'Admin');
    $mail->addAddress($email, 'user');

    $mail->WordWrap = 50;                                 // set word wrap to 50 characters
    $mail->IsHTML(true); 

    $mail->Subject = 'Temporary Password';
    $mail->Body    = 'Your temporary password is <b>'.$password.'</b>'." ".'<a href="http://localhost/SportsTeam-Website/changePasswordForm.php" target="_top">Reset Password</a>';

    if($mail->Send())
    {
        echo "Message has been sent";
        $sqlUpdate = "UPDATE UserLogin SET Password='$password' WHERE Email='$email'";
        mysqli_query($link, $sqlUpdate);
        require("login.php");
    } else {
        echo "Email error";
        require("login.php");
    }     
  } else {
        echo "Email not Found";
        require("login.php");
  }
}
?>