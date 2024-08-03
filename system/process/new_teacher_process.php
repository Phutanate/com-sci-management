<?php
require_once("../../include/config.php");

// กำหนด header สำหรับการส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');

// กำหนด response array
$response = [];

try {

    $SQL_teacher = "SELECT * FROM teacher WHERE delete_flag = '0'";
    $result_teacher = data_FetchAll($SQL_teacher);
    $data = array();
    $i = 0;
    foreach ($result_teacher as $key_tc => $value_tc) {
        $SQL_prefix = "SELECT prefix_name_th FROM prefix WHERE prefix_id = '" . $value_tc['prefix_id'] . "'";
        $result_prefix = data_Fetch($SQL_prefix);

        $data[$i]['tc_id'] = $value_tc['tc_id'];
        $data[$i]['prefix'] = $result_prefix['prefix_name_th'];
        $data[$i]['tc_fname_th'] = $value_tc['tc_fname_th'];
        $data[$i]['tc_lname_th'] = $value_tc['tc_lname_th'];

        $i++;
    }
    $response['data'] = $data;
    $response['status'] = 'success';
    $response['message'] = 'ดึงข้อมูลสำเร็จ';
    $response['style'] = 'success';
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $e->getMessage();
    $response['style'] = 'danger';
}

// ส่งข้อมูล JSON กลับไปยัง AJAX
echo json_encode($response);
