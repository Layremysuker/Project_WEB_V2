<?php
require 'db.php';

// 🔹 ตั้งค่า JSON Header
header("Content-Type: application/json; charset=UTF-8");

// ✅ Debug ค่าที่ได้รับ
file_put_contents("debug_log.txt", print_r($_GET, true));

if (!isset($_GET["Product_No"]) || empty($_GET["Product_No"])) {
    echo json_encode(["error" => "❌ ไม่มีรหัสสินค้า"]);
    exit();
}

$productNo = intval($_GET["Product_No"]);

try {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE Product_No = :productNo");
    $stmt->bindParam(":productNo", $productNo, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo json_encode(["success" => true, "product" => $product]);
    } else {
        echo json_encode(["error" => "❌ ไม่พบสินค้า"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "❌ เกิดข้อผิดพลาด: " . $e->getMessage()]);
}
?>

