<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname  = "com-sci-management";

try {
    $conn = new PDO("mysql:host=$servername;dbname=" . $dbname, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

session_start();
if (!isset($_SESSION['USER_ID'])) {
    $_SESSION['USER_ID'] = "";
}

// เรียกข้อมูลแถวเดียว
function data_Fetch($sql)
{
    global $conn; // ประกาศใช้ตัวแปร global

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();

        return $result; // ส่งคืนค่า $result
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// เรียกข้อมูลหลายแถว
function data_FetchAll($sql)
{
    global $conn; // ประกาศใช้ตัวแปร global

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return $result; // ส่งคืนค่า $result
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// เพิ่มข้อมูล
function data_insert($table, $fildes, $last_id = "")
{
    global $conn; // ประกาศใช้ตัวแปร global

    try {
        // สร้าง string ของคอลัมน์และค่าที่จะ insert
        $columns = implode(", ", array_keys($fildes));
        $placeholders = implode(", ", array_fill(0, count($fildes), "?"));

        // สร้าง SQL statement
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        // เตรียม statement
        $stmt = $conn->prepare($sql);

        // เรียกใช้ execute โดยส่งค่าของ $fildes
        $stmt->execute(array_values($fildes));

        // คืนค่า ID ที่เพิ่ง insert ถ้า $last_id เท่ากับ "Y"
        if ($last_id === "Y") {
            return $conn->lastInsertId();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return null; // คืนค่า null ถ้าไม่ได้ตั้งค่าให้คืนค่า ID
}

// แก่้ไขข้อมูล
function data_update($table, $fildes, $condition = "")
{
    global $conn; // ประกาศใช้ตัวแปร global

    try {
        // สร้าง string ของคอลัมน์และค่าที่จะ update
        $setString = "";
        foreach ($fildes as $key => $value) {
            $setString .= "$key = ?, ";
        }
        $setString = rtrim($setString, ", ");

        // สร้าง SQL statement
        $sql = "UPDATE $table SET $setString";
        if ($condition) {
            $sql .= " WHERE $condition";
        }

        // เตรียม statement
        $stmt = $conn->prepare($sql);

        // เรียกใช้ execute โดยส่งค่าของ $fildes
        $stmt->execute(array_values($fildes));

        // echo "Record updated successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// ลบข้อมูล
function data_delete($table, $condition = "")
{
    global $conn; // ประกาศใช้ตัวแปร global

    try {
        // สร้าง SQL statement สำหรับการลบข้อมูล
        $sql = "DELETE FROM $table";
        if ($condition) {
            $sql .= " WHERE $condition";
        }

        // เตรียม statement
        $stmt = $conn->prepare($sql);

        // เรียกใช้ execute
        $stmt->execute();

        // echo "Record deleted successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// นับข้อมูล
function data_row($table, $condition = "")
{
    global $conn; // ประกาศใช้ตัวแปร global

    try {
        // สร้าง SQL statement สำหรับการนับแถว
        $sql = "SELECT COUNT(*) FROM $table";
        if ($condition) {
            $sql .= " WHERE $condition";
        }

        // เตรียม statement
        $stmt = $conn->prepare($sql);

        // เรียกใช้ execute
        $stmt->execute();

        // ดึงค่าผลลัพธ์
        $rowCount = $stmt->fetchColumn();

        // คืนค่าจำนวนแถว
        return $rowCount;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// นับข้อมูลจาก sql
function data_row_sql($sql)
{
    global $conn; // ประกาศใช้ตัวแปร global

    try {
        // เตรียม statement
        $stmt = $conn->prepare($sql);

        // เรียกใช้ execute
        $stmt->execute();

        // ดึงค่าผลลัพธ์
        $rowCount = $stmt->fetchColumn();

        // คืนค่าจำนวนแถว
        return $rowCount;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return 0; // คืนค่า 0 หากเกิดข้อผิดพลาด
    }
}
