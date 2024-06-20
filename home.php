<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    // Fetch previously created files from the database
    // Replace with your actual database connection and query logic
    $files = []; // Example array to store file information
    $conn = new mysqli('localhost', 'username', 'password', 'database');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "SELECT filename, creation_date, save_date FROM files WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_SESSION['user']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $files[] = $row;
    }

    $stmt->close();
    $conn->close();
} else {
    // Check if the login form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Perform login or registration validation here

        // Example validation (replace with your actual validation logic)
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email == 'example@email.com' && $password == 'password') {
            // Set session variable indicating successful login
            $_SESSION['user'] = $email;
            header('Location: home.php'); // Redirect to home.php after successful login
            exit();
        } else {
            echo 'Invalid email or password. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAV GCP DETECTION</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #fff;
            background-image: url('mountain.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        header {
            padding: 10px 0;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            color: #D4B0B5;
            margin: 0;
        }
        .logo {
            max-width: 80px;
            margin-right: 10px;
        }
        nav {
            padding: 10px 0;
            text-align: right;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            border-radius: 50px;
            border: 2px solid #fff;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            position: relative;
            transition: color 0.3s;
        }
        nav a:hover {
            color: yellow;
        }
        nav a::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: transparent;
            border-radius: 3px;
            transition: background-color 0.3s;
        }
        nav a:hover::before {
            background-color: yellow;
        }
        nav a:last-child {
            display: flex;
            align-items: center;
        }
        nav a:last-child .logo {
            margin-left: 2px;
            text-decoration: none;
        }
        nav a:last-child::before {
            display: none;
        }
        nav a:last-child:hover::before {
            display: block;
        }
        .logo {
            max-width: 80px;
            margin-right: 0px;
        }
        main {
            padding: 20px;
        }
        .text-left {
            text-align: left;
        }
        .text-left h2 {
            margin-left: 20px;
        }
        .text-left img {
            float: left;
            margin-right: 10px;
            width: 500px;
            height: auto;
        }
        .search-bar {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .search-input {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #fff;
            margin-right: 5px;
        }

        .search-button {
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #fff;
            color: #330066;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .search-button:hover {
            background-color: yellow;
            color: #330066;
        }

        .file-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .file-item {
            background-color: rgba(255, 255, 255, 0.8);
            color: #330066;
            border: 2px solid #fff;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            width: calc(33% - 20px);
            box-sizing: border-box;
            transition: background-color 0.3s, color 0.3s;
        }

        .file-item:hover {
            background-color: #330066;
            color: #fff;
        }

        .file-item h3, .file-item p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <header>
        <div style="display: flex; align-items: center;">
            <img src="logo.png" alt="Logo" class="logo">
            <h1>UAV GCP DETECTION</h1>
        </div>
        <nav style="padding: 0px 5px;">
            <a href="index.php">Home</a>
            <a href="newproject.php">New Project</a>
            <a href="about.php">About</a>
            <a href="setting.php">Setting</a>
            <a href="myprofile.php">My profile</a>
            <img src="profile.png" alt="Profile Logo" class="logo">
        </nav>
    </header>
    <div class="text-left">
        <h2>My Project</h2>
    </div>
    <main>
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Search file...">
            <button class="search-button">Search</button>
        </div>
        <div class="file-list">
            <?php if (isset($_SESSION['user'])): ?>
                <?php foreach ($files as $file): ?>
                    <div class="file-item">
                        <h3><?php echo htmlspecialchars($file['filename']); ?></h3>
                        <p>Created on: <?php echo htmlspecialchars($file['creation_date']); ?></p>
                        <p>Saved on: <?php echo htmlspecialchars($file['save_date']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Please log in to see your projects.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
