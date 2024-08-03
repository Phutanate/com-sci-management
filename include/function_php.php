<?php

// debug array
function print_pre($data_array)
{
    echo "<pre>";
    print_r($data_array);
    echo "</pre>";
}

// ชื่อย่อจากคำขึ้นต่น
function get_text_abbv($text, $digit, $case = "")
{
    $explode_text = explode(" ", $text);
    $new_text = "";
    $i = 0;
    while ($i < $digit) {
        if ($case == "upper") {
            if (isset($explode_text[$i][0])) {
                $new_text .= strtoupper($explode_text[$i][0]);
            } else {
                $new_text .= strtoupper($explode_text[$i - 1][$i]);
            }
        } else if ($case == "lower") {
            if (isset($explode_text[$i][0])) {
                $new_text .= strtoupper($explode_text[$i][0]);
            } else {
                $new_text .= strtoupper($explode_text[$i - 1][$i]);
            }
        } else {
            if (isset($explode_text[$i][0])) {
                $new_text .= strtoupper($explode_text[$i][0]);
            } else {
                $new_text .= strtoupper($explode_text[$i - 1][$i]);
            }
        }
        $i++;
    }

    return $new_text;
}

// ชื่อผู้ใช้
function get_user($user_id, $target)
{
    $user_id = base64_decode($user_id);
    $sql = "SELECT * FROM users WHERE user_id = '" . $user_id . "'";
    $data = data_Fetch($sql);

    if ($target == "NAME") {
        $result = $data["user_fname"] . " " . $data["user_lname"];
    } else if ($target == "EMAIL") {
        $result = $data["user_email"];
    }

    return $result;
}

// ชื่ออาจารย์
function get_teacher_name($tc_id, $language = "")
{
    $sql = "SELECT * FROM teacher WHERE tc_id = '" . $tc_id . "'";
    $data = data_Fetch($sql);

    if ($language === "TH") {
        $fullname = get_prefix_name($data["prefix_id"], "TH") . $data["tc_fname_th"] . " " . $data["tc_lname_th"];
    } else if ($language === "EN") {
        $fullname = get_prefix_name($data["prefix_id"], "EN") . $data["tc_fname_en"] . " " . $data["tc_lname_en"];
    } else {
        $fullname = get_prefix_name($data["prefix_id"], "TH") . $data["tc_fname_th"] . " " . $data["tc_lname_th"];
    }
    return $fullname;
}

// ตำแหน่งอาจารย์
function get_teacher_position_name($tp_id, $language = "")
{
    $sql = "SELECT * FROM teacher_position WHERE tp_id = '" . $tp_id . "'";
    $data = data_Fetch($sql);

    if ($language === "TH") {
        $position = $data["tp_name_th"];
    } else if ($language === "EN") {
        $position = $data["tp_name_en"];
    } else {
        $position = $data["tp_name_th"];
    }

    return $position;
}

// ชื่อนักศึกษา
function get_student_name($std_id, $language = "")
{
    $sql = "SELECT * FROM student WHERE std_id = '" . $std_id . "'";
    $data = data_Fetch($sql);

    if ($language === "TH") {
        $fullname = get_prefix_name($data["prefix_id"], "TH") . $data["std_fname_th"] . " " . $data["std_lname_th"];
    } else if ($language === "EN") {
        $fullname = get_prefix_name($data["prefix_id"], "EN") . $data["std_fname_en"] . " " . $data["std_lname_en"];
    } else {
        $fullname = get_prefix_name($data["prefix_id"], "TH") . $data["std_fname_th"] . " " . $data["std_lname_th"];
    }

    return $fullname;
}

// คำนวณชั้นปี
function get_academic_year($ay_id)
{
    $sql = "SELECT * FROM academic_year WHERE ay_id = '" . $ay_id . "'";
    $data = data_Fetch($sql);

    $academicYear = (date('Y') + 543) - ($data['ay_year']);
    if ($academicYear > 4) {
        $academicYear = 4;
    }
    return $academicYear;
}

// ผู้จัดทำโครงงาน
function get_thesis_student($ts_id, $limit = "")
{
    $ft_limit = "";
    if ($limit != "") {
        $ft_limit .= " LIMIT " . $limit;
    }
    $sql = "SELECT * FROM thesis_student WHERE ts_id = '" . $ts_id . "'" . $ft_limit;
    $data = data_FetchAll($sql);

    return $data;
}

// ที่ปรึกษาโครงงาน
function get_thesis_adviser($ts_id, $limit = "")
{
    $ft_limit = "";
    if ($limit != "") {
        $ft_limit .= " LIMIT " . $limit;
    }
    $sql = "SELECT * FROM thesis_adviser WHERE ts_id = '" . $ts_id . "'" . $ft_limit;
    $data = data_FetchAll($sql);

    return $data;
}

// ที่ปรึกษา ประจำปีการศึกษา
function get_student_adviser($ay_id, $limit = "")
{
    $ft_limit = "";
    if ($limit != "") {
        $ft_limit .= " LIMIT " . $limit;
    }
    $sql = "SELECT * FROM student_adviser WHERE ay_id = '" . $ay_id . "'" . $ft_limit;
    $data = data_FetchAll($sql);

    return $data;
}

// สถานะโครงงาน
function get_thesis_status($ts_id, $style = "")
{
    $sql = "SELECT * FROM thesis WHERE ts_id = '" . $ts_id . "'";
    $data = data_Fetch($sql);

    if ($data['ts_status_4'] == '1') {
        if ($style == "Y") {
            $status_text = '<span class="badge badge-success">สอบโครงงาน 2 ผ่าน</span>';
        } else {
            $status_text = "สอบโครงงาน 2 ผ่าน";
        }
    } else if ($data['ts_status_3'] == '1') {
        if ($style == "Y") {
            $status_text = '<span class="badge badge-warning">ดำเนินการโครงงาน 2</span>';
        } else {
            $status_text = "ดำเนินการโครงงาน 2";
        }
    } else if ($data['ts_status_2'] == '1') {
        if ($style == "Y") {
            $status_text = '<span class="badge badge-info">สอบโครงงาน 1 ผ่าน</span>';
        } else {
            $status_text = "สอบโครงงาน 1 ผ่าน";
        }
    } else if ($data['ts_status_1'] == '1') {
        if ($style == "Y") {
            $status_text = '<span class="badge badge-primary">ดำเนินการโครงงาน 1</span>';
        } else {
            $status_text = "ดำเนินการโครงงาน 1";
        }
    } else {
        if ($style == "Y") {
            $status_text = '<span class="badge badge-secondary">ไม่ระบุ</span>';
        } else {
            $status_text = "ไม่ระบุ";
        }
    }

    return $status_text;
}
function get_student_status($std_id, $style = "")
{
    $sql = "SELECT * FROM student WHERE std_id = '" . $std_id . "'";
    $data = data_Fetch($sql);

    if ($data['std_status'] == '1') {
        if ($style == "Y") {
            $status_text = '<span class="badge badge-warning">กำลังศึกษา</span>';
        } else {
            $status_text = "กำลังศึกษา";
        }
    } else if ($data['std_status'] == '2') {
        if ($style == "Y") {
            $status_text = '<span class="badge badge-success">จบการศึกษา</span>';
        } else {
            $status_text = "จบการศึกษา";
        }
    } else if ($data['std_status'] == '3') {
        if ($style == "Y") {
            $status_text = '<span class="badge badge-danger">พ้นสภาพนักศึกษา</span>';
        } else {
            $status_text = "พ้นสภาพนักศึกษา";
        }
    } else {
        if ($style == "Y") {
            $status_text = '<span class="badge badge-secondary">ไม่ระบุ</span>';
        } else {
            $status_text = "ไม่ระบุ";
        }
    }

    return $status_text;
}

// สุ่ม class
function getRandomWord()
{
    // กำหนดรายการคำที่ต้องการสุ่ม
    $class = ["skew-shadow", "bubble-shadow", "curves-shadow"];

    // เลือกคีย์แบบสุ่มจาก array
    $randomClass = array_rand($class);

    // คืนค่าคำที่สุ่มได้
    return $class[$randomClass];
}

// ชื่อนักศึกษา
function get_prefix_name($prefix_id, $language = "")
{
    $sql = "SELECT * FROM prefix WHERE prefix_id = '" . $prefix_id . "'";
    $data = data_Fetch($sql);

    if ($language === "TH") {
        $prefix = $data["prefix_name_th"]." ";
    } else if ($language === "EN") {
        $prefix = $data["prefix_name_en"]." ";
    } else {
        $prefix = $data["prefix_name_th"]." ";
    }

    return $prefix;
}


// สีสถานะ
function get_time_line_stye($value)
{

    if ($value == '1') {
        $style = "success";
    } else if ($value != '1') {
        $style = "danger";
    } else {
        $style = "";
    }

    return $style;
}

// icon สถานะ
function get_time_line_icon($value)
{

    if ($value == '1') {
        $icon = "icon-check";
    } else if ($value != '1') {
        $icon = "icon-close";
    } else {
        $icon = "";
    }

    return $icon;
}
