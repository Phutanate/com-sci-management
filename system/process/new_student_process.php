<?php
require_once("../../include/config.php");

// กำหนด header สำหรับการส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');

// กำหนด response array
$response = [];

try {
    $ft = "";

    if ($_POST['ay_id']) {
        $ft .= " AND ay_id = '" . $_POST['ay_id'] . "'";
    }

    $SQL_student = "SELECT * FROM student WHERE delete_flag = '0'" . $ft;
    $result_student = data_FetchAll($SQL_student);
    $data = array();
    $i = 0;
    foreach ($result_student as $key_std => $value_std) {
        $SQL_prefix = "SELECT prefix_name_th FROM prefix WHERE prefix_id = '" . $value_std['prefix_id'] . "'";
        $result_prefix = data_Fetch($SQL_prefix);

        $data[$i]['std_id'] = $value_std['std_id'];
        $data[$i]['prefix'] = $result_prefix['prefix_name_th'];
        $data[$i]['std_fname_th'] = $value_std['std_fname_th'];
        $data[$i]['std_lname_th'] = $value_std['std_lname_th'];

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
