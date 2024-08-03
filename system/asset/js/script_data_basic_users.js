function users_process(event, process, user_id = "") {
  event.preventDefault();

  if (process == "add" || process == "edit") {
    var data = {};

    if ($("#USER_FNAME").val() == "") {
      alert_confirm("กรุณาระบุ ชื่อเจ้าหน้าที่", "error", "danger");
      return false;
    } else {
      data.user_fname = $("#USER_FNAME").val();
    }

    if ($("#USER_LNAME").val() == "") {
      alert_confirm("กรุณาระบุ นามสกุลเจ้าหน้าที่", "error", "danger");
      return false;
    } else {
      data.user_lname = $("#USER_LNAME").val();
    }

    if ($("#USER_EMAIL").val() == "") {
      alert_confirm("กรุณาระบุ อีเมลล์", "error", "danger");
      return false;
    } else {
      data.user_email = $("#USER_EMAIL").val();
    }

    if ($("#USER_USERNAME").val() == "") {
      alert_confirm("กรุณาระบุ ชื่อผู้ใช้", "error", "danger");
      return false;
    } else {
      data.user_username = $("#USER_USERNAME").val();
    }

    if (process == "add") {
      if ($("#USER_PASSWORD").val() == "") {
        alert_confirm("กรุณาระบุ รหัสผ่านใหม่", "error", "danger");
        return false;
      } else {
        data.user_password = $("#USER_PASSWORD").val();
      }

      if ($("#USER_PASSWORD_CONFIRM").val() == "") {
        alert_confirm("กรุณาระบุ ยืนยันรหัสผ่านใหม่", "error", "danger");
        return false;
      } else {
        data.user_password_confirm = $("#USER_PASSWORD_CONFIRM").val();
      }

      if ($("#USER_PASSWORD").val() !== $("#USER_PASSWORD_CONFIRM").val()) {
        alert_confirm("การยืนยันรหัสผ่านไม่ตรงกัน", "error", "danger");
        return false;
      }
    } else if (process == "edit") {
      if ($("#USER_CHANGEPASSWORD:checked").val() == 1) {
        if ($("#USER_PASSWORD").val() == "") {
          alert_confirm("กรุณาระบุ สร้างรหัสผ่านใหม่", "error", "danger");
          return false;
        } else {
          data.user_password = $("#USER_PASSWORD").val();
        }

        if ($("#USER_PASSWORD_CONFIRM").val() == "") {
          alert_confirm("กรุณาระบุ ยืนยันรหัสผ่านใหม่", "error", "danger");
          return false;
        } else {
          data.user_password_confirm = $("#USER_PASSWORD_CONFIRM").val();
        }

        if ($("#USER_PASSWORD").val() !== $("#USER_PASSWORD_CONFIRM").val()) {
          alert_confirm("การยืนยันรหัสผ่านไม่ตรงกัน", "error", "danger");
          return false;
        }

        data.user_changepassword = "1";
      } else {
        data.user_changepassword = "0";
      }
    } else {
      data.user_changepassword = "0";
    }

    data.user_id = user_id;
    data.process = process;
  } else {
    return false;
  }

  $.ajax({
    type: "post",
    url: "../process/data_basic_users_process.php",
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        alert_location(
          response.message,
          response.status,
          response.style,
          "data_basic_users_table.php"
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

function delete_data(user_id) {
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
        user_id: user_id,
        process: "delete",
      };

      $.ajax({
        type: "post",
        url: "../process/data_basic_users_process.php",
        data: data,
        dataType: "json",
        success: function (response) {
          if (response.status == "success") {
            alert_location(
              response.message,
              response.status,
              response.style,
              "data_basic_users_table.php"
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
