<?php
require_once("../../include/config.php");

// กำหนด header สำหรับการส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');

// ข้อมูลที่ส่งจากฟอร์ม
$email = $_POST['email'];

// กำหนด response array
$response = [];

function generateRandomPassword($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $charactersLength = strlen($characters);
    $randomPassword = '';

    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomPassword;
}

function send_mail($to, $subject, $message, $headers)
{
    if (mail($to, $subject, $message, $headers)) {
        $result =  "success";
    } else {
        $result =  "error";
    }

    return $result;
}

try {
    // สร้าง SQL statement เพื่อดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $sql = "SELECT * FROM users WHERE delete_flag = '0' AND user_email = ?";

    // เตรียม statement
    $stmt = $conn->prepare($sql);

    // Execute statement โดยส่งค่าชื่อผู้ใช้
    $stmt->execute([$email]);

    // ดึงผลลัพธ์
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // สร้างรหัสผ่านใหม่
        $newPassword = generateRandomPassword(8);
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // อัปเดตรหัสผ่านในฐานข้อมูล
        $updateSql = "UPDATE users SET user_password = ? WHERE user_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        if ($updateStmt->execute([$hashedPassword, $user['user_id']])) {
            // อัปเดตรหัสผ่านสำเร็จ ส่งอีเมลแจ้งรหัสผ่านใหม่
            $to = $user['user_email'];
            $subject = 'มีการสร้างรหัสผ่านใหม่';
            $message = 'รหัสผ่านใหม่ของคุณคือ : ' . $newPassword;
            $headers = 'From: no-reply@comscimanagement.com';

            $result_send_mail = send_mail($to, $subject, $message, $headers);

            if ($result_send_mail == "success") {
                $response['status'] = 'success';
                $response['message'] = 'ระบบทำการสร้างรหัสผ่านใหม่ และส่งให้คุณทาง email แล้ว!';
                $response['style'] = 'success';
            } else {
                // อัปเดตรหัสผ่านในฐานข้อมูล ให้ใช้อันเดิม
                $updateSql = "UPDATE users SET user_password = ? WHERE user_id = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->execute([$user['user_password'], $user['user_id']]);

                $response['status'] = 'error';
                $response['message'] = 'อัปเดตรหัสผ่านไม่สำเร็จ';
                $response['style'] = 'danger';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'ไม่สามารถอัปเดตหัสผ่านได้';
            $response['style'] = 'danger';
        }
    } else {
        // ชื่อผู้ใช้ไม่พบ
        $response['status'] = 'error';
        $response['message'] = 'ไม่พบอีเมลล์นี้ในระบบ'; // ชื่อผู้ใช้
        $response['style'] = 'danger';
    }
} catch (PDOException $e) {
    // อัปเดตรหัสผ่านในฐานข้อมูล ให้ใช้อันเดิม
    $updateSql = "UPDATE users SET user_password = ? WHERE user_id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->execute([$user['user_password'], $user['user_id']]);


    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $e->getMessage();
    $response['style'] = 'danger';
}

// ส่งข้อมูล JSON กลับไปยัง AJAX
echo json_encode($response);
