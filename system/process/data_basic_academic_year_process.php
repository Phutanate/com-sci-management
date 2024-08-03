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
        $ay_year = $_POST['ay_year'];

        $tc_id = $_POST['tc_id'];

        $fields = array(
            "ay_year" => $ay_year,
        );

        $ay_id = data_insert("academic_year", $fields, "Y");


        foreach ($tc_id as $key_tc => $value_tc) {
            unset($fields_tc);

            $fields_tc = array(
                "ay_id" => $ay_id,
                "tc_id" => $value_tc,
            );

            data_insert("student_adviser", $fields_tc);
        }

        if ($ay_id != '') {
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
        $ay_year = $_POST['ay_year'];

        $tc_id = $_POST['tc_id'];
        $ay_id = base64_decode($_POST['ay_id']);

        $fields = array(
            "ay_year" => $ay_year,
        );

        data_update("academic_year", $fields, "ay_id = '" . $ay_id . "'");

        data_delete("student_adviser", " ay_id = '" . $ay_id . "'");

        foreach ($tc_id as $key_tc => $value_tc) {
            unset($fields_tc);

            $fields_tc = array(
                "ay_id" => $ay_id,
                "tc_id" => $value_tc,
            );

            data_insert("student_adviser", $fields_tc);
        }
        if ($ay_id != '') {
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
        $ay_id = base64_decode($_POST['ay_id']);

        $fields = array(
            "delete_flag" => '1',
        );

        data_update("academic_year", $fields, "ay_id = '" . $ay_id . "'");

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
