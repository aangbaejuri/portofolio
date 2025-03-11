<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title><?= $data_web['title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?= $data_web['title'] ?> By <?= $data_web['author'] ?>">
    <meta name="author" content="<?= $data_web['author'] ?>" />
    <meta name="description" content="<?= $data_web['title'] ?>" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= $aang_url . $data_web['favicon'] ?>">
    <!-- Quill css -->
    <link href="<?= $aang_url ?>admin/assets/vendor/quill/quill.core.css" rel="stylesheet" type="text/css" />
    <link href="<?= $aang_url ?>admin/assets/vendor/quill/quill.snow.css" rel="stylesheet" type="text/css" />
    <link href="<?= $aang_url ?>admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
    <!-- Select2 css -->
    <link href="<?= $aang_url ?>admin/assets/vendor/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterangepicker css -->
    <link href="<?= $aang_url ?>admin/assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Touchspin css -->
    <link href="<?= $aang_url ?>admin/assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Datepicker css -->
    <link href="<?= $aang_url ?>admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Timepicker css -->
    <link href="<?= $aang_url ?>admin/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Flatpickr Timepicker css -->
    <link href="<?= $aang_url ?>admin/assets/vendor/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme Config Js -->
    <script src="<?= $aang_url ?>admin/assets/js/config.js"></script>
    <!-- App css -->
    <link href="<?= $aang_url ?>admin/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons css -->
    <link href="<?= $aang_url ?>admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="wrapper">