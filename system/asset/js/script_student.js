function student_process(event, process, std_id = "") {
  event.preventDefault();

  if (process == "add" || process == "edit") {
    var data = {};

    if ($("#PREFIX_ID").val() == "") {
      alert_confirm("กรุณาระบุ คำนำหน้าชื่อ", "error", "danger");
      return false;
    } else {
      data.prefix_id = $("#PREFIX_ID").val();
    }

    if ($("#STD_FNAME_TH").val() == "") {
      alert_confirm("กรุณาระบุ ชื่อ TH", "error", "danger");
      return false;
    } else {
      data.std_fname_th = $("#STD_FNAME_TH").val();
    }

    if ($("#STD_LNAME_TH").val() == "") {
      alert_confirm("กรุณาระบุ นามสกุล TH", "error", "danger");
      return false;
    } else {
      data.std_lname_th = $("#STD_LNAME_TH").val();
    }

    if ($("#STD_FNAME_EN").val() == "") {
      alert_confirm("กรุณาระบุ ชื่อ EN", "error", "danger");
      return false;
    } else {
      data.std_fname_en = $("#STD_FNAME_EN").val();
    }

    if ($("#STD_LNAME_EN").val() == "") {
      alert_confirm("กรุณาระบุ นามสกุล EN", "error", "danger");
      return false;
    } else {
      data.std_lname_en = $("#STD_LNAME_EN").val();
    }

    if ($("#GENDER_ID").val() == "") {
      alert_confirm("กรุณาระบุ เพศ", "error", "danger");
      return false;
    } else {
      data.gender_id = $("#GENDER_ID").val();
    }

    if ($("#AY_ID").val() == "") {
      alert_confirm("กรุณาระบุ รุ่นปีการศึกษา", "error", "danger");
      return false;
    } else {
      data.ay_id = $("#AY_ID").val();
    }

    if ($("#STD_NUMBER_ID").val() == "") {
      alert_confirm("กรุณาระบุ รหัสนักศึกษา :", "error", "danger");
      return false;
    } else {
      data.std_number_id = $("#STD_NUMBER_ID").val();
    }

    if ($("[id^=STD_STATUS_]:checked").val() == "" || $("[id^=STD_STATUS_]:checked").val() == undefined) {
      alert_confirm("กรุณาระบุ สถานะการศึกษา :", "error", "danger");
      return false;
    } else {
      data.std_status = $("[id^=STD_STATUS_]:checked").val();
    }

    data.std_id = std_id;
    data.process = process;
  } else {
    return false;
  }

  $.ajax({
    type: "post",
    url: "../process/student_process.php",
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        alert_location(
          response.message,
          response.status,
          response.style,
          "student_table.php"
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

function delete_data(std_id) {
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
        std_id: std_id,
        process: "delete",
      };

      $.ajax({
        type: "post",
        url: "../process/student_process.php",
        data: data,
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            alert_location(
              response.message,
              response.status,
              response.style,
              "student_table.php"
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
