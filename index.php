<?php
    session_start();
    require('newconnection.php');
    // if(!isset($_SESSION['reg_success'])){
    //     $_SESSION['reg_success'][] = '';
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    <meta name="description" content="A Blog Page | Village88">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="wrapper d-flex justify-content-center">
        <div class="register bg-black text-white">
            <h2>Sign Up</h2>
<?php
    if(isset($_SESSION['reg_errors'])){
        foreach ($_SESSION['reg_errors'] as $error){
            echo "<p class='text-danger'>{$error}</p>";
        }

        unset($_SESSION['reg_errors']);
    } 
    
    if(isset($_SESSION['reg_success'])){
        foreach ($_SESSION['reg_success'] as $success){
            echo "<p class='text-success'>{$success}</p>";
        }

        unset($_SESSION['reg_success']);
    }
?>
            <form action="process.php" method="POST">
                <label for="fname">First name:</label>
                <input type="text" name="fname" placeholder="First Name">
                <label for="lname">Last name:</label>
                <input type="text" name="lname" placeholder="Last Name">
                <label for="email">Email:</label>
                <input type="text" name="email" placeholder="example@gmail.com">
                <label for="password">Password:</label>
                <input type="text" name="password" placeholder="********">
                <label for="confirm_pw">Confirm password:</label>
                <input type="text" name="confirm_pw" placeholder="********">
                <input class="btn btn-warning border-0 mt-3" type="submit" value="Sign up" name="action">
            </form>
        </div>

        <div class="login bg-white">
            <h2>Login</h2>
<?php
    if(isset($_SESSION['login_errors'])){
        foreach ($_SESSION['login_errors'] as $error){
            echo "<p class='text-danger'>{$error}</p>";
        }

        unset($_SESSION['login_errors']);
    } 
?>
            <form action="process.php" method="POST">
                <label for="email">Email:</label>
                <input type="text" name="email" placeholder="example@gmail.com">
                <label for="password">Password:</label>
                <input type="text" name="password" placeholder="********">
                <input class="btn btn-warning border-0 mt-3" type="submit" value="Login" name="action">

                <a href="#" class="text-center">Forgot password?</a>
            </form>
        </div>
    </div>
</body>
</html>