<?php
$servername = "localhost";
$username = "root";
$password = "sirirat"; // ไม่มีรหัสผ่าน
$dbname = "signup";

// สร้างการเชื่อมต่อ
$conn = mysqli_connect($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}
?>
