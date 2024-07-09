<?php
session_start();
require_once 'language.php';
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
$translations = $language[$lang];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $translations['UAV_GCP_DETECTION']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #000;
            background-image: url('w1.png');
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
            color: #000;
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
            border: 4px solid #000;
        }
        nav a {
            color: #000;
            text-decoration: none;
            margin: 0 15px;
            position: relative;
            transition: color 0.3s;
        }
        nav a:hover {
            color: black;
        }
        nav a::before {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: transparent;
            border-radius: 3px;
            transition: background-color 0.3s;
        }
        nav a:hover::before {
            background-color: black;
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
            font-size: 24px;
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
            border: 1px solid #000;
            margin-right: 5px;
        }
        .search-button {
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #000;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .search-button:hover {
            background-color: yellow;
            color: #000;
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
        .language-dropdown {
            position: relative;
            display: inline-block;
            margin-right: 15px;
        }
        .language-dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 150px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
        }
        .language-dropdown:hover .language-dropdown-content {
            display: block;
        }
        .language-dropdown-content a {
            color: black;
            padding: 10px 15px;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .language-dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .flag-icon {
            width: 20px;
            height: 15px;
            margin-right: 5px;
            vertical-align: middle;
        }
        .language-button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .language-button:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
        .content {
            font-size: 22px;
            margin-left: 20px; /* Adjust this value to move the content to the right */
        }
    </style>
</head>
<body>
    <header>
        <div style="display: flex; align-items: center;">
            <img src="logo4.png" alt="Logo" class="logo">
            <h1><?php echo $translations['UAV_GCP_DETECTION']; ?></h1>
        </div>
        <nav style="padding: 0px 5px; font-size: 20px;">
            <a href="home.php"><?php echo $translations['HOME']; ?></a>
            <a href="newproject.php"><?php echo $translations['NEW_PROJECT']; ?></a>
            <a href="about.php"><?php echo $translations['ABOUT']; ?></a>
            <a href="setting.php"><?php echo $translations['SETTING']; ?></a>
            <a href="logout.php"><?php echo $translations['LOG_OUT']; ?></a>
            <img src="profile1.png" alt="Profile Logo" class="logo">
            <div class="language-dropdown">
                <button class="language-button">
                    <?php if($lang == 'en'): ?>
                        <img src="en.png" alt="English" class="flag-icon"> English
                    <?php else: ?>
                        <img src="th.png" alt="Thai" class="flag-icon"> ไทย
                    <?php endif; ?>
                </button>
                <div class="language-dropdown-content">
                    <a href="change_language.php?lang=en"><img src="en.png" alt="English" class="flag-icon"> <?php echo $translations['ENGLISH']; ?></a>
                    <a href="change_language.php?lang=th"><img src="th.png" alt="Thai" class="flag-icon"> <?php echo $translations['THAI']; ?></a>
                </div>
            </div>
        </nav>
    </header>
    <div class="content">
        <h2><?php echo $translations['MY_PROJECT']; ?></h2>
    </div>
    <main>
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="<?php echo $translations['SEARCH_FILE']; ?>">
            <button class="search-button"><?php echo $translations['SEARCH']; ?></button>
        </div>
        <div class="file-list">
            <?php if (isset($_SESSION['user'])): ?>
                <?php foreach ($files as $file): ?>
                    <div class="file-item">
                        <h3><?php echo htmlspecialchars($file['filename']); ?></h3>
                        <p><?php echo $translations['CREATED_ON']; ?>: <?php echo htmlspecialchars($file['creation_date']); ?></p>
                        <p><?php echo $translations['SAVED_ON']; ?>: <?php echo htmlspecialchars($file['save_date']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>

            <?php endif; ?>
        </div>
    </main>
    <script>
    document.querySelectorAll('.language-dropdown-content a').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            fetch(e.target.href)
                .then(() => location.reload());
        });
    });
    </script>
</body>
</html>