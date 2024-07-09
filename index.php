<?php
include 'connection.php'; // เชื่อมต่อกับฐานข้อมูล
session_start();
if (isset($_SESSION["user_form"])) {
   header("Location: index.php");
   exit;
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
    <style>
        body {
            position: relative;
            padding-top: 40px; /* เพิ่มพื้นที่ด้านบนสำหรับข้อความแจ้งเตือน */
        }
        .error-message {
            position: absolute;
            top: 45px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffeeee;
            color: red;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            z-index: 1000; /* ให้แน่ใจว่าอยู่ด้านหน้าสุด */
        }
    </style>
</head>
<body>
<?php
$error_message = "";
if (isset($_POST["login"])) {
   $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
   $Password = $_POST["Password"];
    $sql = "SELECT * FROM user_form WHERE Email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $Email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_form = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user_form) {
        if (password_verify($Password, $user_form["Password"])) {
            $_SESSION["user_form"] = "yes";
            header("Location: home.php");
            exit;
        } else {
            $error_message = "The password is incorrect!";
        }
    } else {
        $error_message = "Invalid email!";
    }
}
?>
<?php if (!empty($error_message)): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
<?php endif; ?>
<div class="container">
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
            <button type="submit" value="LOG IN" name="login">Login</button>
            <p class="signup">Or login with social platforms</p>
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
</div>
</body>
</html>