<?php
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
        .alert {
            position: absolute;
            top: 27px;
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
        .alert-warning {
            position: absolute;
            top: 27px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffeeee;
            color: yellow;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            z-index: 1000; /* ให้แน่ใจว่าอยู่ด้านหน้าสุด */
        }
        .alert-danger {
            position: absolute;
            top: 27px;
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
        .alert-success {
            position: absolute;
            top: 27px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #eeffee;
            color: green;
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
<div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $Email = $_POST["Email"];
           $Password = $_POST["Password"];
           $PasswordRepeat = $_POST["Repeat_Password"];
           
           $PasswordHash = password_hash($Password, PASSWORD_DEFAULT);

           $errors = array();
           $warnings = array();
           
           if (empty($Email) OR empty($Password) OR empty($PasswordRepeat)) {
            array_push($warnings, "Please fill in all fields");
           }
           if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "This email is not available");
           }
           if (strlen($Password)<8) {
            array_push($warnings, "Password must be at least 8 characters long");
           }
           if ($Password!==$PasswordRepeat) {
            array_push($errors, "Passwords don't match");
           }
           require_once "connection.php";
           $sql = "SELECT * FROM user_form WHERE Email = '$Email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors, "This email is already in use");
           }
           if (count($errors)>0 || count($warnings)>0) {
            foreach ($warnings as $warning) {
                echo "<div class='alert alert-warning'>$warning</div>";
            }
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           } else {
            $sql = "INSERT INTO user_form (Email, Password) VALUES (  ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"ss",$Email, $PasswordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You have successfully registered</div>";
            } else {
                die("Something went wrong");
            }
           }
        }
        ?>
    <div class="login">
        <div class="logo">
            <i class='bx bx-user-circle'></i>
            <h2>Sign up</h2>
        </div>

        <form action="sign_up.php" method="post">
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
            <div class="input_box">
                <span>Repeat Password</span>
                <div class="icon">
                    <i class='bx bxs-lock-alt'></i>
                    <input type="password" placeholder="Enter your password again" name="Repeat_Password" required>
                </div>
            </div>

            <button type="submit" value="Register" name="submit">Sign up</button>

            <p class="signup">Or sign up with social platforms</p>

            <div class="social_icon">
                <a href="https://www.facebook.com/v11.0/dialog/oauth?client_id=963743751803737&redirect_uri=https://sirirat283.github.io/GCP/&scope=email" id="facebook"><i class='bx bxl-facebook'></i></a>
                <a href="https://accounts.google.com/o/oauth2/auth?client_id=862009025757-alj9riivmc1va7m69id6dulnjcvioc7g.apps.googleusercontent.com&redirect_uri=https://sirirat283.github.io/GCP/&scope=email&response_type=code" id="google"><i class='bx bxl-google'></i></a>
                <a href="https://github.com/login/oauth/authorize?client_id=Ov23liFeyoZYU0CSECDY&redirect_uri=https://sirirat283.github.io/GCP/&scope=user" id="github"><i class='bx bxl-github'></i></a>
            </div>

            <div class="alreadyAccount">
                <p>Already have an account? <a href="index.php">Log in</a></p>
            </div>
        </form>
    </div>
</body>
</html>