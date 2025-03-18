
<?php
header("Content-Type: application/json; charset=UTF-8"); // 🟢 บังคับให้ส่ง JSON
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_no = intval($_POST["product_no"]);
    $name = trim($_POST["name"]);
    $flavor = trim($_POST["flavor"]);
    $description = trim($_POST["desc"]);
    $price = floatval($_POST["price"]);
    $caffeine = intval($_POST["caffeine"]);
    $sugar_free = intval($_POST["sugar_free"]);

    try {
        $sql = "UPDATE products SET 
                    Product_Name = :name, 
                    Flavor = :flavor, 
                    Description = :description, 
                    Product_Price = :price, 
                    Product_Caffeine = :caffeine, 
                    Sugar_Free = :sugar_free
                WHERE Product_No = :product_no";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':product_no', $product_no, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':flavor', $flavor);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':caffeine', $caffeine);
        $stmt->bindParam(':sugar_free', $sugar_free);
        $stmt->execute();

        echo json_encode(["success" => "✅ แก้ไขสินค้าสำเร็จ"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "❌ เกิดข้อผิดพลาด: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "❌ ต้องใช้เมธอด POST เท่านั้น"]);
}
?>
  <script src="admin.js"></script>