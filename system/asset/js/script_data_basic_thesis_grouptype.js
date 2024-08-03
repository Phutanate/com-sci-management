function thesis_grouptype_process(event, process, ts_gt_id = "") {
  event.preventDefault();

  if (process == "add" || process == "edit") {
    var data = {};

    if ($("#TS_GT_NAME").val() == "") {
      alert_confirm("กรุณาระบุ ชื่อประเภทกลุ่มโครงงาน", "error", "danger");
      return false;
    } else {
      data.ts_gt_name = $("#TS_GT_NAME").val();
    }

    if ($("#TS_GT_NUMBER").val() == "") {
      alert_confirm("กรุณาระบุ จำนวนนักศึกษาต่อกลุ่ม", "error", "danger");
      return false;
    } else {
      data.ts_gt_number = $("#TS_GT_NUMBER").val();
    }

    data.ts_gt_id = ts_gt_id;
    data.process = process;
  } else {
    return false;
  }

  $.ajax({
    type: "post",
    url: "../process/data_basic_thesis_grouptype_process.php",
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        alert_location(
          response.message,
          response.status,
          response.style,
          "data_basic_thesis_grouptype_table.php"
        );
      } else {
        alert_confirm(response.message, response.status, response.style);
      }
    },
    error: function (xhr, status, error) {
      alert_confirm("ระบบเกิดข้อผิดพลาด", "error", "danger");
      console.error("เกิดข้อผิดพลาด: " + status + " - " + error);
    },
  });
}

function delete_data(ts_gt_id) {
  Swal.fire({
    title: "ต้องการลลบข้อมูลใช่หรือไม่?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "ตกลง",
    cancelButtonText: "ยกเลิก",
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
  }).then((result) => {
    if (result.isConfirmed) {
      var data = {
        ts_gt_id: ts_gt_id,
        process: "delete",
      };

      $.ajax({
        type: "post",
        url: "../process/data_basic_thesis_grouptype_process.php",
        data: data,
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            alert_location(
              response.message,
              response.status,
              response.style,
              "data_basic_thesis_grouptype_table.php"
            );
          } else {
            alert_confirm(response.message, response.status, response.style);
          }
        },
        error: function (xhr, status, error) {
          alert_confirm("ระบบเกิดข้อผิดพลาด", "error", "danger");
          console.error("เกิดข้อผิดพลาด: " + status + " - " + error);
        },
      });
    } else {
      Swal.close();
    }
  });
}
