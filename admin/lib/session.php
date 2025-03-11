<?php
if (!isset($_SESSION['user'])) {
    $_SESSION['response'] = array(
        'color' => 'warning', 
        'icon' => 'alert-octagon',
        'title' => 'Warning', 
        'msg' => 'Silakan login terlebih dahulu.'
    );

    exit(header("Location: " . $aang_url . "auth/login"));
}

$sess_kode_akses = $_SESSION['user']['kode_akses'];
$sess_nama = $_SESSION['user']['nama'];

$sess_nama_split = explode(' ', $sess_nama);
$sess_nama2 = implode(' ', array_slice($sess_nama_split, 0, 2));

if ($sess_kode_akses) {
    $sess_kode_akses_escaped = $conn->real_escape_string($sess_kode_akses);

    $check_user = $conn->query("SELECT * FROM users WHERE kode_akses = '$sess_kode_akses_escaped'");
    
    if ($check_user->num_rows === 0) {
        exit(header("Location: " . $aang_url . "auth/logout"));
    }
    
    $data_user = $check_user->fetch_assoc();
} else {
    $_SESSION['response'] = array(
        'color' => 'danger', 
        'icon' => 'alert-octagon',
        'title' => 'Danger', 
        'msg' => 'Sepertinya ada sesuatu yang tidak beres.'
    );

    exit(header("Location: " . $aang_url . "auth/login"));
}