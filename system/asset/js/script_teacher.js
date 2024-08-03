function teacher_process(event, process, tc_id = "") {
  event.preventDefault();

  if (process == "add" || process == "edit") {
    var data = {};

    if ($("#PREFIX_ID").val() == "") {
      alert_confirm("กรุณาระบุ คำนำหน้าชื่อ", "error", "danger");
      return false;
    } else {
      data.prefix_id = $("#PREFIX_ID").val();
    }

    if ($("#TC_FNAME_TH").val() == "") {
      alert_confirm("กรุณาระบุ ชื่อ TH", "error", "danger");
      return false;
    } else {
      data.tc_fname_th = $("#TC_FNAME_TH").val();
    }

    if ($("#TC_LNAME_TH").val() == "") {
      alert_confirm("กรุณาระบุ นามสกุล TH", "error", "danger");
      return false;
    } else {
      data.tc_lname_th = $("#TC_LNAME_TH").val();
    }

    if ($("#TC_FNAME_EN").val() == "") {
      alert_confirm("กรุณาระบุ ชื่อ EN", "error", "danger");
      return false;
    } else {
      data.tc_fname_en = $("#TC_FNAME_EN").val();
    }

    if ($("#TC_LNAME_EN").val() == "") {
      alert_confirm("กรุณาระบุ นามสกุล EN", "error", "danger");
      return false;
    } else {
      data.tc_lname_en = $("#TC_LNAME_EN").val();
    }

    if ($("#GENDER_ID").val() == "") {
      alert_confirm("กรุณาระบุ เพศ", "error", "danger");
      return false;
    } else {
      data.gender_id = $("#GENDER_ID").val();
    }

    if ($("#TP_ID").val() == "") {
      alert_confirm("กรุณาระบุ ตำแหน่ง", "error", "danger");
      return false;
    } else {
      data.tp_id = $("#TP_ID").val();
    }

    data.tc_id = tc_id;
    data.process = process;
  } else {
    return false;
  }

  $.ajax({
    type: "post",
    url: "../process/teacher_process.php",
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        alert_location(
          response.message,
          response.status,
          response.style,
          "teacher_table.php"
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

function delete_data(tc_id) {
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
        tc_id: tc_id,
        process: "delete",
      };

      $.ajax({
        type: "post",
        url: "../process/teacher_process.php",
        data: data,
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            alert_location(
              response.message,
              response.status,
              response.style,
              "teacher_table.php"
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
