<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="stylesheets/stylesheet.css">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <body>
    <form class="pure-form pure-form-stacked" method="post" action="newRegistration.php">
    <fieldset>
        <h1>Registration Form</h1>
        <strong>***For User Name and Password Rules***</strong>
        <br>
        <strong>- Must be alphanumeric characters</strong>
        <br>
        <strong>- Can use underscore</strong>
        <br>
        <br>
        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="firstName">First Name</label>
                <input id="firstName" class="pure-u-23-24" type="text" name="firstName">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="lastName">Last Name</label>
                <input id="lastName" class="pure-u-23-24" type="text" name="lastName">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="email">E-Mail</label>
                <input id="email" class="pure-u-23-24" type="email" required name="email">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="userName">User Name</label>
                <input id="userName" class="pure-u-23-24" type="text" required name="userName">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="password">Password</label>
                <input id="password" class="pure-u-23-24" type="text" required name="password">
            </div>
        </div>
        <div class="pure-menu pure-menu-horizontal">
                 <select name="role">
                    <option class="pure-menu-link" value = 1>Observer</option>
                    <option class="pure-menu-link" value = 2>Users</option>
                    <option class="pure-menu-link" value = 3>Executive Manager</option>
                </select>
        </div>


        <label for="terms" class="pure-checkbox">
            <input id="terms" type="checkbox"> I've read the terms and conditions
        </label>
        <button class="pure-button pure-button-primary" type="submit" name="submit" value="submit">Register</button>
        <a class="pure-button pure-button-primary" href="login.php">Back</a>
    </fieldset>
</form>
    </body>
    </head>
</html>

