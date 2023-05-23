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
        <small style="color: red;"><?php if (isset($_SESSION['error'])) echo $_SESSION['error'] . '<br>';
                                    unset($_SESSION['error']); ?></small>
        <form action="" method="post">
            User Name<input type="text" name="user_name" id="">
            User Email<input type="text" name="user_email" id="">
            Password<input type="password" name="password" id="">
            Confirm Password<input type="password" name="confirm_password" id="">
            <input type="submit" value="Register">
            <p>didn't sign up yet?</p>
            <a href="/PHPCOURSE/Darrebeni/htaccess_Task/login">Sign in</a>
        </form>
    </center>
</body>
<style>
    input {
        display: block;
    }
</style>

</html>