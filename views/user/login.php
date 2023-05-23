<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <small style="color:red ;"><?php if (isset($_SESSION['error'])) echo $_SESSION['error'] . '<br>';
                                    unset($_SESSION['error']); ?></small>
        <form action="" method="post">
            <label for="username">User Email:</label>
            <input type="text" id="username" name="user_email">
            <br>
            <label for=" password">Password:</label>
            <input type="password" id="password" name="password">
            <br>
            <label for=" remember">Remember Me:</label>
            <input type="checkbox" name="remember" id="remember"><br>
            <input type="submit" name="login" value="Login">
            <p>didn't sign up yet?</p>
            <a href="/PHPCOURSE/Darrebeni/htaccess_Task/register">Sign Up</a>
        </form>
    </center>
</body>

<style>
input {
    margin: 5px;
}
</style>

</html>