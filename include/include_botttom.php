    <!--   Core JS Files   -->
    <script src="../../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery Scrollbar -->
    <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="../../assets/js/kaiadmin.min.js"></script>
    <!-- Datatables -->
    <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Bootstrap Notify -->
    <script src="../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <!-- Chart JS -->
    <script src="../../assets/js/plugin/chart.js/chart.min.js"></script>

    <script>
        function toggle_password() {
            var passwordField = $("#USER_PASSWORD");
            var passwordFieldType = passwordField.attr("type");
            if (passwordFieldType == "password") {
                passwordField.attr("type", "text");
                $("#togglePassword").html('<i class="fas fa-eye text-secondary op-4"></i>');
            } else {
                passwordField.attr("type", "password");
                $("#togglePassword").html('<i class="fas fa-eye-slash text-secondary op-4"></i>');
            }
        }

        function alert_text(title, timer) {
            Swal.fire({
                title: title,
                showConfirmButton: false,
                timer: timer * 1000,
                timerProgressBar: true
            });
        }

        function alert_text2(title, from, align, style, timer, delay) {
            var content = {};

            content.message = "";
            content.title = title;
            content.icon = "fa fa-bell";
            content.url = "#";
            content.target = "";

            $.notify(content, {
                type: style,
                placement: {
                    from: from || "top", // top or bottom
                    align: align || "right", // left, center, right
                },
                time: (timer * 1000),
                delay: (delay * 1000),
            });
        }

        function alert_confirm(title, icon, button) {
            Swal.fire({
                title: title,
                icon: icon,
                showCancelButton: false,
                confirmButtonText: 'ตกลง',
                customClass: {
                    confirmButton: "btn btn-" + button,
                },
            });
        }

        function alert_reload(title, icon) {
            Swal.fire({
                title: title,
                icon: icon,
                showCancelButton: true,
                confirmButtonText: 'ตกลง',
                customClass: {
                    confirmButton: 'btn btn-success',
                },
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                } else {
                    Swal.close();
                }
            });
        }

        function alert_location(title, icon, button, url) {
            Swal.fire({
                title: title,
                icon: icon,
                confirmButtonText: 'ตกลง',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                } else {
                    Swal.close();
                }
            });
        }

        function alert_ajax(title, icon, method, url, data) {
            Swal.fire({
                title: title,
                icon: icon,
                showCancelButton: true,
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: method,
                        url: url,
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            alert_confirm(response.message, response.status, response.style);
                        },
                        error: function(xhr, status, error) {
                            alert_confirm("เกิดข้อผิดพลาด", "error", "danger");
                            console.error("เกิดข้อผิดพลาด: " + status + " - " + error);
                        }
                    });
                } else {
                    Swal.close();
                }
            });
        }
    </script>