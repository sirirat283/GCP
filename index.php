<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="style.css">
    <!-- Icon Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="container">
        <?php
        if (isset($_POST["login"])) {
           $Email = $_POST["Email"];
           $Password = $_POST["Password"];
            require_once "connection.php";
            $sql = "SELECT * FROM user WHERE Email = '$Email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($Password, $user["Password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>รหัสผ่านไม่ถูกต้อง</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>อีเมลไม่ถูกต้อง</div>";
            }
        }
        ?>
    <div class="login">
        <div class="logo">
            <i class='bx bx-user-circle'></i>
            <h2>Login</h2>
        </div>

        <form action="index.php" method="post">
            <div class="input_box">
                <span>Email</span>
                <div class="icon">
                    <i class='bx bxs-user'></i>
                    <input type="text" placeholder="Enter your email" name="Email" required>
                </div>
            </div>
            <div class="input_box">
                <span>Password</span>
                <div class="icon">
                    <i class='bx bxs-lock-alt'></i>
                    <input type="password" placeholder="Enter your password" name="Password" required>
                </div>
            </div>

            <div class="forgot_password">
                <a href="#">Forgot Password?</a>
            </div>

            <button type="submit" value="LOG IN" name="login" >Login</button>

            <p class="signup" >Or login with social platforms</p>

            <div class="social_icon">
                <a href="https://www.facebook.com/v11.0/dialog/oauth?client_id=963743751803737&redirect_uri=https://sirirat283.github.io/GCP/&scope=email" id="facebook"><i class='bx bxl-facebook'></i></a>
                <a href="https://accounts.google.com/o/oauth2/auth?client_id=862009025757-alj9riivmc1va7m69id6dulnjcvioc7g.apps.googleusercontent.com&redirect_uri=https://sirirat283.github.io/GCP/&scope=email&response_type=code" id="google"><i class='bx bxl-google'></i></a>
                <a href="https://github.com/login/oauth/authorize?client_id=Ov23liFeyoZYU0CSECDY&redirect_uri=https://sirirat283.github.io/GCP/&scope=user" id="github"><i class='bx bxl-github'></i></a>
            </div>

            <div class="alreadyAccount">
                <p>Don't have an account yet? <a href="sign_up.php">Sign up</a></p>
            </div>
        </form>
    </div>
</body>
</html>