<?php
require_once("../../include/config.php");

// กำหนด header สำหรับการส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');

$process = $_POST['process'];

// กำหนด response array
$response = [];

try {
    unset($fields);

    if ($process == "add") {
        // ข้อมูลที่ส่งจากฟอร์ม
        $user_fname = $_POST['user_fname'];
        $user_lname = $_POST['user_lname'];
        $user_email = $_POST['user_email'];
        $user_username = $_POST['user_username'];
        $user_password = $_POST['user_password'];
        $user_password_confirm = $_POST['user_password_confirm'];


        if ($user_password == $user_password_confirm) {
            $password = password_hash($user_password, PASSWORD_DEFAULT); // การเข้ารหัสรหัสผ่าน
            $fields = array(
                "user_fname" => $user_fname,
                "user_lname" => $user_lname,
                "user_email" => $user_email,
                "user_username" => $user_username,
                "user_password" => $password,
            );

            $user_id = data_insert("users", $fields, "Y");

            if ($user_id != '') {
                $response['status'] = 'success';
                $response['message'] = 'บันทึกข้อมูลสำเร็จ!';
                $response['style'] = 'success';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'ไม่สามารถบันทึกข้อมูลได้';
                $response['style'] = 'danger';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'การยืนยันรหัสผ่านไม่ตรงกัน';
            $response['style'] = 'danger';
        }
    } else if ($process == "edit") {
        // ข้อมูลที่ส่งจากฟอร์ม
        $user_fname = $_POST['user_fname'];
        $user_lname = $_POST['user_lname'];
        $user_email = $_POST['user_email'];
        $user_username = $_POST['user_username'];
        $user_changepassword = $_POST['user_changepassword'];

        $user_id = base64_decode($_POST['user_id']);

        if ($user_changepassword == "1") {
            $user_password = $_POST['user_password'];
            $user_password_confirm = $_POST['user_password_confirm'];
            
            if ($user_password == $user_password_confirm) {
                $password = password_hash($user_password, PASSWORD_DEFAULT); // การเข้ารหัสรหัสผ่าน
                $fields = array(
                    "user_fname" => $user_fname,
                    "user_lname" => $user_lname,
                    "user_email" => $user_email,
                    "user_username" => $user_username,
                    "user_password" => $password,
                );

                data_update("users", $fields, "user_id = '" . $user_id . "'");

                if ($user_id != '') {
                    $response['status'] = 'success';
                    $response['message'] = 'บันทึกข้อมูลสำเร็จ!';
                    $response['style'] = 'success';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'ไม่สามารถบันทึกข้อมูลได้';
                    $response['style'] = 'danger';
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'การยืนยันรหัสผ่านไม่ตรงกัน';
                $response['style'] = 'danger';
            }
        } else {
            $fields = array(
                "user_fname" => $user_fname,
                "user_lname" => $user_lname,
                "user_email" => $user_email,
                "user_username" => $user_username,
            );

            data_update("users", $fields, "user_id = '" . $user_id . "'");

            if ($user_id != '') {
                $response['status'] = 'success';
                $response['message'] = 'บันทึกข้อมูลสำเร็จ!';
                $response['style'] = 'success';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'ไม่สามารถบันทึกข้อมูลได้';
                $response['style'] = 'danger';
            }
        }
    } else if ($process == "delete") {
        // ข้อมูลที่ส่งจากฟอร์ม
        $user_id = base64_decode($_POST['user_id']);

        $fields = array(
            "delete_flag" => '1',
        );

        data_update("users", $fields, "user_id = '" . $user_id . "'");

        $response['status'] = 'success';
        $response['message'] = 'ลบข้อมูลสำเร็จ!';
        $response['style'] = 'success';
    } else {
        return false;
    }
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $e->getMessage();
    $response['style'] = 'danger';
}


// ส่งข้อมูล JSON กลับไปยัง AJAX
echo json_encode($response);
