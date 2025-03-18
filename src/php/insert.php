<?php
require 'db.php'; // เชื่อมต่อฐานข้อมูล

// รับค่าจากฟอร์มหรือ API JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["error" => "❌ ไม่พบข้อมูลที่ส่งมา"]);
    exit;
}

// ดึงค่าจาก JSON ที่ส่งมา
$name = $data["name"];
$flavor = $data["flavor"];
$description = $data["desc"];  // 🛑 เปลี่ยนจาก "description" เป็น "desc" ตาม API
$price = $data["price"];
$caffeine = $data["caffeine"];
$sugar_free = $data["sugar_free"];
$image_name = $data["image_name"];

try {
    // ✅ ตรวจสอบว่ามี 7 คอลัมน์ตรงกัน
    $sql = "INSERT INTO products (Product_Name, Flavor, Description, Product_Price, Product_Caffeine, Sugar_Free, img) 
            VALUES (:name, :flavor, :description, :price, :caffeine, :sugar_free, :image_name)";
    
    $stmt = $pdo->prepare($sql);

    // ✅ bindParam() ให้ครบทุกตัว
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':flavor', $flavor);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':caffeine', $caffeine);
    $stmt->bindParam(':sugar_free', $sugar_free, PDO::PARAM_BOOL);
    $stmt->bindParam(':image_name', $image_name);

    // ✅ รัน SQL
    $stmt->execute();

    echo json_encode(["success" => "✅ เพิ่มสินค้าเรียบร้อย!"]);
} catch (PDOException $e) {
    echo json_encode(["error" => "❌ เกิดข้อผิดพลาด: " . $e->getMessage()]);
}
?>
