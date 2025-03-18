CREATE DATABASE IF NOT EXISTS go_mode_db;
USE go_mode_db;

CREATE TABLE IF NOT EXISTS products (
    Product_No INT PRIMARY KEY,
    Product_Name VARCHAR(255) NOT NULL,
    Flavor VARCHAR(100),
    Description TEXT,
    Product_Price DECIMAL(10,2) NOT NULL,
    Product_Caffeine INT,
    Sugar_Free VARCHAR(10),
    img VARCHAR(255)
);

INSERT INTO products (Product_No, Product_Name, Flavor, Description, Product_Price, Product_Caffeine, Sugar_Free, img) VALUES
(1, 'GO MODE Original', 'Original', "ความคลาสสิกที่ให้พลังเต็มแม็กซ์! ผสานคาเฟอีนและวิตามิน B เพื่อความสดชื่นตลอดวัน", 30.00, 80, TRUE, 'Original.png'),
(2, 'GO MODE Citrus Blast', 'Citrus', "สัมผัสความสดชื่นแบบซิตรัส ด้วยรสเปรี้ยวซ่าของเลมอนและส้ม", 30.00, 90, TRUE, 'Citrus.png'),
(3, 'GO MODE Berry Rush', 'Berry', "หอมหวานลงตัวจากเบอร์รี่นานาชนิด อัดแน่นด้วยสารต้านอนุมูลอิสระ", 30.00, 85, TRUE, 'Berry.png'),
(4, 'GO MODE Tropical Vibe', 'Tropical', "เติมความสดใสไปกับรสชาติของผลไม้เมืองร้อน แสนสดชื่น", 30.00, 95, TRUE, 'Tropical.png'),
(101, 'GO MODE Original (Pack of 8)', 'Original', "ความคลาสสิกที่ให้พลังเต็มแม็กซ์! ผสานคาเฟอีนและวิตามิน B เพื่อความสดชื่นตลอดวัน", 240.00, 80, TRUE, '8Original.png'),
(102, 'GO MODE Citrus Blast (Pack of 8)', 'Citrus', "สัมผัสความสดชื่นแบบซิตรัส ด้วยรสเปรี้ยวซ่าของเลมอนและส้ม ในแพ็คสุดคุ้ม", 240.00, 90, TRUE, '8Citrus.png'),
(103, 'GO MODE Berry Rush (Pack of 8)', 'Berry', "หอมหวานลงตัวจากเบอร์รี่นานาชนิด อัดแน่นด้วยสารต้านอนุมูลอิสระ ในแพ็คสุดคุ้ม", 240.00, 85, TRUE, '8Berry.png'),
(104, 'GO MODE Tropical Vibe (Pack of 8)', 'Tropical', "เติมความสดใสไปกับรสชาติของผลไม้เมืองร้อน แสนสดชื่น ในแพ็คสุดคุ้ม", 240.00, 95, TRUE, '8Tropical.png');
