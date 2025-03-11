<?php
require '../config.php';

if (isset($_SESSION['user'])) {
    $kode_akses = $conn->real_escape_string($_SESSION['user']['kode_akses']);
    $check_user = $conn->query("SELECT * FROM users WHERE kode_akses = '$kode_akses'");
    $data_user = $check_user->fetch_assoc();

    exit(header("Location: " . $aang_url . "admin/"));
}