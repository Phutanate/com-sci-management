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
        $ts_gt_name = $_POST['ts_gt_name'];
        $ts_gt_number = $_POST['ts_gt_number'];

        $fields = array(
            "ts_gt_name" => $ts_gt_name,
            "ts_gt_number" => $ts_gt_number,
        );

        $ts_gt_id = data_insert("thesis_grouptype", $fields, "Y");

        if ($ts_gt_id != '') {
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
        $ts_gt_name = $_POST['ts_gt_name'];
        $ts_gt_number = $_POST['ts_gt_number'];

        $ts_gt_id = base64_decode($_POST['ts_gt_id']);

        $fields = array(
            "ts_gt_name" => $ts_gt_name,
            "ts_gt_number" => $ts_gt_number,
        );

        data_update("thesis_grouptype", $fields, "ts_gt_id = '" . $ts_gt_id . "'");

        if ($ts_gt_id != '') {
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
        $ts_gt_id = base64_decode($_POST['ts_gt_id']);

        $fields = array(
            "delete_flag" => '1',
        );

        data_update("thesis_grouptype", $fields, "ts_gt_id = '" . $ts_gt_id . "'");

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
