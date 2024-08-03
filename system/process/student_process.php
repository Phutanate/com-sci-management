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
        $std_fname_th = $_POST['std_fname_th'];
        $std_lname_th = $_POST['std_lname_th'];
        $std_fname_en = $_POST['std_fname_en'];
        $std_lname_en = $_POST['std_lname_en'];
        $std_status = $_POST['std_status'];
        $std_number_id = $_POST['std_number_id'];
        $prefix_id = $_POST['prefix_id'];
        $gender_id = $_POST['gender_id'];
        $ay_id = $_POST['ay_id'];

        $fields = array(
            "std_fname_th" => $std_fname_th,
            "std_lname_th" => $std_lname_th,
            "std_fname_en" => $std_fname_en,
            "std_lname_en" => $std_lname_en,
            "std_status" => $std_status,
            "std_number_id" => $std_number_id,
            "prefix_id" => $prefix_id,
            "gender_id" => $gender_id,
            "ay_id" => $ay_id,
        );

        $std_id = data_insert("student", $fields, "Y");

        if ($std_id != '') {
            $response['status'] = 'success';
            $response['message'] = 'บันทึกข้อมูลสำเร็จ!';
            $response['style'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'ไม่สามารถบันทึกข้อมูลได้';
            $response['style'] = 'danger';
        }
    } else if ($process == "edit") {
        // ข้อมูลที่ส่งจากฟอร์ม
        $std_fname_th = $_POST['std_fname_th'];
        $std_lname_th = $_POST['std_lname_th'];
        $std_fname_en = $_POST['std_fname_en'];
        $std_lname_en = $_POST['std_lname_en'];
        $std_status = $_POST['std_status'];
        $std_number_id = $_POST['std_number_id'];
        $prefix_id = $_POST['prefix_id'];
        $gender_id = $_POST['gender_id'];
        $ay_id = $_POST['ay_id'];
        
        $std_id = base64_decode($_POST['std_id']);
        
        $fields = array(
            "std_fname_th" => $std_fname_th,
            "std_lname_th" => $std_lname_th,
            "std_fname_en" => $std_fname_en,
            "std_lname_en" => $std_lname_en,
            "std_status" => $std_status,
            "std_number_id" => $std_number_id,
            "prefix_id" => $prefix_id,
            "gender_id" => $gender_id,
            "ay_id" => $ay_id,
        );

        data_update("student", $fields, "std_id = '" . $std_id . "'");

        if ($std_id != '') {
            $response['status'] = 'success';
            $response['message'] = 'บันทึกข้อมูลสำเร็จ!';
            $response['style'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'ไม่สามารถบันทึกข้อมูลได้';
            $response['style'] = 'danger';
        }
    } else if ($process == "delete") {
        // ข้อมูลที่ส่งจากฟอร์ม
        $std_id = base64_decode($_POST['std_id']);
        
        $fields = array(
            "delete_flag" => '1',
        );

        data_update("student", $fields, "std_id = '" . $std_id . "'");

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
