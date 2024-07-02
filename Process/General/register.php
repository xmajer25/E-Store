<?php
    session_start();
    require '../../db/connectDb.php';

    //Check request method
    if($_SERVER['REQUEST_METHOD'] != "POST"){
        exitError("Invalid request");
    }

    //Check data
    if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['repeat']) || !isset($_POST['email'])){
        exitError("Please fill in all the fields");
    }

    //Check username existance
    $stmt = $pdo->prepare('SELECT * FROM USERS WHERE username = ?');
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if($user){
        exitError("Username already used");
    }

    //Validate email
    if(!validateEmail($_POST['email'])){
        exitError("Please use a valid email address");
    }

    //Validate password
    if($_POST['password'] != $_POST['repeat']){
        exitError("Your passwords do not match");
    }
    if(!validate_password($_POST['password'])){
        exitError(nl2br(
            "Your passwords needs to:\n&nbsp;&nbsp;&nbsp;&nbsp;" . 
            "•at least 8 characters long\n&nbsp;&nbsp;&nbsp;&nbsp;" . 
            "•contain at least one number\n&nbsp;&nbsp;&nbsp;&nbsp;" . 
            "•contain at least one upper case letter\n&nbsp;&nbsp;&nbsp;&nbsp;" . 
            "•contain at least one special character"));
    }


    //Insert new user into db
    $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    try{
        $stmt = $pdo->prepare('INSERT INTO USERS (username, password_key, email, user_role) VALUES (?, ?, ?, ?)');
        $stmt->execute([$_POST['username'], $hashed_password, $_POST['email'], 'Customer']);
        exitSuccess("New user created, please log in");
    }catch (PDOException $e) {
        exitError("Registration failed: " . $e->getMessage());
    }



    /* FUNCTIONS */
    
    
    function exitError($msg){
        $_SESSION['alert_msg'] = $msg;
        $_SESSION['alert_type'] = "error";
        header('Location: ../../Pages/General/register_page.php');
        exit;
    }

    function exitSuccess($msg){
        $_SESSION['alert_msg'] = $msg;
        $_SESSION['alert_type'] = "success";
        header('Location: ../../Pages/General/login_page.php');
        exit;
    }

    function validateEmail($email){
        $email_regex = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,7}$/';

        if (preg_match($email_regex, $email)) {
            return true;
        } else {
            return false;
        }
    }

    function validate_password($password) {
        // Check if the password is at least 8 characters long
        if (strlen($password) < 8) { return false; } 
        // Check for at least one uppercase letter
        if (!preg_match('/[A-Z]/', $password)) { return false; }
        // Check for at least one number
        if (!preg_match('/\d/', $password)) { return false; }
        // Check for at least one special character
        if (!preg_match('/[@$!%*?&]/', $password)) { return false; }
    
        return true;
    }
?>