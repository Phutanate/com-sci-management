function academic_year_process(event, process, ay_id = "") {
  event.preventDefault();

  if (process == "add" || process == "edit") {
    var ay_year = $("#AY_YEAR").val();

    var data = { tc_id: [] };

    if ($("#AY_YEAR").val() == "") {
      alert_confirm("กรุณาระบุ ปีการศึกษา", "error", "danger");
      return false;
    } else {
      data.ay_year = $("#AY_YEAR").val();
    }

    var adviser_number = $("[id^=row-thesis-adviser]").length;
    if (adviser_number == 0) {
      alert_confirm(
        "กรุณาเพิ่ม ข้อมูลอาจารย์ที่ปรึกษาประจำปีการศึกษา",
        "error",
        "danger"
      );
      return false;
    } else {
      $("[id^=TC_ID_]").each(function (index, element) {
        if ($(element).val() != "") {
          data.tc_id.push($(element).val());
        }
      });

      if (data.tc_id.length == 0) {
        alert_confirm(
          "กรุณาระบุ ข้อมูลอาจารย์ที่ปรึกษาประจำปีการศึกษา",
          "error",
          "danger"
        );
        return false;
      }
    }

    data.ay_id = ay_id;
    data.process = process;
  } else {
    return false;
  }

  $.ajax({
    type: "post",
    url: "../process/data_basic_academic_year_process.php",
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        alert_location(
          response.message,
          response.status,
          response.style,
          "data_basic_academic_year_table.php"
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

function delete_data(ay_id) {
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
        ay_id: ay_id,
        process: "delete",
      };

      $.ajax({
        type: "post",
        url: "../process/data_basic_academic_year_process.php",
        data: data,
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            alert_location(
              response.message,
              response.status,
              response.style,
              "data_basic_academic_year_table.php"
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
