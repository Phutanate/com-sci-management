function login_group_show() {
  $("#reset_password_group").hide("slide");
  $("#login_group").show("slide");
}

function reset_password_group_show() {
  $("#login_group").hide("slide");
  $("#reset_password_group").show("slide");
}

function signin_process(event) {
  event.preventDefault();

  var username = $("#USER_USERNAME").val();
  var password = $("#USER_PASSWORD").val();

  var data = {
    username: username,
    password: password,
  };

  $.ajax({
    type: "post",
    url: "../process/signin_process.php",
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        window.location.href = "../../system/page/index.php"
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

function reset_password_process(event) {
  event.preventDefault();

  var email = $("#USER_EMAIL").val();

  var data = {
    email: email,
  };

  $.ajax({
    type: "post",
    url: "../process/reset_password_process.php",
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        window.location.href = "../../system/page/index.php"
      } else {
        alert_confirm(response.message, response.status, response.style);
      }
    },
    error: function (xhr, status, error) {
      alert_confirm("ระบบเกิดข้อผิดพลาด รหัสผ่านของคุณยังไม่เปลี่ยนแปลง", "error", "danger");
      console.error("เกิดข้อผิดพลาด: " + status + " - " + error);
    },
  });
}

function change_page(page) {
  $("#PAGE").val(page);

  if ($("#PAGE").val() == page) {
      $("#search-form").submit();
  }
}