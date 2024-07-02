<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../Styles/general_styles.css?v=1.2" type="text/css">
        <link rel="stylesheet" href="../../Styles/account_styles.css?v=1.2" type="text/css">
        <title>Register</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="account_navigation">
            <button class="button_topleft home_button" onclick="location.href='./home_page.html'"></button>
            <button class="button_topright" onclick="location.href='./login_page.php'">Log In</button>
        </div>

        <div class="login_form">
        <?php
            session_start();
            $errorMessage = isset($_SESSION['alert_msg']) ? $_SESSION['alert_msg'] : 'dummy error message';
            $alertType = isset($_SESSION['alert_type']) ? $_SESSION['alert_type'] : '';
            $opacity = isset($_SESSION['alert_msg']) ? '1' : '0';
            
            echo "<p class=\"$alertType\" style=\"opacity: $opacity;\">$errorMessage</p>";
            if($alertType === "error"){
                unset($_SESSION['alert_msg']);
                unset($_SESSION['alert_type']);
            }
        ?>
            <form action="../../Process/General/register.php" method="post">
                <!-- USER NAME -->
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" maxlength="20" required autocomplete="username">
                <!-- PASSWORD -->
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" maxlength="20" required autocomplete="new-password">
                <!-- REPEAT -->
                <label for="password">Repeat Password</label>
                <input type="password" id="repeat" name="repeat" placeholder="Repeat Password" maxlength="20" required autocomplete="new-password">
                <!-- EMAIL -->
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Email" maxlength="32" required autocomplete="email">

                <button type="submit" class="login_button">Register</button>
            </form>
        </div>

        <script>
            setTimeout(function () {
                document.querySelector('.error').style.opacity = 0;
                
            }, 5000);
        </script>
    </body>
</html>