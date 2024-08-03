<?php
require_once("../../include/config.php");

// กำหนด header สำหรับการส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');

// กำหนด response array
$response = [];

try {
    $_SESSION['USER_ID'] = "";

    $response['status'] = 'success';
    $response['message'] = 'ออกจากระบบสำเร็จ!';
    $response['style'] = 'success';
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $e->getMessage();
    $response['style'] = 'danger';
}

// ส่งข้อมูล JSON กลับไปยัง AJAX
echo json_encode($response);
?>
