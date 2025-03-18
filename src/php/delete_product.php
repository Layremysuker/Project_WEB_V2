<?php
require 'db.php'; // เชื่อมต่อฐานข้อมูล

// รับข้อมูล JSON
$data = json_decode(file_get_contents("php://input"), true);
$productId = isset($data["id"]) ? intval($data["id"]) : 0;

if ($productId > 0) {
    try {
        // ลบสินค้าจากฐานข้อมูลโดยใช้ Product_No
        $stmt = $pdo->prepare("DELETE FROM products WHERE Product_No = :id");
        $stmt->bindParam(":id", $productId, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(["success" => "✅ ลบสินค้าสำเร็จ!"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "❌ เกิดข้อผิดพลาด: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "❌ รหัสสินค้าไม่ถูกต้อง"]);
}
?>
