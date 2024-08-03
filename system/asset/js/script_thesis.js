function thesis_process(event, process, ts_id = "") {
  event.preventDefault();

  if (process == "add" || process == "edit") {
    var data = { std_id: [], tc_id: [] };
    if ($("#TS_NAME_TH").val() == "") {
      alert_confirm("กรุณาระบุ ชื่อโครงงาน TH", "error", "danger");
      return false;
    } else {
      data.ts_name_th = $("#TS_NAME_TH").val();
    }

    if ($("#TS_NAME_EN").val() == "") {
      alert_confirm("กรุณาระบุ ชื่อโครงงาน EN", "error", "danger");
      return false;
    } else {
      data.ts_name_en = $("#TS_NAME_EN").val();
    }

    if ($("#TS_GT_ID").val() == "") {
      alert_confirm("กรุณาระบุ กลุ่มประเภทโครงงาน", "error", "danger");
      return false;
    } else {
      data.ts_gt_id = $("#TS_GT_ID").val();
    }

    var status1 = $("#TS_STATUS_1:checked").val();
    var status2 = $("#TS_STATUS_2:checked").val();
    var status3 = $("#TS_STATUS_3:checked").val();
    var status4 = $("#TS_STATUS_4:checked").val();

    if (status1) {
      if ($("#TS_STATUS_DATE_1").val() == "") {
        alert_confirm(
          "กรุณาระบุ วันที่เริ่มดำเนินการโครงงาน 1",
          "error",
          "danger"
        );
        return false;
      } else {
        data.ts_status1 = $("#TS_STATUS_1").val();
        data.ts_status_date1 = $("#TS_STATUS_DATE_1").val();
        data.ts_status_note1 = $("#TS_STATUS_NOTE_1").val();
      }
    }

    if (status2) {
      if ($("#TS_STATUS_DATE_2").val() == "") {
        alert_confirm("กรุณาระบุ สอบโครงงาน 1 ผ่าน", "error", "danger");
        return false;
      } else {
        data.ts_status2 = $("#TS_STATUS_2").val();
        data.ts_status_date2 = $("#TS_STATUS_DATE_2").val();
        data.ts_status_note2 = $("#TS_STATUS_NOTE_2").val();
      }
    }

    if (status3) {
      if ($("#TS_STATUS_DATE_3").val() == "") {
        alert_confirm("กรุณาระบุ กำลังดำเนินการโครงงาน 2", "error", "danger");
        return false;
      } else {
        data.ts_status3 = $("#TS_STATUS_3").val();
        data.ts_status_date3 = $("#TS_STATUS_DATE_3").val();
        data.ts_status_note3 = $("#TS_STATUS_NOTE_3").val();
      }
    }

    if (status4) {
      if ($("#TS_STATUS_DATE_4").val() == "") {
        alert_confirm("กรุณาระบุ สอบโครงงาน 2 ผ่าน", "error", "danger");
        return false;
      } else {
        data.ts_status4 = $("#TS_STATUS_4").val();
        data.ts_status_date4 = $("#TS_STATUS_DATE_4").val();
        data.ts_status_note4 = $("#TS_STATUS_NOTE_4").val();
      }
    }

    if ($("#AY_ID").val() == "") {
      alert_confirm("กรุณาระบุ ปีการศึกษา", "error", "danger");
      return false;
    } else {
      data.ay_id = $("#AY_ID").val();
    }

    var student_number = $("[id^=row-thesis-student]").length;
    if (student_number == 0) {
      alert_confirm("กรุณาพิ่ม ข้อมูลผู้จัดทำโครงงาน", "error", "danger");
      return false;
    } else {
      $("[id^=STD_ID_]").each(function (index, element) {
        if ($(element).val() != "") {
          data.std_id.push($(element).val());
        }
      });

      if (data.std_id.length == 0) {
        alert_confirm("กรุณาระบุ ข้อมูลผู้จัดทำโครงงาน", "error", "danger");
        return false;
      }
    }

    var adviser_number = $("[id^=row-thesis-adviser]").length;
    if (adviser_number == 0) {
      alert_confirm(
        "กรุณาเพิ่ม ข้อมูลอาจารย์ที่ปรึกษาโครงงาน",
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
          "กรุณาระบุ ข้อมูลอาจารย์ที่ปรึกษาโครงงาน",
          "error",
          "danger"
        );
        return false;
      }
    }

    data.ts_id = ts_id;
    data.process = process;
  } else {
    return false;
  }


  $.ajax({
    type: "post",
    url: "../process/thesis_process.php",
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        alert_location(
          response.message,
          response.status,
          response.style,
          "thesis_table.php"
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

function delete_data(ts_id) {
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
        ts_id: ts_id,
        process: "delete",
      };

      $.ajax({
        type: "post",
        url: "../process/thesis_process.php",
        data: data,
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            alert_location(
              response.message,
              response.status,
              response.style,
              "thesis_table.php"
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

function toggle_detail(value) {
  var element = $("#TS_STATUS_" + value + ":checked").val();
  if (element) {
    $("#group_detail_status_" + value).show();
  } else {
    $("#group_detail_status_" + value).hide();
    $("#TS_STATUS_DATE_" + value).val("");
    $("#TS_STATUS_NOTE_" + value).val("");
  }

  if (value == 1) {
    if (!element) {
      if ($("#TS_STATUS_2:checked").val()) {
        $("#TS_STATUS_2").click();
      }
      if ($("#TS_STATUS_3:checked").val()) {
        $("#TS_STATUS_3").click();
      }
      if ($("#TS_STATUS_4:checked").val()) {
        $("#TS_STATUS_4").click();
      }
    }
  } else if (value == 2) {
    if (element) {
      if (!$("#TS_STATUS_1:checked").val()) {
        $("#TS_STATUS_1").click();
      }
    } else {
      if ($("#TS_STATUS_3:checked").val()) {
        $("#TS_STATUS_3").click();
      }
      if ($("#TS_STATUS_4:checked").val()) {
        $("#TS_STATUS_4").click();
      }
    }
  } else if (value == 3) {
    if (element) {
      if (!$("#TS_STATUS_1:checked").val()) {
        $("#TS_STATUS_1").click();
      }
      if (!$("#TS_STATUS_2:checked").val()) {
        $("#TS_STATUS_2").click();
      }
    } else {
      if ($("#TS_STATUS_4:checked").val()) {
        $("#TS_STATUS_4").click();
      }
    }
  } else if (value == 4) {
    if (element) {
      if (!$("#TS_STATUS_2:checked").val()) {
        $("#TS_STATUS_2").click();
      }
      if (!$("#TS_STATUS_3:checked").val()) {
        $("#TS_STATUS_3").click();
      }
      if (!$("#TS_STATUS_4:checked").val()) {
        $("#TS_STATUS_4").click();
      }
    }
  }
}

function delete_ay_id_row() {
  $("[id^=row-thesis-student-]").remove();
  toggle_add_student_btn_from_ay();
}

function toggle_add_student_btn_from_limit() {
  var number = $("[id^=row-thesis-student]").length;
  var limit = $("#limit_student").val();
  // var ay_id = $("#AY_ID").val();

  if (number > limit) {
    $("#btn_add_student").hide();
    $($("[id^=row-thesis-student]")).remove();
    toggle_add_student_btn_from_ay();
  } else if (number == limit) {
    $("#btn_add_student").hide();
  } else {
    toggle_add_student_btn_from_ay();
  }
}

function toggle_add_student_btn_from_ay() {
  var value1 = $("#AY_ID").val();
  var value2 = $("#TS_GT_ID").val();
  if (value1 != "" && value2 != "") {
    $("#btn_add_student").show();
  } else {
    $("#btn_add_student").hide();
  }
}

function set_limit_student() {
  var ts_gt_id = $("#TS_GT_ID").val();

  if (ts_gt_id != "") {
    $.ajax({
      type: "post",
      url: "../process/set_limit_student_process.php",
      data: {
        ts_gt_id: ts_gt_id,
      },
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          $("#limit_student").val(response.data);

          toggle_add_student_btn_from_limit();
        } else {
          alert_confirm("ระบบเกิดข้อผิดพลาด", "error", "danger");
        }
      },
      error: function (xhr, status, error) {
        alert_confirm("ระบบเกิดข้อผิดพลาด", "error", "danger");
        console.error("เกิดข้อผิดพลาด: " + status + " - " + error);
      },
    });
  } else {
    $("#btn_add_student").hide();
    $($("[id^=row-thesis-student]")).remove();
  }
}
