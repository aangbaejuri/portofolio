<?php
$get_sct1 = $conn->query("SELECT * FROM sctn WHERE kode = '" . $data_web['kode'] . "'");
$data_sct1 = $get_sct1->fetch_assoc();

$get_kontak = $conn->query("SELECT * FROM kontak WHERE kode = '" . $data_web['kode'] . "'");
$data_kontak = $get_kontak->fetch_assoc();