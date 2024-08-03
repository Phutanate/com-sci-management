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
        $tp_name_th = $_POST['tp_name_th'];
        $tp_name_en = $_POST['tp_name_en'];

        $fields = array(
            "tp_name_th" => $tp_name_th,
            "tp_name_en" => $tp_name_en,
        );

        $tp_id = data_insert("teacher_position", $fields, "Y");

        if ($tp_id != '') {
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
        $tp_name_th = $_POST['tp_name_th'];
        $tp_name_en = $_POST['tp_name_en'];

        $tp_id = base64_decode($_POST['tp_id']);

        $fields = array(
            "tp_name_th" => $tp_name_th,
            "tp_name_en" => $tp_name_en,
        );

        data_update("teacher_position", $fields, "tp_id = '" . $tp_id . "'");

        if ($tp_id != '') {
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
        $tp_id = base64_decode($_POST['tp_id']);

        $fields = array(
            "delete_flag" => '1',
        );

        data_update("teacher_position", $fields, "tp_id = '" . $tp_id . "'");

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
