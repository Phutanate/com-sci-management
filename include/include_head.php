<link rel="icon" href="../../assets/img/icon/cs-icon.ico" type="image/x-icon" />

<!-- Fonts and icons -->
<script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["../../assets/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="../../assets/css/plugins.min.css" />

<?php if ($_SESSION['PAGE_SECTION'] == "PUBLIC") { ?>
    <link rel="stylesheet" href="../../assets/css/kaiadmin_public.css" />
<?php } else if ($_SESSION['PAGE_SECTION'] == "SYSTEM") { ?>
    <link rel="stylesheet" href="../../assets/css/kaiadmin_system.css" />
<?php } else { ?>
    <link rel="stylesheet" href="../../assets/css/kaiadmin.css" />
<?php } ?>

<!-- CSS Custom Style -->
<link rel="stylesheet" href="../../assets/css/demo.css" />
<!-- CSS Custom Style -->
<link rel="stylesheet" href="../../assets/css/style.css" />
<!-- CSS Sweet Alert -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">