<?php
$host = 'localhost';  // หรือ IP ของเซิร์ฟเวอร์ฐานข้อมูล
$dbname = 'go_mode_db';
$username = 'root';
$password = '';

try {
    // สร้างการเชื่อมต่อด้วย PDO
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    $pdo = new PDO($dsn, $username, $password, $options);

    // เอาอันนี้ออก ❌
    // echo "✅ เชื่อมต่อฐานข้อมูลสำเร็จ!";
    
} catch (PDOException $e) {
    die(json_encode(["error" => "❌ เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: " . $e->getMessage()]));
}
?>
