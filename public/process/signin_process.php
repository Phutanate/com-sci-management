<?php
require_once("../../include/config.php");

// กำหนด header สำหรับการส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');

// ข้อมูลที่ส่งจากฟอร์ม
$username = $_POST['username'];
$password = $_POST['password'];

// กำหนด response array
$response = [];

try {
    // สร้าง SQL statement เพื่อดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $sql = "SELECT * FROM users WHERE delete_flag = '0' AND user_username = ?";

    // เตรียม statement
    $stmt = $conn->prepare($sql);

    // Execute statement โดยส่งค่าชื่อผู้ใช้
    $stmt->execute([$username]);

    // ดึงผลลัพธ์
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $user['user_password'])) {
            // รหัสผ่านถูกต้อง
            $user_id_encoded = base64_encode($user['user_id']);
            $_SESSION['USER_ID'] = $user_id_encoded;
            $_SESSION['login'] = 'success';

            $response['status'] = 'success';
            $response['message'] = 'เข้าสู่ระบบสำเร็จ!';
            $response['style'] = 'success';
        } else {
            // รหัสผ่านไม่ถูกต้อง
            $response['status'] = 'error';
            $response['message'] = 'ชื่อผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง'; //รหัสผ่าน
            $response['style'] = 'danger';
        }
    } else {
        // ชื่อผู้ใช้ไม่พบ
        $response['status'] = 'error';
        $response['message'] = 'ชื่อผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง'; //ชื่อผู้ใช้
        $response['style'] = 'danger';
    }
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $e->getMessage();
    $response['style'] = 'danger';
}

// ส่งข้อมูล JSON กลับไปยัง AJAX
echo json_encode($response);
