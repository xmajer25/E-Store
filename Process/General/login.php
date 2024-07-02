<?php
    session_start();
    require '../../db/connectDb.php';

    //Check request method
    if($_SERVER['REQUEST_METHOD'] != "POST"){
        exitError("Invalid request");
    }

    //Check data
    if(!isset($_POST['username']) || !isset($_POST['password'])){
        exitError("Both fields need to be filled");
    }

    //Get user
    $stmt = $pdo->prepare('SELECT password_key, user_role FROM USERS WHERE username = ?');
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    //Verify login 
    if(!$user || !password_verify($_POST['password'], $user['password_key'])){
        exitError("Username or password are incorrect");
    }

    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['user_role'] = $user['user_role'];
    header('Location: ../../Pages/General/home_page.html');
    exit;



    function exitError($msg){
        $_SESSION['alert_msg'] = $msg;
        $_SESSION['alert_type'] = "error";
        header('Location: ../../Pages/General/login_page.php');
        exit;
    }
?>