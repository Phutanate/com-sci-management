<?php
require_once("../../include/config.php");

// กำหนด header สำหรับการส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');

$process = $_POST['process'];

// กำหนด response array
$response = [];

try {
    unset($fields_ts);

    if ($process == "add") {
        // ข้อมูลที่ส่งจากฟอร์ม
        $ts_name_th = $_POST['ts_name_th'];
        $ts_name_en = $_POST['ts_name_en'];
        $ts_gt_id = $_POST['ts_gt_id'];
        $ay_id = $_POST['ay_id'];

        $std_id = $_POST['std_id'];
        $tc_id = $_POST['tc_id'];

        if (isset($_POST['ts_status1'])) {
            $ts_status_1 = $_POST['ts_status1'];
            $ts_status_date_1 = $_POST['ts_status_date1'];
            $ts_status_note_1 = $_POST['ts_status_note1'];
        } else {
            $ts_status_1 = "0";
            $ts_status_date_1 = "";
            $ts_status_note_1 = "";
        }

        if (isset($_POST['ts_status2'])) {
            $ts_status_2 = $_POST['ts_status2'];
            $ts_status_date_2 = $_POST['ts_status_date2'];
            $ts_status_note_2 = $_POST['ts_status_note2'];
        } else {
            $ts_status_2 = "0";
            $ts_status_date_2 = "";
            $ts_status_note_2 = "";
        }

        if (isset($_POST['ts_status3'])) {
            $ts_status_3 = $_POST['ts_status3'];
            $ts_status_date_3 = $_POST['ts_status_date3'];
            $ts_status_note_3 = $_POST['ts_status_note3'];
        } else {
            $ts_status_3 = "0";
            $ts_status_date_3 = "";
            $ts_status_note_3 = "";
        }

        if (isset($_POST['ts_status4'])) {
            $ts_status_4 = $_POST['ts_status4'];
            $ts_status_date_4 = $_POST['ts_status_date4'];
            $ts_status_note_4 = $_POST['ts_status_note4'];
        } else {
            $ts_status_4 = "0";
            $ts_status_date_4 = "";
            $ts_status_note_4 = "";
        }



        $fields_ts = array(
            "ts_name_th" => $ts_name_th,
            "ts_name_en" => $ts_name_en,
            "ts_gt_id" => $ts_gt_id,
            "ay_id" => $ay_id,
            "ts_status_1" => $ts_status_1,
            "ts_status_date_1" => $ts_status_date_1,
            "ts_status_note_1" => $ts_status_note_1,
            "ts_status_2" => $ts_status_2,
            "ts_status_date_2" => $ts_status_date_2,
            "ts_status_note_2" => $ts_status_note_2,
            "ts_status_3" => $ts_status_3,
            "ts_status_date_3" => $ts_status_date_3,
            "ts_status_note_3" => $ts_status_note_3,
            "ts_status_4" => $ts_status_4,
            "ts_status_date_4" => $ts_status_date_4,
            "ts_status_note_4" => $ts_status_note_4,
        );

        $ts_id = data_insert("thesis", $fields_ts, "Y");

        foreach ($std_id as $key_std => $value_std) {
            unset($fields_std);

            $fields_std = array(
                "ts_id" => $ts_id,
                "std_id" => $value_std,
            );

            data_insert("thesis_student", $fields_std);
        }

        foreach ($tc_id as $key_tc => $value_tc) {
            unset($fields_tc);

            $fields_tc = array(
                "ts_id" => $ts_id,
                "tc_id" => $value_tc,
            );

            data_insert("thesis_adviser", $fields_tc);
        }

        if ($ts_id != '') {
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
        $ts_name_th = $_POST['ts_name_th'];
        $ts_name_en = $_POST['ts_name_en'];
        $ts_gt_id = $_POST['ts_gt_id'];
        $ay_id = $_POST['ay_id'];

        $std_id = $_POST['std_id'];
        $tc_id = $_POST['tc_id'];
        
        if (isset($_POST['ts_status1'])) {
            $ts_status_1 = $_POST['ts_status1'];
            $ts_status_date_1 = $_POST['ts_status_date1'];
            $ts_status_note_1 = $_POST['ts_status_note1'];
        } else {
            $ts_status_1 = "0";
            $ts_status_date_1 = "";
            $ts_status_note_1 = "";
        }

        if (isset($_POST['ts_status2'])) {
            $ts_status_2 = $_POST['ts_status2'];
            $ts_status_date_2 = $_POST['ts_status_date2'];
            $ts_status_note_2 = $_POST['ts_status_note2'];
        } else {
            $ts_status_2 = "0";
            $ts_status_date_2 = "";
            $ts_status_note_2 = "";
        }

        if (isset($_POST['ts_status3'])) {
            $ts_status_3 = $_POST['ts_status3'];
            $ts_status_date_3 = $_POST['ts_status_date3'];
            $ts_status_note_3 = $_POST['ts_status_note3'];
        } else {
            $ts_status_3 = "0";
            $ts_status_date_3 = "";
            $ts_status_note_3 = "";
        }

        if (isset($_POST['ts_status4'])) {
            $ts_status_4 = $_POST['ts_status4'];
            $ts_status_date_4 = $_POST['ts_status_date4'];
            $ts_status_note_4 = $_POST['ts_status_note4'];
        } else {
            $ts_status_4 = "0";
            $ts_status_date_4 = "";
            $ts_status_note_4 = "";
        }

        $fields_ts = array(
            "ts_name_th" => $ts_name_th,
            "ts_name_en" => $ts_name_en,
            "ts_gt_id" => $ts_gt_id,
            "ay_id" => $ay_id,
            "ts_status_1" => $ts_status_1,
            "ts_status_date_1" => $ts_status_date_1,
            "ts_status_note_1" => $ts_status_note_1,
            "ts_status_2" => $ts_status_2,
            "ts_status_date_2" => $ts_status_date_2,
            "ts_status_note_2" => $ts_status_note_2,
            "ts_status_3" => $ts_status_3,
            "ts_status_date_3" => $ts_status_date_3,
            "ts_status_note_3" => $ts_status_note_3,
            "ts_status_4" => $ts_status_4,
            "ts_status_date_4" => $ts_status_date_4,
            "ts_status_note_4" => $ts_status_note_4,
        );

        $ts_id = base64_decode($_POST['ts_id']);

        data_update("thesis", $fields_ts, "ts_id = '" . $ts_id . "'");

        data_delete("thesis_student", " ts_id = '" . $ts_id . "'");
        data_delete("thesis_adviser", " ts_id = '" . $ts_id . "'");

        foreach ($std_id as $key_std => $value_std) {
            unset($fields_std);

            $fields_std = array(
                "ts_id" => $ts_id,
                "std_id" => $value_std,
            );

            data_insert("thesis_student", $fields_std);
        }

        foreach ($tc_id as $key_tc => $value_tc) {
            unset($fields_tc);

            $fields_tc = array(
                "ts_id" => $ts_id,
                "tc_id" => $value_tc,
            );

            data_insert("thesis_adviser", $fields_tc);
        }

        if ($ts_id != '') {
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
        $ts_id = base64_decode($_POST['ts_id']);

        $fields_ts = array(
            "delete_flag" => '1',
        );

        data_update("thesis", $fields_ts, "ts_id = '" . $ts_id . "'");

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
