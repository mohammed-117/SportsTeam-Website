<!DOCTYPE html>
<html>
<head>
    <Title> Password Reset</title>
     <link rel="stylesheet" href="stylesheets/stylesheet.css">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
<body>
    <h1> Forgot Password </h1>
    </body>
        <form class="pure-form pure-form-stacked" method="post" action="passWordRecover.php">
    <fieldset>
        <h1>Please Enter the Information for Password Recovering</h1>
        <div class="pure-g">

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="email">E-Mail</label>
                <input id="email" class="pure-u-23-24" type="email" required name="email">
            </div>
        </div>
        <button class="pure-button pure-button-primary" type="submit" name="submit" value="submit">Submit</button>
        <a class="pure-button pure-button-primary" href="login.php">Back</a>

    </fieldset>
</form>
    </body>

</head>
</html>