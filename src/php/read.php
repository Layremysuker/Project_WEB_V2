<?php
// ตั้งค่า Header เพื่อรองรับ CORS และบอกให้ส่งข้อมูลเป็น JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// เชื่อมต่อฐานข้อมูล
require_once 'db.php';

try {
    // ดึงข้อมูลจากตาราง products
    $products = array();
    $stmt = $pdo->query('SELECT * FROM products');

    if ($stmt->rowCount() > 0) {
        // วนลูปใส่ข้อมูลลงใน array
        foreach ($stmt as $row) {
            $product = array(
                'id' => (int)$row['Product_No'],
                'name' => $row['Product_Name'],
                'flavor' => $row['Flavor'],
                'desc' => mb_substr($row['Description'], 0, 100),
                'price' => (float)$row['Product_Price'],
                'caffeine' => (int)$row['Product_Caffeine'],
                'sugar_free' => $row['Sugar_Free'] === 'TRUE' ? true : false,
                'image_name' => $row['img'],
            );
            array_push($products, $product);
        }
    }

    // ส่งข้อมูลเป็น JSON กลับไป
    echo json_encode($products, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    // ปิดการเชื่อมต่อ
    $pdo = null;

} catch (PDOException $e) {
    // ส่ง Error กลับในรูปแบบ JSON
    echo json_encode(["error" => $e->getMessage()], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    die();
}
?>
