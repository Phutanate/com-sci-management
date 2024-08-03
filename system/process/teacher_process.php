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
        $tc_fname_th = $_POST['tc_fname_th'];
        $tc_lname_th = $_POST['tc_lname_th'];
        $tc_fname_en = $_POST['tc_fname_en'];
        $tc_lname_en = $_POST['tc_lname_en'];
        $prefix_id = $_POST['prefix_id'];
        $gender_id = $_POST['gender_id'];
        $tp_id = $_POST['tp_id'];

        $fields = array(
            "tc_fname_th" => $tc_fname_th,
            "tc_lname_th" => $tc_lname_th,
            "tc_fname_en" => $tc_fname_en,
            "tc_lname_en" => $tc_lname_en,
            "prefix_id" => $prefix_id,
            "gender_id" => $gender_id,
            "tp_id" => $tp_id,
        );

        $tc_id = data_insert("teacher", $fields, "Y");

        if ($tc_id != '') {
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
        $tc_fname_th = $_POST['tc_fname_th'];
        $tc_lname_th = $_POST['tc_lname_th'];
        $tc_fname_en = $_POST['tc_fname_en'];
        $tc_lname_en = $_POST['tc_lname_en'];
        $prefix_id = $_POST['prefix_id'];
        $gender_id = $_POST['gender_id'];
        $tp_id = $_POST['tp_id'];

        $tc_id = base64_decode($_POST['tc_id']);

        $fields = array(
            "tc_fname_th" => $tc_fname_th,
            "tc_lname_th" => $tc_lname_th,
            "tc_fname_en" => $tc_fname_en,
            "tc_lname_en" => $tc_lname_en,
            "prefix_id" => $prefix_id,
            "gender_id" => $gender_id,
            "tp_id" => $tp_id,
        );

        data_update("teacher", $fields, "tc_id = '" . $tc_id . "'");

        if ($tc_id != '') {
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
        $tc_id = base64_decode($_POST['tc_id']);

        $fields = array(
            "delete_flag" => '1',
        );

        data_update("teacher", $fields, "tc_id = '" . $tc_id . "'");

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
