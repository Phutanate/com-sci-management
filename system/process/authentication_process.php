<?php
require_once("../../include/config.php");

// กำหนด header สำหรับการส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');

// ข้อมูลที่ผู้ใช้
$user_id_decoded = base64_decode($_POST['user_id']);
$user_id = $user_id_decoded;

// กำหนด response array
$response = [];

try {
    // สร้าง SQL statement เพื่อดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $sql = "SELECT user_id,user_fname,user_lname,user_email FROM users WHERE user_id = ?";

    // เตรียม statement
    $stmt = $conn->prepare($sql);

    // Execute statement โดยส่งค่าชื่อผู้ใช้
    $stmt->execute([$user_id]);

    // ดึงผลลัพธ์
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // ชื่อผู้ใช้พบ
        $user_id_encoded = base64_encode($user['user_id']);
        $_SESSION['USER_ID'] = $user_id_encoded;

        $response['status'] = 'success';
        $response['message'] = 'ยืนยันตัวตนถูกต้อง!';
        $response['style'] = 'success';
        $response['data'] = $user;
    } else {
        // ชื่อผู้ใช้ไม่พบ
        $response['status'] = 'error';
        $response['message'] = 'กรุณาเข้าสู่ระบบ';
        $response['style'] = 'danger';
    }
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $e->getMessage();
    $response['style'] = 'danger';
}

// ส่งข้อมูล JSON กลับไปยัง AJAX
echo json_encode($response);
