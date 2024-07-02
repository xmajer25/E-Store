<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../Styles/general_styles.css?v=1.1" type="text/css">
        <link rel="stylesheet" href="../../Styles/login_styles.css?v=1.1" type="text/css">
        <title>LogIn</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="login_navigation">
            <button class="button_topleft home_button" onclick="location.href='./home_page.html'"></button>
            <button class="button_topright">Register</button>
        </div>

        <div class="login_form">
        <?php
            session_start();
            $errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : '';
            echo "<p class=error style='opacity: " . ($errorMessage ? "1'>" : "0'>") . ($errorMessage ? $errorMessage : "dummy error message") . "</p>";
            unset($_SESSION['error']);
        ?>
            <form action="../../Process/General/login.php" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" maxlength="20" required autocomplete="username">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" maxlength="20" required autocomplete="current-password">
                
                <button type="submit" class="login_button">Log In</button>
            </form>
        </div>

        <script>
            setTimeout(function () {
                document.querySelector('.error').style.opacity = 0;
            }, 5000);
        </script>
    </body>
</html>