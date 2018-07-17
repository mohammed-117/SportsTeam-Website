<!DOCTYPE html>
 
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
        <link rel="stylesheet" href="stylesheets/stylesheet.css">
    <body>
        <h1>CSUF Basketball Analytics</h1>
        <h4>Please Sign in to enter the website</h4>
        <form class="pure-form pure-form-stacked" method="post" action="loginNew.php">
            <fieldset>
                <div class="pure-control-group">
                    <p><label for="userName">Username:</label>
                <input type="text" name="userName" value="" id="userName" maxlength="100" placeholder="User Name">
                        <span class="pure-form-message">This is a required field.</span>
                </div>
                <br>
                Password:
                <input type="text" name="password" value="" maxlength="100" placeholder="Password">
                <br>
                <button class="pure-button pure-button-primary" type="submit" name="submit" id="submit">Sign In</button>
                <a href="forgetPasswordForm.php" class="pure-button pure-button-primary" role="button">I forgot password</a>
                 <h4>Create Account</h4>
            <a class="pure-button pure-button-primary" href="createAccount.php">Register</a>
            </fieldset>
        </form>
            <div id="body1">
                <img src="img\tuffy.jpg" class="tuffy">
            </div>
    </body>
</head>
</html>