function authentication_process() {
  var user_id = $("#USER_ID").val();
  console.log(user_id);
  $.ajax({
    type: "post",
    url: "../process/authentication_process.php",
    data: { user_id: user_id },
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        console.log(response);
      } else {
        alert_location(
          response.message,
          response.status,
          response.style,
          "../../public/page/"
        );
      }
    },
    error: function (xhr, status, error) {
      alert_confirm("ระบบเกิดข้อผิดพลาด", "error", "danger");
      console.error("เกิดข้อผิดพลาด: " + status + " - " + error);
    },
  });
}

function signout_process() {
  Swal.fire({
    title: "ออกจากระบบใช่หรือไม่?",
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
      $.ajax({
        type: "post",
        url: "../process/signout_process.php",
        dataType: "json",
        success: function (response) {
          window.location.href = "../../public/page/";
        },
        error: function (xhr, status, error) {
          alert_confirm("ระบบเกิดข้อผิดพลาด", "error", "danger");
          console.error("เกิดข้อผิดพลาด: " + status + " - " + error);
        },
      });
    } else if (result.isDismissed) {
      Swal.close();
    }
  });
}

function change_academic_year() {
  var year = parseInt($("#AY_ID > option:selected").text());
  var currentYear = new Date().getFullYear();
  var academicYear = currentYear + 543 - year + 1; // คำนวณชั้นปี

  if (academicYear > 4) {
    academicYear = 4;
  }
  $("#STD_ACADEMIC_YEAR").val(academicYear);
}

function change_prefix_en() {
  var prefix_id = $("#PREFIX_ID").val();
  $("#PREFIX_ID_EN").val(prefix_id);
}

function change_gender_en() {
  var gender_id = $("#GENDER_ID").val();
  $("#GENDER_ID_EN").val(gender_id);
}

function new_student() {
  var ay_id = $("#AY_ID").val();
  $.ajax({
    type: "post",
    url: "../process/new_student_process.php",
    data: {
      ay_id: ay_id,
    },
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        var number = $("[id^=row-thesis-student]").length + 1;
        var html = "";
        html += '<tr id="row-thesis-student-' + number + '">';
        html += '<th scope="row">' + number + "</th>";
        html += "<td>";
        html += '<div class="form-group form-group-default">';
        html += "<label>นักศึกษา</label>";
        html +=
          '<select class="form-select form-control ps-3" id="STD_ID_' +
          number +
          '" name="STD_ID_' +
          number +
          '">';
        html += '<option value="">เลือก</option>';
        response.data.forEach(function (data) {
          html +=
            '<option value="' +
            data.std_id +
            '">' +
            data.prefix +
            data.std_fname_th +
            " " +
            data.std_lname_th +
            "</option>";
        });
        html += "</select>";
        html += "</div>";
        html += "</td>";
        html += "<td></td>";
        html += "<td>";
        html += '<div class="d-flex justify-content-center">';
        html +=
          '<a class="btn btn-sm btn-danger mx-1" href="javascript:void(0);" onclick="delete_row(' +
          "'" +
          "row-thesis-student-" +
          number +
          "'" +
          ')" title="ลบ">';
        html += '<i class="fa fa-trash"></i>';
        html += "</a>";
        html += "</div>";
        html += "</td>";
        html += "</tr>";

        $("#group_thesis_student").append(html);

        toggle_add_student_btn_from_limit();
      }
    },
    error: function (xhr, status, error) {
      alert_location(
        "ระบบเกิดข้อผิดพลาด",
        "error",
        "danger",
        "../../public/page/"
      );
      console.error("เกิดข้อผิดพลาด: " + status + " - " + error);
    },
  });
}

function new_adviser() {
  $.ajax({
    type: "post",
    url: "../process/new_teacher_process.php",
    data: "data",
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        var number = $("[id^=row-thesis-adviser]").length + 1;
        var html = "";
        html += '<tr id="row-thesis-adviser-' + number + '">';
        html += '<th scope="row">' + number + "</th>";
        html += "<td>";
        html += '<div class="form-group form-group-default">';
        html += "<label>อาจารย์</label>";
        html +=
          '<select class="form-select form-control ps-3" id="TC_ID_' +
          number +
          '" name="TC_ID_' +
          number +
          '">';
        html += '<option value="">เลือก</option>';
        response.data.forEach(function (data) {
          html +=
            '<option value="' +
            data.tc_id +
            '">' +
            data.prefix +
            data.tc_fname_th +
            " " +
            data.tc_lname_th +
            "</option>";
        });
        html += "</select>";
        html += "</div>";
        html += "</td>";
        html += "<td></td>";
        html += "<td>";
        html += '<div class="d-flex justify-content-center">';
        html +=
          '<a class="btn btn-sm btn-danger mx-1" href="javascript:void(0);" onclick="delete_row(' +
          "'" +
          "row-thesis-adviser-" +
          number +
          "'" +
          ')" title="ลบ">';
        html += '<i class="fa fa-trash"></i>';
        html += "</a>";
        html += "</div>";
        html += "</td>";
        html += "</tr>";

        $("#group_adviser").append(html);
      }
    },
    error: function (xhr, status, error) {
      alert_location(
        "ระบบเกิดข้อผิดพลาด",
        "error",
        "danger",
        "../../public/page/"
      );
      console.error("เกิดข้อผิดพลาด: " + status + " - " + error);
    },
  });
}

function delete_row(id) {
  $("#" + id).remove();
  toggle_add_student_btn_from_ay();
}

$(document).ready(function () {
  authentication_process();
});
