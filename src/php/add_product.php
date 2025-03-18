<?php
require 'db.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $flavor = htmlspecialchars(trim($_POST["flavor"]));
    $description = htmlspecialchars(trim($_POST["desc"]));
    $price = intval($_POST["price"]);
    $caffeine = intval($_POST["caffeine"]);
    $sugar_free = isset($_POST["sugar_free"]) ? 1 : 0;

    $image_name = null;
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "../img/";
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowed_types)) {
            echo json_encode(["error" => "❌ ประเภทไฟล์ไม่ถูกต้อง"]);
            exit();
        }

        if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
            echo json_encode(["error" => "❌ ไฟล์มีขนาดใหญ่เกินไป"]);
            exit();
        }

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo json_encode(["error" => "❌ อัปโหลดรูปภาพไม่สำเร็จ"]);
            exit();
        }
    }

    try {
        // ✅ ไม่ต้องกำหนด Product_ID เพราะให้ MySQL สร้างเอง
        $sql = "INSERT INTO products (Product_Name, Flavor, Description, Product_Price, Product_Caffeine, Sugar_Free, img) 
                VALUES (:name, :flavor, :description, :price, :caffeine, :sugar_free, :image_name)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':flavor', $flavor);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':caffeine', $caffeine, PDO::PARAM_INT);
        $stmt->bindParam(':sugar_free', $sugar_free, PDO::PARAM_BOOL);
        $stmt->bindParam(':image_name', $image_name);
        $stmt->execute();

        echo "<script>
            alert('✅ เพิ่มสินค้าเรียบร้อย! รหัสสินค้า: " . $pdo->lastInsertId() . "');
            window.location.href = '../admin.html';
        </script>";
        exit();
    } catch (PDOException $e) {
        echo json_encode(["error" => "❌ เกิดข้อผิดพลาด: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "❌ ต้องใช้เมธอด POST เท่านั้น"]);
}

?>
