function teacher_position_process(event, process, tp_id = "") {
  event.preventDefault();

  if (process == "add" || process == "edit") {
    var data = {};

    if ($("#TP_NAME_TH").val() == "") {
      alert_confirm("กรุณาระบุ ชื่อตำแหน่ง TH", "error", "danger");
      return false;
    } else {
      data.tp_name_th = $("#TP_NAME_TH").val();
    }

    if ($("#TP_NAME_EN").val() == "") {
      alert_confirm("กรุณาระบุ ชื่อตำแหน่ง EN", "error", "danger");
      return false;
    } else {
      data.tp_name_en = $("#TP_NAME_EN").val();
    }

    data.tp_id = tp_id;
    data.process = process;
  } else {
    return false;
  }

  $.ajax({
    type: "post",
    url: "../process/data_basic_teacher_position_process.php",
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        alert_location(
          response.message,
          response.status,
          response.style,
          "data_basic_teacher_position_table.php"
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

function delete_data(tp_id) {
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
        tp_id: tp_id,
        process: "delete",
      };

      $.ajax({
        type: "post",
        url: "../process/data_basic_teacher_position_process.php",
        data: data,
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            alert_location(
              response.message,
              response.status,
              response.style,
              "data_basic_teacher_position_table.php"
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
