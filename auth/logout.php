<?php
session_start();
require '../config.php';

if (isset($_SESSION['user'])) {
    $sess_kode_akses = $_SESSION['user']['kode_akses'];
    
    $stmt = $conn->prepare("UPDATE users SET cookie_token = '' WHERE kode_akses = ?");
    $stmt->bind_param("s", $sess_kode_akses);
    $stmt->execute();
    $stmt->close();
    
    unset($_SESSION['user']);
    session_destroy();
}

exit(header("Location: " . $aang_url . "auth/login"));

