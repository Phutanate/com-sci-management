<?php
require_once("../../include/config.php");

// กำหนด header สำหรับการส่งข้อมูลในรูปแบบ JSON
header('Content-Type: application/json');

// กำหนด response array
$response = [];

try {
    $ft = "";

    if ($_POST['ts_gt_id']) {
        $ft .= " AND ts_gt_id = '" . $_POST['ts_gt_id'] . "'";
    }

    $SQL_thesis_grouptype = "SELECT * FROM thesis_grouptype WHERE delete_flag = '0'" . $ft;
    $result_thesis_grouptype = data_Fetch($SQL_thesis_grouptype);

    $response['data'] = $result_thesis_grouptype['ts_gt_number'];
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
