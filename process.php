<?php
    session_start();
    require('newconnection.php');
    $_SESSION['reg_errors'] = []; 
    $_SESSION['reg_success'] = []; 
    $_SESSION['login_errors'] = []; 

    function validate_reg($user){
        if(empty($_POST['fname'])){
            $_SESSION['reg_errors'][] = "First name can't be blank!";
        }      
        if(empty($_POST['lname'])){
            $_SESSION['reg_errors'][] = "Last name can't be blank!";
        }
        if(empty($_POST['email'])){
            $_SESSION['reg_errors'][] = "Email can't be blank!";
        }
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $_SESSION['reg_errors'][] = "Email is not valid!";
        }
        if(empty($_POST['password'])){
            $_SESSION['reg_errors'][] = "Password can't be blank!";
        }
        if($_POST['confirm_pw'] !== $_POST['password']){
            $_SESSION['reg_errors'][] = "Password didn't match!";
        }
    }

    function validate_login($user){
        if(empty($_POST['email'])){
            $_SESSION['login_errors'][] = "Email can't be blank!";
        } 
        if (empty($_POST['password'])){
            $_SESSION['login_errors'][] = "Password can't be blank!";
        } 
    }

    if(isset($_POST['action']) && $_POST['action'] == 'Sign up') {
        echo 'Hi';
        validate_reg($_POST);
        
        if(count($_SESSION['reg_errors']) < 1){            
            $query = "INSERT INTO users (first_name, last_name, email, password)
            VALUES ('{$_POST['fname']}', '{$_POST['lname']}', '{$_POST['email']}', '{$_POST['password']}');";
            run_mysql_query($query);

            $_SESSION['reg_success'][] = "Successfully registered! Please login.";
        }

        header('Location: index.php');
        die();
    } 

    if(isset($_POST['action']) && $_POST['action'] == 'Login') {
        echo 'Hello';

        validate_login($_POST);

        if(count($_SESSION['login_errors']) < 1){
            $query = "SELECT * FROM users WHERE users.email = '{$_POST['email']}'
                    AND users.password = '{$_POST['password']}'";
            $_SESSION['result'] = run_mysql_query($query);

            foreach ($_SESSION['result'] as $data){
                if($_POST['email'] == $data['email'] && $_POST['password'] == $data['password']){
                    header('Location: home.php');
                } else if($_POST['email'] == $data['email'] && $_POST['password'] != $data['password']) {
                    $_SESSION['login_errors'][] = "Password didn't match!";
                    header('Location: index.php');
                    die();
                }
            }
        } else {
            header('Location: index.php');
            die();
        }  
    } 
?>