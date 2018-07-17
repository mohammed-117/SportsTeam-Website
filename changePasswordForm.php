<!DOCTYPE html>
<html>
<head>
<title>Password Reset</title>
    <link rel="stylesheet" href="stylesheets/stylesheet.css">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
<body>
    <h1> Change Password Login </h1>
    <form class="pure-form pure-form-aligned" method="post" action="phpResertFromEmail.php">
    <fieldset>
        <div class="pure-control-group">
            <label for="userName">User Name</label>
            <input id="userName" type="text" required name="userName">
            <span class="pure-form-message-inline">This is a required field.</span>
        </div>

        <div class="pure-control-group">
            <label for="password">Password</label>
            <input id="password" type="text" required name="password">
            <span class="pure-form-message-inline">This is a required field.</span>
        </div>

            <button type="submit" class="pure-button pure-button-primary">Submit</button>
        </div>
    </fieldset>
</form>
</body>
</head>
</html>