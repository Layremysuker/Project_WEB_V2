fetch("update_product.php", {
    method: "POST",
    body: formData
})
.then(response => response.text()) // อ่านค่าเป็น text ก่อน
.then(text => {
    console.log("🔍 Server Response:", text); // ตรวจสอบค่าที่เซิร์ฟเวอร์ส่งมา
    return JSON.parse(text); // แปลงเป็น JSON
})
.then(data => {
    if (data.success) {
        alert("✅ " + data.success);
        closeEditModal();
        location.reload();
    } else {
        alert("❌ " + data.error);
    }
})
.catch(error => {
    alert("❌ เกิดข้อผิดพลาด: " + error);
});
